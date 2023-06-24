<?php

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

//require 'vendor/autoload.php';

//$pic_password = $_COOKIE['inpass'];

$email = $_COOKIE['inemail'];


// echo $email;
// echo $pic_password;


// database connection

$conn = new mysqli('localhost','root','','user');

if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $sql = "SELECT * FROM users WHERE email = '".$email."'"; 
   
 
    $result = $conn->query($sql);
    
    if(!$result){
        $errorMessage = "Invalid details";
        echo $errorMessage;
    }
    else{
        $row = $result->fetch_assoc();
        
        $return_arr = array("col_password" => $row["col_password"],
                "pic_password" =>  $row["pic_password"],
                "email" => $row["email"],
                "username" => $row["username"]);
            
        // Encoding array in JSON format
        echo json_encode($return_arr);
    
    }
}

?>