<?php
namespace PHPMailer\PHPMailer;

class PHPMailer {
    public $CharSet = 'utf-8';
    private $to = [];
    public $Subject = '';
    public $Body = '';
    private $from = '';
    private $fromName = '';
    private $isHTML = false;

    public function setFrom($address, $name = '') {
        $this->from = $address;
        $this->fromName = $name;
    }

    public function addAddress($address, $name = '') {
        $this->to[] = [$address, $name];
    }

    public function isHTML($html = true) {
        $this->isHTML = $html;
    }

    public function send() {
        if (empty($this->to)) {
            return false;
        }
        $to = implode(',', array_column($this->to, 0));
        $headers = "From: {$this->from}\r\n";
        $headers .= "Reply-To: {$this->from}\r\n";
        if ($this->isHTML) {
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset={$this->CharSet}\r\n";
        } else {
            $headers .= "Content-Type: text/plain; charset={$this->CharSet}\r\n";
        }
        return mail($to, $this->Subject, $this->Body, $headers);
    }
}
