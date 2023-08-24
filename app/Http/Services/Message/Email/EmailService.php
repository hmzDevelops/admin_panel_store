<?php

namespace App\Http\Services\Message\Email;

use App\Mail\MailViewProvider;
use Illuminate\Support\Facades\Mail;
use App\Http\Interfaces\MessageInterface;


    class EmailService implements MessageInterface{

        private $details;
        private $subject;
        private $to;


        public function fire(){
            // Mail::to($this->to)->send(new MailViewProvider($this->details, $this->subject, $this->from));
            Mail::to($this->to)->send(new MailViewProvider($this->subject, $this->details));
            return true;
        }


        public function setTo($to){
            $this->to = $to;
        }

        public function getTo(){
            return $this->to;
        }

        public function setDetails($details){
            $this->details = $details;
        }

        public function getDetails(){
            return $this->details;
        }


        public function setSubject($subject){
            $this->subject = $subject;
        }

        public function getSubject(){
            return $this->subject;
        }
    }
