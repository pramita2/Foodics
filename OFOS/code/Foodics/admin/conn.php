<?php
	function connection(){

			$servername = "localhost";
			$username = "root";
			$password = "";
			$db="foodics";

		// Create connection
			$conn = new mysqli($servername, $username, $password,$db);
			//echo"hii";

		// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}

			return $conn;

		}
		function conn_close($conn){
			$conn->close();
}









































?>