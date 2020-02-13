<?php


namespace ishop\base;

// this class is responsable for working with data
use ishop\Db;

abstract class Model
{
    public $attributes = [];  // in this array we keep the properties of the model that is identical to
                              // columns names of the appropriate table in the database
    public $errors = []; // to collect the errors
    public $rules = []; // this array is for data validation rules

    public function __construct()
    {
        // here we organsie connection to the database
        //We create un instance of the object Db
        Db::instance();
    }
}