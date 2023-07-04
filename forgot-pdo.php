<?php

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

//require 'vendor/autoload.php';

//$pic_password = $_COOKIE['inpass'];

$email = $_COOKIE['inemail'];


// echo $email;
// echo $pic_password;


// database connection

try  {
    $dsn = "mysql:host=localhost;dbname=user;charset=UTF8";
    
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $connection = new PDO($dsn, 'root', '', $options);
    $sql = "SELECT * 
            FROM users
            WHERE email = :email";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $row = $statement->fetch();
    if($row){
        $return_arr = array("col_password" => $row["col_password"],
                "pic_password" => $row["pic_password"],
                "email" => $row["email"],
                "username" => $row["username"]);
        
                // Encoding array in JSON format
        echo json_encode($return_arr);
    }
    else{
        $errorMessage = "Invalid details"; 
    
        echo $errorMessage;
    }
} catch(PDOException $error) {
    echo "connection error";
    die('Connection Failed :'.$error->getMessage());
}

?>