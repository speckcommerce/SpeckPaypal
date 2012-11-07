<?php
namespace SpeckPaypal\Element;

abstract class AbstractElement
{
    public function __construct($options = array())
    {
        if(is_array($options)) {
            $this->fromArray($options);
        }
    }

    protected function checkEmpty(array $data)
    {
        foreach($data as $value) {
            if(empty($value)) {
                return false;
            }
        }

        return true;
    }

    public function fromArray($data)
    {
        foreach($data as $key => $value) {
            if($key == "method") {
                continue;
            }

            $key = "set{$key}";
            if(method_exists($this, $key)) {
                $this->$key($value);
            }
        }
    }

    public function toArray()
    {
        $array = array();
        foreach ($this as $key => $value) {
            if(is_object($value) || is_array($value) || 0 === strpos($key, "_")) {
                continue;
            }

            if(!is_null($value)) {
                $array[strtoupper($key)] = $value;
            }
        }
        return $array;
    }
}