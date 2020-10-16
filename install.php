<?php 
    // note this does not use connection.php as connection made at the time of creation
   $servername = 'localhost';
   $username = 'root';
   $password= '';
//note no Database mentioned here!
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS LearnPHP";
    $conn->exec($sql);
    //next 3 lines optional only needed really if you want to go on an do more SQL here!
    $sql = "USE LearnPHP";
    $conn->exec($sql);
    echo "DB created successfully";
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblUser;
    CREATE TABLE TblUser 
    (UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Gender VARCHAR(1) NOT NULL,
    Surname VARCHAR(20) NOT NULL,
    Forename VARCHAR(20) NOT NULL,
    Password VARCHAR(72) NOT NULL,
    House VARCHAR(20) NOT NULL,
    Year INT(2) NOT NULL,
    Role TINYINT(1))");
    $stmt1->execute();
    $stmt1->closeCursor(); 

    $stmt2 = $conn->prepare("DROP TABLE IF EXISTS TblSubjects;
    CREATE TABLE TblSubjects
    (SubjectID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Subjectname VARCHAR(20) NOT NULL,
    Teacher VARCHAR(20) NOT NULL)");
    $stmt2->execute();
    $stmt2->closeCursor();

    $stmt3 = $conn->prepare("DROP TABLE IF EXISTS TblPupilStudies;
    CREATE TABLE TblPupilStudies
    (Subjectid INT(4),
    Userid INT(4),
    Classposition INT(2),
    Classgrade CHAR(1),
    Exammark INT(2),
    Comment VARCHAR(255),
    PRIMARY KEY(Subjectid,Userid))");
    $stmt3->execute();
    $stmt3->closeCursor(); 
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    $stmt4 = $conn->prepare("INSERT INTO TblUser(UserID,Gender,Surname,Forename,Password,House,Year,Role)VALUES 
    (NULL,'M','Cunniffe','Robert',:hp,'StA',13,1),
    (NULL,'F','Strachan','Ally',:hp,'New',13,1),
    (NULL,'M','Smith','John',:hp,'Bramston',13,0),
    (NULL,'M','Jones','Davy',:hp,'Bramston',13,0),
    (NULL,'M','Patel','Nish',:hp,'Bramston',13,0)
    ");
    $stmt4->bindParam(':hp', $hashed_password);

    $stmt4->execute();
    $stmt4->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblSubjects(SubjectID,Subjectname,Teacher)VALUES 
    (NULL,'Maths','AMS'),
    (NULL,'Computing','RIC'),
    (NULL,'Latin','KEA')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
$conn=Null;
?>