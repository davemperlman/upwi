<?php
	require_once '../autoload.php';
	session_start();
	if ( $_GET['logout'] == 1 ) 
	{
		session_destroy();
		Classes\Navigator::redirect();
	}