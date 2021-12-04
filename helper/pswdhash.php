<?php

class CreateHash{

    // Hash password before store in database
    // $string = user password input
    // PASSWORD_DEFAULT = algorithm hash ref: https://www.phptutorial.net/php-tutorial/php-password_hash/
    function pswd_hash(string $string)
    {
        return password_hash($string, PASSWORD_DEFAULT);
    }
}