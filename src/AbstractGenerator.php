<?php

namespace IbrahimHalilUcan\Keygen;

abstract class AbstractGenerator
{
    /**
     * Overload the __isset method
     *
     * @param $prop
     * @return bool
     */
    public function __isset($prop)
    {
        return array_key_exists($prop, get_object_vars($this));
    }

    /**
     * Overload the __get method
     *
     * @param $prop
     * @return void
     */
    public function __get($prop)
    {
        if (isset($this->{$prop})) {
            return $this->{$prop};
        }
    }

    /**
     * Overload the __call method
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->__overloadMethods($method, $args);
    }

    /**
     * Overload the __callStatic method
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return (new static)->__call($method, $args);
    }
}
