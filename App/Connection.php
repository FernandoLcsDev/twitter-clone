<?php
	namespace App;

	class Connection {

		public static function getDb(){
			try{
				$conn = new \PDO(
					"mysql:host=localhost;dbname=twitterclone;charset=utf8",
					"fernando",
					"12345678@"
				);

				return $conn;

			}catch(\PDOException $e) {
				echo $e;
			}
		}

	}

?>