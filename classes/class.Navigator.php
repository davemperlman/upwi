<?php
	/**
	* Serves functionality for all inclusivity and header actions. Primary purpose is to provide a means
	* of organizing session functions and file inclusions to avoid header errors.
	*/
	namespace Classes;
	class Navigator
	{

		// Sets location header to specified location or document root by default.
		static public function redirect($location = '/clients/upwi') 
		{
			header("Location: $location");
		}

		static function onLoad($public = false) 
		{

			// Start a Session
			session_start();

			// Determine if page can be viewed by anyone.
			if ($public == true) 
			{

				// Require Header File
				require_once 'parts/header.php';
				return;

			}else{

			// If session isn't active, redirect to login.
				if (!$_SESSION['is_active']) {
					self::redirect('/clients/upwi'); // Root of project directory

				}else{

					// Require Header File
					require_once 'parts/header.php';
					return;

				}

			}

		}

		public static function get_footer() {
			require_once 'parts/footer.php';
			return;
		}
		
	}