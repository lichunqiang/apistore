<?php

abstract class Api
{

    public function fetch()
    {
        return $this->_parse();
    }

    protected function _parse()
    {
        echo __CLASS__;
    }
}

class Distance extends Api
{

    protected function _parse()
    {
        echo __CLASS__;
    }
}

$instance = new Distance;

$instance->fetch();
