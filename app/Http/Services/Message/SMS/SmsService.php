<?php

use App\Http\Interfaces\MessageInterface;

class SmsService implements MessageInterface{


    private $from;
    private $text;
    private $to;
    private $isFlash;

    public function fire(){

    }

    public function getFrom(){
        return $this->from;
    }

    public function setFrom($from){
        return $this->from = $from;
    }

    public function getText(){
        return $this->text;
    }

    public function setText($text){
        return $this->text = $text;
    }

    public function getTo(){
        return $this->to;
    }

    public function setTo($to){
        return $this->to = $to;
    }
}
