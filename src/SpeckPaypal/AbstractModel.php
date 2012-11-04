<?php
namespace SpeckPaypal;

abstract class AbstractModel extends AbstractElement
{
    protected $method;

    /**
     * (Required)
     *
     * @param $method
     * @return AbstractModel
     */
    protected function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Return formatted NVP string
     *
     * @return string
     */
    public function __toString()
    {
        $data   = $this->toArray();
        $query  = array();

        foreach ( $data as $key => $value) {
            $query[] = strtoupper($key) . '='. urlencode($value);
        }

        return '&' . implode('&', $query);
    }
}