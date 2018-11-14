<?php
	class Email{
    private $to;
    private $subject;
    private $headers;
    private $message;

    public function __construct($to, $subject, $message, $from) {
      $this->to = $to;
      $this->subject = $subject;
      $this->headers = "From: " . strip_tags($from) . "\r\n";
      $this->headers .= "Reply-To: ". strip_tags($from) . "\r\n";
      $this->headers .= "MIME-Version: 1.0\r\n";
      $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $this->message = $message;
    }

    public function send(){
      mail($this->to, $this->subject, $this->message, $this->headers);
    }












  }
