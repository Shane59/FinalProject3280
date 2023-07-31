<?php

define("DB_HOST", "job-board-app-server.mysql.database.azure.com");  
define("DB_USER", "shinya");  
define("DB_PASS", "Guridon0320!");  
define("DB_NAME", "job-board-app-database");  
define("DB_PORT", "3306");

// definition for log file
define('LOGFILE','log/error_log.txt');
ini_set("log_errors", TRUE);  
ini_set('error_log', LOGFILE); 


?>