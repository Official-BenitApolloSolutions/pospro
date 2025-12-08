<?php
	if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
    }

    $conn = new mysqli("localhost","root","","sales");
    $res = mysqli_query($conn, 'SELECT * FROM account');
    $rowsnum = mysqli_num_rows($res);
?>