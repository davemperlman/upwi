<?php
	session_start();
	require '../autoload.php';

	if ( !isset($_POST) || !isset($_FILES) || !isset($_SESSION['is_active']) )

	{

		Classes\Navigator::redirect();

	}

	$img = '';

	foreach ($_FILES as $key) 

	{

		for ($i=0; $i < count($key['tmp_name']) ; $i++) 

		{ 

			if (move_uploaded_file($key['tmp_name'][$i], '../_img/uploads/' . $key['name'][$i])) 

			{

				$img .= '_img/uploads/' . $key['name'][$i] . ',';

			}

		}

	}

	if ( !$img == '' ) 
	{
			Classes\SQL::set("UPDATE WorkOrders SET inventoryUsed = :inventory, photoLink = :img, description = :description, hoursWorked = :hours WHERE id = :id", array(
				'inventory'		=> $_POST['inventory'],
				'img'			=> $img,
				'description'	=> $_POST['work'],
				'hours' 		=> $_POST['hours'],
				'id'			=> $_POST['WOid']
			)
		);
	}else{
			Classes\SQL::set("UPDATE WorkOrders SET inventoryUsed = :inventory, description = :description, hoursWorked = :hours WHERE id = :id", array(
				'inventory'		=> $_POST['inventory'],
				'description'	=> $_POST['work'],
				'hours' 		=> $_POST['hours'],
				'id'			=> $_POST['WOid']
			)
		);
	}

	Classes\Navigator::redirect();

