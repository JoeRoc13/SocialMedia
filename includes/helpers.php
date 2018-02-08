<?php
/**
 * This is a helper file. Any helper functions / method names should be the following: function_name
 */

 if(!function_exists("get_real_ip"))
 {
   /**
    * Gets the real IP of the user
    * @return string IP address
    */
   function get_real_ip()
   {
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
     {
       $ip = $_SERVER['HTTP_CLIENT_IP'];
     }
     else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  //to check ip is pass from proxy
     {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     }
     else if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:8080")
     {
       $ip = file_get_contents('http://phihag.de/ip/');
     }
     else
     {
       $ip = $_SERVER['REMOTE_ADDR'];
     }

     return $ip;

   }

 }

 if(!function_exists("split_name"))
 {
   function split_name($name) {
     $parts = array();
     while ( strlen( trim($name)) > 0 ) {
       $name = trim($name);
       $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
       $parts[] = $string;
       $name = trim( preg_replace('#'.$string.'#', '', $name ) );
     }

     if (empty($parts)) {
       return false;
     }

     $parts = array_reverse($parts);
     $name = array();
     $name['first_name'] = $parts[0];
     $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
     $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

     return $name;
   }
 }

?>
