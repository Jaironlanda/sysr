<?php
class Url{
    
    /**
     * Retrive base url a.k.a domain name
     * ref: https://stackoverflow.com/questions/17201170/php-how-to-get-the-base-domain-url/17201261
     * @return string
     */
    public function base_url()
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 

        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 

        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,8))=='https'?'https':'http';

        // return: http://localhost/myproject/
        return $protocol.'://'.$hostName.$pathInfo['dirname']."/";
    }
}