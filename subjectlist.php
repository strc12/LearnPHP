<!DOCTYPE html>
<html>
<head>
    <title>User Options</title>
</head>
<body>

<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT tblsubjects.Subjectname as sn, tbluser.surname as surn, tbluser.forename as fore FROM Tblpupilstudies 
INNER JOIN tblsubjects 
ON tblsubjects.SubjectID=tblpupilstudies.SubjectID
INNER JOIN tbluser on tbluser.UserID = tblpupilstudies.UserID 
ORDER BY SN ASC"
);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo($row['sn']." - " .$row['fore']." ".$row['surn']."<br>");
}
?>	

</body>
</html>