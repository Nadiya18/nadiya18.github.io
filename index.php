<?php
session_start();
include "layout/header.php";
	include "layout/left_menu.php";
	if(isset($_GET['action'])) {
		$action=$_GET['action'];
	}
	else
	{
		$action="main";
	}

	if(file_exists("views/$action.php"))
	 {
		include "views/$action.php";
	}
	else{
		include "views/main.php";
	}
	include "layout/footer.php";
	?>



