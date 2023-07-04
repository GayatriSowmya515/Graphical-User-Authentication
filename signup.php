<?php

$pic_password = $_COOKIE['uppass'];

// echo json_encode($data);
$username = $_COOKIE['upname'];
$email = $_COOKIE['upmail'];

// echo $username, $email;
// echo $pic_password;
function UniqueRandomNumbersWithinRange ($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$colors = ["#FF0000","#0000FF", "#00FF00", "#FFFF00", "#FFC0CB", "#8F00FF", "#000000",
            "#FFFFFF", "#808080", "#E75480", "#FFA500", "#006400", "#87CEEB"];

$pic_password_size = 4;
$random_numbers = UniqueRandomNumbersWithinRange(0, count($colors)-1, $pic_password_size);
$col_password = '';
$i=1;
foreach ($random_numbers as $number) {
    $cookie_name11 = "color".$i;
    $cookie_value11 = $colors[$number];
    setcookie($cookie_name11, $cookie_value11);
    $col_password .= $colors[$number];
    $i=$i+1;
}
// echo $col_password;



// database connection

$conn = new mysqli('localhost','root','','user');

function isExist($email,$conn){
    $sql1 = "SELECT * FROM users WHERE email = '".$email."'";

    $result1 = $conn->query($sql1)  ;

    if( mysqli_num_rows( $result1 ) > 0 ){
          return true;
    }
    return false;
}

if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else if(isExist($email,$conn)){
    echo "Invalid Details";
}
else{

    // if(empty($username)||empty($email)||empty($pic_password)||empty($col_password)){
    //     $errorMessage = "All the fields are required";
    //     echo $errorMessage;
    // }
    $sql = "INSERT INTO users(username,email,pic_password,col_password) 
    VALUES('" . $username . "','" . $email . "','" . $pic_password . "','" . $col_password . "')";
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
        $cookie_name11 = "username123";
            $cookie_value11 = $username;
            setcookie($cookie_name11, $cookie_value11);
            $_SESSION['userLogin'] = "Loggedin";
    }
        
}


?>
