<?php
session_start();

class Connection{
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "jewelry_db";
  public $conn;

  public function __construct(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
}

class Register extends Connection{
  public function registration($name, $email, $password, $confirmpassword, $contact, $avatar, $address){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
      return 10;
      // Username or email has already taken
    }
    else{
      if($password == $confirmpassword){
        $query = "INSERT INTO users (name, email, password, contact, avatar, address, type) VALUES ('$name', '$email', '$password', '$contact', '$avatar', '$address', 2)";
        mysqli_query($this->conn, $query);
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("location: profile.php");
        return 1;
        // Registration successful
      }
      else{
        return 100;
        // Password does not match
      }
    }
  }
}

class Login extends Connection{
  public $id;
  public function login($email, $password){
    $admin = mysqli_query($this->conn, "SELECT id, name FROM users WHERE email = '$email' AND password = '$password' AND type=1");
    $result = mysqli_query($this->conn, "SELECT id, name, password FROM users WHERE email = '$email' AND password = '$password' AND type=2");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($admin) > 0){
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      header("location: ../crud3/crud3/dashbordHome.php");
    }
    if(mysqli_num_rows($result) > 0){
      if(!empty($row) && $password == $row["password"]){
        $this->id = $row["id"];
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("location: profile.php");
        return 1;
        // Login successful
      }
      else{
        return 10;
        // Wrong password
      }
    }
  }

  public function idUser(){
    return $this->id;
  }
}

class Select extends Connection{
  public function selectUserById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
} 