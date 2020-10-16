<?php
header('Location: users.php');
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	switch($_POST["role"]){
		case "Pupil":
			$role=0;
			break;
		case "Teacher":
			$role=1;
			break;
		case "Admin":
			$role=2;
			break;
	}
	$hashed_password = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
	$stmt = $conn->prepare("INSERT INTO TblUser (UserID,Gender,Surname,Forename,Password,House,Year,Role)VALUES (NULL,:gender,:surname,:forename,:password,:house,:year,:role)");
	$stmt->bindParam(':forename', $_POST["forename"]);
	$stmt->bindParam(':surname', $_POST["surname"]);
	$stmt->bindParam(':house', $_POST["house"]);
	$stmt->bindParam(':year', $_POST["year"]);
	$stmt->bindParam(':password', $hashed_password);
	$stmt->bindParam(':gender', $_POST["gender"]);
	$stmt->bindParam(':role', $role);
	$stmt->execute();
	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;
?>
