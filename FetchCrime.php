<?php
header ('content-type: application/json');
//session_start();
// connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Prepare  SQL, preparing the SQL statement will prevent SQL injection.
if ( isset($_POST['CrimeCatagory'])){

    if ($stmt = $con->prepare('SELECT * FROM crimes WHERE CrimeCatagory = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['CrimeCatagory']);
        $stmt->execute();
        $result = $stmt->get_result();
        $result2 =$result->fetch_all(MYSQLI_ASSOC);
        echo(json_encode($result2));
    }
}
