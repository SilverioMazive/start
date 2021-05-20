<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
if (isset($_SESSION['admin'])) {

 include "addimgprocess.php";
	
}
else {
	header("location: admin.php");
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
	<?php
			include "header.php";
		?>

		<main>
			<div class="container">
				<h2>Add a question...</h2>
				<form method="post" enctype="multipart/form-data" action="addimgprocess.php">

					<p>
						<label>Question</label>
						<input type="text" name="question" required="">
					</p>
					<p>
						<label>Artista IMG</label>
						<select name="imglink">
							<?php								 
								$sql = "select * from tbartist order by nome asc";
								$result = mysqli_query($conn, $sql);
								if(mysqli_num_rows($result)){
									while($row = mysqli_fetch_assoc($result)){
							?>
							<option value="<?php echo $row['img'] ?>"><?php echo $row['nome'] ?></option>
							<?php
									}
								}
							?>
						</select>
					</p>
					<p>
						<label>Choice #1</label>
						<input type="text" name="choice1" required="">
					</p>
					<p>
						<label>Choice #2</label>
						<input type="text" name="choice2" required="">
					</p>
					<p>
						<label>Choice #3</label>
						<input type="text" name="choice3" required="">
					</p>
					<p>
						<label>Choice #4</label>
						<input type="text" name="choice4" required="">
					</p>
					<p>
						<label>Choice #5</label>
						<input type="text" name="choice5" required="">
					</p>
					<p>
						<label>Level</label>
						<input type="number" name="level" required="">
					</p>
					<p>
						<label>Correct answer</label>
						<select name="answer">
                        <option value="a">Choice #1 </option>
                        <option value="b">Choice #2</option>
                        <option value="c">Choice #3</option>
                        <option value="d">Choice #4</option>
						<option value="e">Choice #5</option>
                    </select>
					</p>
					<p>
						<input type="submit" name="submit" value="Submit">
					</p>
				</form>
			</div>
		</main>

		

	</body>
</html>
