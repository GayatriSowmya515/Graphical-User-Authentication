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



function isExist($email,$connection){
    $sql = "SELECT * 
            FROM users
            WHERE email = :email";


    $statement = $connection->prepare($sql);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
    if ($result && $statement->rowCount() > 0) { 
        return true;
    }
    else{
        return false;
    }
}

// database connection


try  {
    
    $dsn = "mysql:host=localhost;dbname=user;charset=UTF8";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $connection = new PDO($dsn, 'root', '', $options);

    if(isExist($email,$connection)){
        echo "Invalid Details";
    }
    else{
    
        // $new_user = array(
        //     "username" => $username,
        //     "email"     => $email,
        //     "pic_password"  => $pic_password,
        //     "col_password"  => $col_password
        // );

        $sql = "INSERT INTO users(username,email,pic_password,col_password) 
        VALUES('" . $username . "','" . $email . "','" . $pic_password . "','" . $col_password . "')";
    
    
        $statement = $connection->prepare($sql);
        $statement->execute();

        $cookie_name11 = "username123";
            $cookie_value11 = $username;
            setcookie($cookie_name11, $cookie_value11);
            $_SESSION['userLogin'] = "Loggedin";
    }
} catch(PDOException $error) {
    $errorMessage = "Invalid query";
    echo $errorMessage;
}




?>
