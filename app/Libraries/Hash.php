<?php
namespace App\Libraries;

class Hash {
// Buat Hashing PWD
public static function make($input){
    return password_hash($input, PASSWORD_BCRYPT);
}

// match PWD
public static function verify($input, $db_password){
    if (password_verify($input, $db_password)) {
        return true;
    }else{
        return false;
    }

}

}

