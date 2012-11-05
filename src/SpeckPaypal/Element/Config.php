<?php
namespace SpeckPaypal\Element;

class Config
{
    protected $username;

    protected $password;

    protected $signature;

    protected $endpoint;

    protected $version = '95.0';

    protected $validElements = array('username', 'password', 'signature', 'version', 'endpoint');

    public function __construct($options)
    {
        foreach($this->validElements as $key) {
            if(isset($options[$key])) {
                $this->$key = $options[$key];
            }
        }
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    public function getSignature()
    {
        return $this->signature;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function isValid()
    {
        foreach($this->validElements as $element) {
            if(is_null($this->$element)) {
                return false;
            }
        }

        return true;
    }

    public function __toString()
    {
        return "VERSION=". urlencode($this->version)
                . "&PWD=". urlencode($this->password)
                . "&USER=". urlencode($this->username)
                . "&SIGNATURE=". urlencode($this->signature);
    }
}