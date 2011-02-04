<?php

require_once('Insight/Plugin/API.php');

class Insight_Plugin_Package extends Insight_Plugin_API {
    
    private $info = false;


    public function setInfo($info) {
        $this->info = $info;
    }
    
    public function addQuickLink($label, $info) {
        if(!$this->info) $this->info = array();
        if(!isset($this->info['links'])) $this->info['links'] = array();
        if(!isset($this->info['links']['quick'])) $this->info['links']['quick'] = array();
        if(isset($this->info['links']['quick'][$label])) {
            throw new Exception('Quick link with label "' . $label . '" alreadt exists!');
        }
        $this->info['links']['quick'][$label] = $info;
    }

    protected function onShutdown() {
        if(!$this->info) return;
        Insight_Helper::to('package')->getMessage()->meta(array(
            "encoder" => "JSON",
            "target" => "info"
        ))->send($this->info);
    }

}
