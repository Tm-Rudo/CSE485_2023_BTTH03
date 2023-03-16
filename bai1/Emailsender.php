<?php
    require_once('EmailSeverInterface.php');
     class EmailSender {
        private $emailServer;
    
        public function __construct(EmailServerInterface $emailServer) {
            $this->emailServer = $emailServer;
        }
    
        public function send($to, $subject,$title, $message) {
            $this->emailServer->sendEmail($to, $subject,$title, $message);
        }
    }


?>
