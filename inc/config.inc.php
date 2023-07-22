<?php

define("DB_HOST", "localhost");  
define("DB_USER", "root");  
define("DB_PASS", "password");  
define("DB_NAME", "job_board");  
define("DB_PORT", "3306");

// definition for log file
define('LOGFILE','log/error_log.txt');
ini_set("log_errors", TRUE);  
ini_set('error_log', LOGFILE); 


?>