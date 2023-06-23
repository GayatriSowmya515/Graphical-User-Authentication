<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$pic_password = $_COOKIE['inpass'];

$email = $_COOKIE['inemail'];


// echo $email;
// echo $pic_password;


// database connection

$conn = new mysqli('localhost','root','','user');

if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{

    // if(empty($username)||empty($email)||empty($pic_password)||empty($col_password)){
    //     $errorMessage = "All the fields are required";
    //     echo $errorMessage;
    // }
    $sql = "SELECT * FROM users WHERE email = '".$email."'"; 
   
    // $stmt = $conn->prepare("INSERT INTO users(username,email,pic_password,col_password) 
    // VALUES(?, ?, ?, ?)");
    // $stmt->blind_param("ssss",$username,$email,$pic_password,$col_password);
    // $stmt->execute();
    // echo "registration sucessfully...";
    // $stmt->close();
    // $conn->close();
    $result = $conn->query($sql);
    
    if(!$result){
        $errorMessage = "Invalid query: ". $conn->error;
        echo $errorMessage;
    }
    else{
        $row = $result->fetch_assoc();
        if($row&&$row["isblocked"] == -1){
            echo  "Your account is blocked due to multiple failed attempts. 
            Please click on the link sent to your email to unblock your account";
        }
        else if($row && $row["pic_password"] == $pic_password){
            // Initialize cookie name
            //$cookie_name = "col_password";
            //$cookie_value = $row["col_password"];
            // echo "inside".$row["col_password"];
            // Set cookie
            //setcookie($cookie_name, $cookie_value);
            
            // if(!isset($_COOKIES[$cookie_name])) {
            //     echo "Cookie created | ";
            // }
            $return_arr = array("col_password" => $row["col_password"],
                    "pic_password" => $pic_password,
                    "email" => $row["email"],
                    "username" => $row["username"]);
            
                    // Encoding array in JSON format
            echo json_encode($return_arr);
        }
        else{
            $errorMessage = "Invalid details"; 
            
            if($row["isblocked"] == 10){
                $fromEmail = 'kayaackerman515@gmail.com';
                $toEmail = $email;
                $emailSubject = 'Account Blocked';
                $message = 'http://localhost:3000/block.php';
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
                try {
                    // Configure the PHPMailer instance
                    $mail->isSMTP();
                    $mail->Host = 'live.smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = '';
                    $mail->Password = '';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Set the sender, recipient, subject, and body of the message
                    $mail->setFrom($fromEmail);
                    $mail->addAddress($toEmail);
                    $mail->Subject = $emailSubject;
                    $mail->isHTML(true);
                    $mail->Body = "<p>Hello, your account have been blocked due to multiple failed login attempts.</p><p>Please click on the below link to unblock your account</p><p>Link: {$message}</p>";

                    // Send the message
                    $mail->send();
                } 
                catch (Exception $e) {
                        $errorMessage = "<p style='color: red;'>Oops, something went wrong. Please try again later</p>";
                }
                $row["isblocked"] = -1;
            }
            else{
                $update_sql = "UPDATE users SET isblocked = isblocked+1 Where email = ".$email;
                $conn->query($update_sql);
            }
            echo $errorMessage;
        }
    
    }
}

?>