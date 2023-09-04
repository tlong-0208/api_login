<?php
class login{
    private $conn;
    
    //Question properties
    public $id_user;
    public $username;
    public $password;
    public $email;

    //connect db
    public function __construct($db){
        $this->conn = $db;
    }

    //read data
    public function read(){
        $query = "SELECT * FROM login_user ORDER BY id_user ASC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;

    }

    //show data
    public function show(){
        $query = "SELECT * FROM login_user where id_user=? LIMIT 1";
             
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_user);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->email = $row['email'];

    }

    //create data
    public function create(){
        $query = "INSERT INTO login_user SET username=:username, password=:password, email=:email";
        $stmt = $this->conn->prepare($query);  
        //clean data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));

        //bind data
        $stmt->bindParam(':username',$this->username);
        $stmt->bindParam(':password',$this->password);        
        $stmt->bindParam(':email',$this->email);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }

    //update
    public function update(){
        $query = "UPDATE login_user SET username=:username, password=:password, email=:email";
        $stmt = $this->conn->prepare($query);  
        //clean data
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));


        //bind data
        $stmt->bindParam(':username',$this->username);
        $stmt->bindParam(':password',$this->password);        
        $stmt->bindParam(':email',$this->email);


        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }
    //delete
    public function delete(){
        $query = "DELETE FROM login_user WHERE id_user=:id_user";
        $stmt = $this->conn->prepare($query);  
        //clean data
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));

        //bind data
        $stmt->bindParam(':id_user',$this->id_user);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }
}

?>