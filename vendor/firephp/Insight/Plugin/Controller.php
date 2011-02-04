<?php

require_once('Insight/Plugin/API.php');

class Insight_Plugin_Controller extends Insight_Plugin_API {

    protected $inspectTriggered = false;

    public function triggerInspect() {
        if($this->inspectTriggered) {
            return;
        }
        $this->inspectTriggered = true;
        return $this->message->meta(array(
            "encoder" => "JSON"
        ))->send(array(
            "action" => "inspectRequest"
        ));
    }
    
    public function setServerUrl($url) {
        return $this->message->meta(array(
            "encoder" => "JSON"
        ))->send(array(
            "serverUrl" => $url
        ));
    }

    public function triggerClientTest($payload) {
        return $this->message->meta(array(
            "encoder" => "JSON"
        ))->send(array(
            "action" => "testClient",
            "actionArgs" => array(
                "payload" => $payload
            )
        ));
    }

}
