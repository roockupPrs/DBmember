<?php
require_once "db/connect.php";
if(isset($_POST["submit"])){
    $id=$_POST["id"];
    $name=$_POST["name"];
    $sname=$_POST["sname"];
    $email=$_POST["email"];
    $movies_id=$_POST["movies_id"];

    $result=$controller->update($name,$sname,$email,$movies_id,$id);
    if($result){
        header("Location:index.php");
    }
}
?>