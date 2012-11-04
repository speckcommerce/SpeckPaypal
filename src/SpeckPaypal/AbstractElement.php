<?php
namespace SpeckPaypal;

class AbstractElement
{
    public function __construct($options = array())
    {
        foreach($options as $key => $value) {
            if($key == "method") {
                continue;
            }

            $key = "set{$key}";
            if(method_exists($this, $key)) {
                $this->$key($value);
            }
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