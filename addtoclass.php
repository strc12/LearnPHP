<?php
header('Location: pupildoessubject.php');
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	$stmt = $conn->prepare("INSERT INTO TblPupilStudies (SubjectID,UserID,Classposition, Classgrade, ExamMark,Comment)VALUES (:subjectid,:userid,NULL,NULL,NULL,NULL)");
	$stmt->bindParam(':subjectid', $_POST["subject"]);
	$stmt->bindParam(':userid', $_POST["student"]);
	$stmt->execute();
	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;
?>