<?php

namespace app\widgets\currency;

class Currency
{
    protected $tpl;
    protected $currencies; // here we keep all available currencies
    protected $currency; // here we keep user chosen currency

    public function __construct(){
        $this->tpl = __DIR__.'/currency_tpl/currency.php';
        $this->run();
    }

    // this method gets all the currencies of the system as well the current currency
    protected function run(){
        self::getCurrencies();
        self::getCurrency();
        $this->getHtml();
    }

    public static function getCurrencies(){
        return \RedBeanPHP\R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC ");
    }

    // we keep in the cookie the current currency, we get it and check it against our database of currencies in order
    // eliminate a possibility to send into system non existing currency by hacker
    public static function getCurrency($currencies){
        if(isset($_COOKIE['currency']) && array_key_exists($_COOKIE('currency'), $currencies)){
            $key = $_COOKIE['currency'];
        }else{
            $key = key($currencies); // build-in function that return the current key of the array
        }

        $currency = $currencies[$key];  // we keep in the $currency all the details of the current currency
        $currency['code'] = $key;  // the key is the code of currency here, we need it
        return $currency;
    }

    protected function getHtml(){

    }
}