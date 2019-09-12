<?php

namespace XChart;

class Series
{
    private $name;
    private $data;

    public function __construct($name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }
}
