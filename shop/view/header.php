<?php include '../functions/account.php'; ?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 
	'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en' data-bs-theme='auto'>
	<head>
	    <meta charset='utf-8'>
	    <meta name='viewport' content='width=device-width, initial-scale=1'>
	    <meta name='description' content=''>
	    <meta name='author' content='Benit Solutions'>
	    <meta name='generator' content='Astro v5.9.2'>
		    <?php 
		    	if ($res->num_rows > 0){ 
		    		while($row = $res->fetch_assoc()) {
		    			echo"<title>Dashboard · ". $row['Institution_name'] ." ch v5.3</title>";
		    		}
		    	}else{
		    		echo "<title>Dashboard · company v5.3</title>";
		    	}
		    ?>
	    <link rel='canonical' href='https://benitapollosolutions/products/'>
	    <script src='/products/shop/assets/js/color-modes.js'></script>
	    <script src='/products/shop/assets/js/jquery-3.7.1.min.js'></script>
	    <link href='/products/shop/assets/dist/css/bootstrap.min.css' rel='stylesheet'>
	    <meta name='theme-color' content='#712cf9'>
	    <link href='/products/shop/pos/dashboard.css' rel='stylesheet'>
	    <style>
	      .bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;user-select:none}
	      @media (min-width: 768px){.bd-placeholder-img-lg{font-size:3.5rem}}
	      .b-example-divider{width:100%;height:3rem;background-color:#0000001a;border:solid rgba(0,0,0,.15);border-width:1px 0;box-shadow:inset 0 .5em 1.5em #0000001a,inset 0 .125em .5em #00000026}
	      .b-example-vr{flex-shrink:0;width:1.5rem;height:100vh}
	      .bi{vertical-align:-.125em;fill:currentColor}
	      .nav-scroller{position:relative;z-index:2;height:2.75rem;overflow-y:hidden}
	      .nav-scroller .nav{display:flex;flex-wrap:nowrap;padding-bottom:1rem;margin-top:-1px;overflow-x:auto;text-align:center;white-space:nowrap;-webkit-overflow-scrolling:touch}
	      .btn-bd-primary{--bd-violet-bg: #712cf9;--bd-violet-rgb: 112.520718, 44.062154, 249.437846;--bs-btn-font-weight: 600;--bs-btn-color: var(--bs-white);--bs-btn-bg: var(--bd-violet-bg);--bs-btn-border-color: var(--bd-violet-bg);--bs-btn-hover-color: var(--bs-white);--bs-btn-hover-bg: #6528e0;--bs-btn-hover-border-color: #6528e0;--bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);--bs-btn-active-color: var(--bs-btn-hover-color);--bs-btn-active-bg: #5a23c8;--bs-btn-active-border-color: #5a23c8}
	      .bd-mode-toggle{z-index:1500}
	      .bd-mode-toggle .bi{width:1em;height:1em}
	      .bd-mode-toggle .dropdown-menu .active .bi{display:block!important}
	    </style>
    	<link rel='stylesheet' href='/products/shop/assets/DataTables/datatables.css' />
		<script src='/products/shop/assets/DataTables/datatables.js'></script>
		<script src='https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.min.js'></script>
		<script src='https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js'></script>
  	</head>
	<body>