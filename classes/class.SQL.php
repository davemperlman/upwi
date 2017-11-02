<?php
	namespace classes;
	use PDO;

	/**
	* Serves functionality for all Database related actions. CRUD, Validation, Etc.
	*/
	class SQL
	{
		static $connection;
		
		// Creates a PDO connection.
		private static function connect() 
		{
			self::$connection = new PDO('mysql:dbname=curran_test;host.127.0.0.1', 'root', 'root');
			return self::$connection;
		}

		// Retrieves information from the database with an option to return only a single row.
		public static function get($query, $single = null)
		{
			if ( isset($single) ) 
			{
				$result = self::connect()->query($query)->fetch(PDO::FETCH_ASSOC);
				return $result;
			}else{
				$result = self::connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
		}

		// Validates user credentials.
		public static function validate($username, $password) {
			$result = self::get("SELECT id FROM Employees WHERE username = '$username' AND password = '$password'", 1);
			return $result;
		}
		
	}