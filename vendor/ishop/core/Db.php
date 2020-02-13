<?php


namespace ishop;

use \RedBeanPHP\R as R;  // we use RedBeanPHP as ORM to connect to db
// this class do the connection to db
class Db
{
    use TSingletone; // we use singleton pattern to have one connection to database

    protected function __construct(){
        $db = require_once CONF.'/config_db.php';  // we get connection configs like dsn, user and pass
        \RedBeanPHP\R::setup($db['dsn'], $db['user'], $db['pass']);
        if(!\RedBeanPHP\R::testConnection()){
            throw new \Exception("No connection to db", 500);
        }

        \RedBeanPHP\R::freeze(true);  // we do not allow RedBeanPHP to change the structure of the db implicitly

        // we activate debug mode for RedBeanPHP
        if(DEBUG){
            \RedBeanPHP\R::debug(true, 1);
        }
    }
}