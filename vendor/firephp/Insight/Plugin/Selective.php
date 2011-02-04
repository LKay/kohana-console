<?php

require_once('Insight/Util.php');
require_once('Insight/Plugin/API.php');

class Insight_Plugin_Selective extends Insight_Plugin_API {

    protected $filters = null;


    protected function _loadFilters($skipAnnounce=false) {
        if($this->filters===null) {
            $this->filters = $this->request->getFromCache('filters');
            if(!$this->filters) {
                $this->filters = array();
            } else
            if($skipAnnounce===false) {
                Insight_Helper::to('selective')->announceFilters();
            }
        }
    }

    protected function _keyForName($name) {
        if(isset($this->message->meta['target'])) {
            return $this->message->meta['target'] . ':' . $name;
        } else {
            return $name;
        }
    }

    protected function _getFilter($name) {
        $this->_loadFilters();
        $key = $this->_keyForName($name);
        if(!isset($this->filters[$key])) {
            $this->filters[$key] = array(
                'name' => $name,
                'enabled' => false
            );
            if(isset($this->message->meta['target'])) {
                $this->filters[$key]['target'] = $this->message->meta['target'];
            }
            $this->request->storeInCache('filters', $this->filters);
            Insight_Helper::to('selective')->announceFilters();
        }
        return $this->filters[$key];
    }

    public function announceFilters() {
        $this->_loadFilters(true);
        $this->message->meta(array(
            "encoder" => "JSON"
        ))->once(__FILE__.':announceFilters')->send(array(
            "filters" => $this->filters
        ));
    }

    public function on($name) {
        $filter = $this->_getFilter($name);
        if($filter['enabled']) {
            return $this->message;
        } else {
            return Insight_Helper::getNullMessage();
        }
    }

    public function respond($server, $request) {

        if($request->getAction()=='ToggleFilter') {

            $this->_loadFilters(true);

            $key = $request->getArgument('key');

            if(isset($this->filters[$key])) {
                $this->filters[$key]['enabled'] = !$this->filters[$key]['enabled'];
            }

            $request->storeInCache('filters', $this->filters);

            return array(
                'type' => 'text/plain',
                'data' => Insight_Util::json_encode(array(
                    'filters' => $this->filters
                ))
            );
        }
        return false;
    }
}
