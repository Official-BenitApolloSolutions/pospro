<?php
  if (isset($_SESSION['user_role'])) {
    $user_role = $_SESSION['user_role'];
  }
  
  switch ($user_role) {
    case 'administrator':
      include 'sidebar_adminpage.php';
      break;
    case 'sales agent':
      include 'sidebar_page.php';
      break;
    
    default:
      echo 'nothing to show';
      break;
  }
?>