<?php

    namespace App\Http\Services\Message;

use App\Http\Interfaces\MessageInterface;

    class MSGSerivce{

        private $message;

        public function __construct(MessageInterface $messageInterface)
        {
            $this->message = $messageInterface;
        }

        public function send(){
            return $this->message->fire();
        }
    }

?>
