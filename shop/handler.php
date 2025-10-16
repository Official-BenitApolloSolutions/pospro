<?php
   require './settings/config.php';
   $user_role = 'user role name';
   $_SESSION['company_name'] = "Your Company";
   if (isset($_POST['submit'])) {
         session_start();
         $email = $_POST['email'];
         $password = $_POST['password'];
         if ($email === "admin@pos.com") {
            $_SESSION['user_role'] = "administrator";
            $user_role = $_SESSION['user_role'];
         }elseif ($email === "sales@pos.com") {
            $_SESSION['user_role'] = "sales agent";
            $user_role = $_SESSION['user_role'];
         }
         $_SESSION['user'] = "John Doe";
         header('Location: ./pos/index.php?user_role='. urlencode($user_role));
   }
?>