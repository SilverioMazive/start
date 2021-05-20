<?php
if (isset($_POST['submit']))
{
	//database connection
	include('connection.php');
	include('sanitise.php');

	$grade_id = sanitise ($_POST['grade_id']);
	$id = sanitise ($_POST['id']);
	//$submit = ($_POST['submit']);

	//record insertion
	$sql = array();
	foreach($id as $row) 
	{
		$sql[] = '("' . sanitise($row['grade_id']) . '", ' . $row['id'] . ')';
	}
	mysql_query('INSERT INTO tbl_sal (grade_id, id) VALUES ' . implode(',', $sql));

}
?>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if ($conn->multi_query($sql) === TRUE) 
{
  echo "New records created successfully";
} 
else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
require_once("connection.php");
$sql = "INSERT INTO results (id,swim_rank) VALUES ";
for ($i = 0; $i < 7; $i++) {
    $sql .= "('".$id1[$i]."','".$timeRank1[$i]."'),";
}
rtrim($sql, ',');
// run your query here

$result = mysqli_query($con, $sql); 
if ( false===$sql ) { 
printf("error: %s\n", mysqli_error($con)); 
}
else
{
	//A cena certa
}

?>