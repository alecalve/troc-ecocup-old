<?php 

include("XML.class.php");

class CAS {
    
    private $url;
    private $cas_url;
    
    public function __construct($cas_url, $url) {
        $this->url = $url;
        $this->cas_url = $cas_url;    
    }
    
    public function login() {
        header('Location: '.$this->cas_url.'login?service='.$this->url);
    }
    
    public function logout() {
        header('Location: '.$this->cas_url.'logout?service='.$this->url);
    }
    
    public function authenticate() {
        if (isset($_GET['ticket'])) {
            $response = file_get_contents($this->cas_url.'serviceValidate?service='.$this->url.'&ticket='.$_GET['ticket']);
            if (empty($response)) return -1;
            $username = XML::parseCASReturn($response);
            if ((-1 == $username) OR (empty($username))) return -1;
            return $username;
        }
        else {
            return -1;
        }
    }
} 
