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
     else if ($_SERVER['HTTP_HOST'] == "localhost")
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

?>
