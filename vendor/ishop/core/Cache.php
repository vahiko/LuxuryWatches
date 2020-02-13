<?php


namespace ishop;

// This class is used to keep certain practical data in the cash in order to decrease the load to the database and server
// For exemple we can keep here the parts of menu like Categories or filters, read from database, each time we are not going to make a query
// to db to create the menu....
class Cache
{
    use TSingletone;

    // this function add something to cash
    public function set($key, $data, $seconds=3600){//data would be kept in different file with different names, $key id for file name
                                                    // $data is the data to cash, and $seconds is the time how long we keep data in the cash

        if($seconds){                               // if $seconds is 0 we do not cash the data
            $contents['data'] = $data;              // we keep data in an array
            $contents['end_time'] = time() + $seconds; // this is end time after wich data will be cleared
            if(file_put_contents(CACHE.'/'.md5($key).'.txt', serialize($contents))){ // we put data with end time into the cash fiile and generate the file name with md5 hashing to have a valide file name in the case if a user input not acceptable file name symbol
                                                                                                // when we use cash we will verifie end time, if it is old, we will erase it, and load from db and cash it again
                return true;
            }
        }
        return false; // by default the function returns false
    }

    // this function get something from casj
    public function get($key){
        $file = CACHE.'/'.md5($key).'.txt'; // we creat file path with help of $key used to create file name during cashing
        if(file_exists($file)){             // if cash exist we deserialize the content of the file
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time']){  //we check cash content end time, if it is ok we return the content
                return $content;
            }
            unlink($file);  // if end time is over we delete the file
        }
        return false;  // if file does not exist the function return false;
    }

    // this function delete a data from cash, for exemple if we add a category to db, then we need to delete the menu from cash, to create
    // it new from db with new category item added
    public function delete($key){  // to delete a file we use the key during creation of the file
        $file = CACHE.'/'.md5($key).'.txt';
        if(file_exists($file)){
            unlink($file);
        }
    }

}