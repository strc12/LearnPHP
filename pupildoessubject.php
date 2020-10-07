<?php
session_start(); 
if (!isset($_SESSION['name']))
{   
  $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
}
?>
<html>
<title>Subjects</title>
    
</head>
<body>
   <form action="addtoclass.php" method="post">
   <select name = "student">
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM TblUser WHERE Role = 0 ORDER BY Surname ASC");
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo('<option value='.$row["UserID"].'>'.$row["Surname"].', '.$row["Forename"].'</option>');
}
echo ("</select>");
echo ("<select name = 'subject'>");
$stmt = $conn->prepare("SELECT * FROM TblSubjects  ORDER BY Subjectname ASC");
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo('<option value='.$row["SubjectID"].'>'.$row["Subjectname"].'</option>');
}
?>
</select>
<input type="submit" value="Add pupil to subject">
</body>
</html>