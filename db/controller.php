<?php
class Controller{
    private $db;

    function __construct($con){
        $this->db=$con;
    }

    function getBook(){
        try{
            $sql = "SELECT * FROM movies";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function getMember(){
        try{
            $sql = "SELECT * FROM member a INNER JOIN movies b ON a.movies_id = b.movies_id ORDER By a.id";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }  
    }
    
    function insert($name,$sname,$email,$movies_id){
        try{
            $sql="INSERT INTO member(name,sname,email,movies_id) VALUES (:name,:sname,:email,:movies_id)";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":name",$name);
            $stmt->bindParam(":sname",$sname);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":movies_id",$movies_id);   
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
    function delete($id){
        try{
            $sql="DELETE FROM member WHERE id=:id ";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    function getMemberDetail($id){
        try{
            $sql="SELECT * FROM member a 
            INNER JOIN movies b
            ON a.movies_id = b.movies_id WHERE id =:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    function update($fname,$sname,$email,$movies_id,$id){
        try{
            $sql="UPDATE member 
            SET name=:name, sname=:sname, email=:email, movies_id=:movies_id 
            WHERE id = :id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":name",$fname);
            $stmt->bindParam(":sname",$sname);
            $stmt->bindParam(":email",$email);
            $stmt->bindParam(":movies_id",$movies_id);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}




?>