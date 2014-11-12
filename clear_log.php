<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "logon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM log";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
echo "<meta http-equiv=\"refresh\" content=\"0;URL=log_page.php\">";

$conn->close();
?> 