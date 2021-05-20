<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
if (isset($_SESSION['admin'])) {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style1.css">
	</head>

	<body>
	<?php
			include "header.php";
		?>

		
	<h1> Todas Perguntas</h1>
	<table class="data-table">
		<caption class="title">
		
		<form action="allquestions.php" method="POST">
			<center><h3></h3></center>
			<center>
				<table>
					<tr>
						<td>Procurar</td>
						<td><input type="text" name="name" size="50"></td>
						<td><input type="submit" name="Procurar"></td>
					</tr>
				</table>
			</center>
		</form>

		</caption>
		<thead>
			<tr>
				<th>Q.NO</th>
				<th>Question</th>
				<th>Option1</th>
				<th>Option2</th>
				<th>Option3</th>
				<th>Option4</th>
				<th>Option5</th>
				<th>Correct Answer </th>
				<th>Level </th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
        
        <?php 
			
			if(isset($_POST['name']))
			{
				$name = $_POST['name'];
				$query = "SELECT * FROM tbjogoimagens WHERE question LIKE '%$name%' or level LIKE '%$name%'";
			}
			else
			{
				$query = "SELECT * FROM tbjogoimagens ORDER BY imagensid DESC limit 100";
			}			
           
            $select_questions = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_questions) > 0 ) {
            while ($row = mysqli_fetch_array($select_questions)) {
                $imagensid  = $row['imagensid'];
                $question = $row['question'];
                $option1 = $row['ans1'];
                $option2 = $row['ans2'];
                $option3 = $row['ans3'];
                $option4 = $row['ans4'];
				$option5 = $row['ans5'];
				$Answer = $row['correct_answer'];
				$level = $row['level'];
                echo "<tr>";
                echo "<td>$imagensid</td>";
                echo "<td>$question</td>";
                echo "<td>$option1</td>";
                echo "<td>$option2</td>";
                echo "<td>$option3</td>";
                echo "<td>$option4</td>";
				echo "<td>$option5</td>";
				echo "<td>$Answer</td>";
				echo "<td>$level</td>";
                echo "<td> <a href='editquestion.php?imagensid=$imagensid'> Edit </a></td>";
              
                echo "</tr>";
             }
         }
        ?>
	
		</tbody>
		
	</table>
</body>
</html>

<?php } 
else {
	header("location: admin.php");
}
?>


