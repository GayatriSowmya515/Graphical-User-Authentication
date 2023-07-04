<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$pic_password = $_COOKIE['inpass'];

$email = $_COOKIE['inemail'];

$col_password = $_COOKIE['inputpassword'];




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
    if($row && $row["pic_password"] == $pic_password && $row["col_password"] == $col_password){
            
        $cookie_name11 = "username123";
        $cookie_value11 = $row["username"];
        setcookie($cookie_name11, $cookie_value11);
        $_SESSION['userLogin1'] = "Loggedin";
        echo "succesfully logged in";
    }
    else{
        $errorMessage = "Invalid details";
        echo $errorMessage;
    }
} catch(PDOException $error) {
    die('Connection Failed :'.$error->getMessage());
}

?>