<?php
   $dsn = 'mysql:host=localhost;dbname=sales';
   $username = 'root';
   $password = '';
   $options = array(
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
   try {
      $dbc = new PDO($dsn, $username, $password, $options);
      $dbc->setAttribute( PDO::ATTR_PERSISTENT, true );
      $dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      exit();
   }
   
 ?>