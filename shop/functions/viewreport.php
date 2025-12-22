<?php
	require_once '../settings/config.php';
	function getData($data){
		$data = trim($data);
		$data = htmlspecialchars($data);
		$data = stripcslashes($data);
		return $data;
	}

?>