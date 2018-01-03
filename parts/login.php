<?php
	require_once '../autoload.php';
	// If credentials have been posted, run the validation.
	if ( isset($_POST) ) 
	{
		// If validated, create new session and direct to home.php.
		if ( Classes\SQL::validate( $_POST['username'], $_POST['password'] ) )
		{
			session_start();
			$_SESSION['is_active'] = true;
			$_SESSION['id'] = Classes\SQL::validate($_POST['username'], $_POST['password'])['id'];
			Classes\Navigator::redirect('/clients/upwi/home.php');
		}else{
			// If not validated, return to login.
			Classes\Navigator::redirect();
		}
	}else{
		// If no credentials, return to login.
		Classes\Navigator::redirect();
	}
	