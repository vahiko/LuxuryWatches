<?php


namespace ishop;


class Registry
{
    use TSingletone;

    public static $properties = [];

    public static function setProperty($name, $value){
        self::$properties[$name] = $value;
    }

    public static function getProperty($name){
        if(isset(self::$properties[$name])){
            return self::$properties[$name];
        }
        return null;
    }

    public function getProperties(){
        return self::$properties;
    }
}