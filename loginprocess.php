<?php
<<<<<<< HEAD
=======
session_start(); 
>>>>>>> 41df9e1a9d3a1f93c5abfb3febc5c9c0f6d6604d
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);
$stmt = $conn->prepare("SELECT * FROM tbluser WHERE surname =:username ;" );
$stmt->bindParam(':username', $_POST['Username']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
<<<<<<< HEAD
    if($row['Password']== $_POST['Pword']){
        
        header('Location: addusers.php');
    }else{

=======
    $hashed= $row['Password'];
    $attempt= $_POST['Pword'];
    if(password_verify($attempt,$hashed)){
        $_SESSION['name']=$row["Surname"];
        if (!isset($_SESSION['backURL'])){
            $backURL= "/";
        }else{
            $backURL=$_SESSION['backURL'];
        }
        unset($_SESSION['backURL']);
        header('Location: ' . $backURL);
    }else{
>>>>>>> 41df9e1a9d3a1f93c5abfb3febc5c9c0f6d6604d
        header('Location: login.php');
    }
}
$conn=null;
?>
