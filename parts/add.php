<?php
	require_once '../autoload.php';
	session_start();
	if ( $_SESSION['is_active'] != true ) {
		Classes\Navigator::redirect();
	}

	print_r($_POST);
	if ($_POST['newJob']) {
		Classes\SQL::set('INSERT INTO Jobs (customerFirst, customerLast, customerAddress, customerPhone, customerEmail, description, created) VALUES (:first, :last, :address, :phone, :email, :description, :created)', array(
			'first'			=> $_POST['customerFirst'],
			'last'  		=> $_POST['customerLast'],
			'address' 		=> $_POST['customerAddress'],
			'phone'			=> $_POST['customerPhone'],
			'email'			=> $_POST['customerEmail'],
			'description'	=> $_POST['description'],
			'created'		=> time	

		));
	}


