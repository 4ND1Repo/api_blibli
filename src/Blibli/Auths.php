<?php

namespace Blibli;

class Auths {

    public $chanelId;
    public $username;
    public $password;

    public function __construct($c=null,$u=null,$p=null) {
        $this->channelId = !is_null($c)?$c:null;
        $this->username = !is_null($u)?$u:null;
        $this->password = !is_null($p)?$p:null;
    }

    public function getToken() {
        $class = get_called_class();
        echo $this->channelId;
        return $class;
    }
}