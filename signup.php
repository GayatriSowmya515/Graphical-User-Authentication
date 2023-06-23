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

if ($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
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
    }
        
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1,
  maximum-scale=5"
    />

    <link rel="icon" href="./assets/images/devchallenges.png" />
  
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="https://devchallenges.io/"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/styles.css">
  

    <title>Error Page Devchallenges</title>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Inconsolata" );
@import url("https://fonts.googleapis.com/css?family=Space Mono");
@import url("https://fonts.googleapis.com/css?family=Montserrat");
* {
    padding: none;
    margin: none;
    box-sizing: border-box;
    text-decoration: none;
    list-style: none;

}

:root {
    --Scarecrow: url("https://raw.githubusercontent.com/Petsamuel/error-page/main/assets/images/Scarecrow.png");
    --Sucess: url("/success.png");
    --font1: "Inconsolata";
    --line-height: 36px;
    --letter-spacing: -0.035em;
    --text-color: #4F4F4F;
}
main{
    height:screen;
    padding:0px 5%;
    box-sizing: border-box;
    height:100%;
}

.row123 {
  display: flex;
  width: 100%;
}

.row123 div {
  width: 30%;
}

.noMargin123 {
  margin: 0px;
}

.one1 {
  background-color: red;
}

.two2 {
  background-color: yellow;
}

.three3 {
  background-color: green;
}

.four4 {
  background-color: blue;
}

.intro-text {
    font-weight: 700;
    font-size: 24px;
    line-height: 25px;
    letter-spacing: -0.08em;
    text-transform: uppercase;
    color: #333333;
    margin-bottom:5%;
}

.intro-text {
    font-family: var(--font1);
}

.container {
    display: flex;
    justify-content: space-between;
    gap:10%;
}

.Scarecrow {
    content: var(--Scarecrow);
    width: 50%;
}

.Sucess {
    content: var(--Sucess);
    width: 50%;
}



.error-text {
    font-family: 'Space Mono';
    font-style: normal;
    font-weight: 400;
    font-size: 24px;
    line-height: 36px;
    letter-spacing: -0.035em;
    color: #4F4F4F;
}

.error-heading {
    font-family: 'Space Mono';
    font-style: normal;
    font-weight: 700;
    font-size: 48px;
    line-height: 71px;
    letter-spacing: -0.035em;
    color: #333333;
}

.button {
    width: 216px;
    height: 68px;
    background: #333333;
    font-family: 'Space Mono';
    display:flex;
    justify-content: center;

}
a {
    color: white;
    font-style: normal;
    font-weight: 700;
    font-size: 14px;
    line-height: 21px;
    letter-spacing: -0.035em;
    text-transform: uppercase;
    align-self: center;
     
}
footer{
        display:flex;
        justify-content:center;
        text-align:center;
        position:relative;
        bottom:0px;
        padding: 1rem;
    }
    .footer-text{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 17px;
    color: #BDBDBD;
    }

@media screen and (max-width:360px),
(max-width:750px) {
    .Scarecrow {
        content: var(--Scarecrow);
        width: 100%;
      text-align:center;
    }

    .Sucess {
        content: var(--Sucess);
        width: 100%;
      text-align:center;
    }
    

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;

      
        
    }

    .error-heading {
        font-size: 28px;
        line-height: 71px;

    }

    .error-text {
        font-family: 'Space Mono';
        font-style: normal;
        font-weight: 400;
        font-size: 18px;
        line-height: 27px;
    }

    .button {
        width: 216px;
        height: 68px;
        background: #333333;
        display:flex;
        text-align: center;
    }

    a {
        color: white;
        font-style: normal;
        font-weight: 700;
        font-size: 14px;
        line-height: 21px;
        letter-spacing: -0.035em;
        text-transform: uppercase;
        align-self: center;
        
    }
   
}

    </style>

  </head>
  <body onload="getCookies()">
    <main>
      <div class="intro-text-container">
        <?php if($conn->connect_error || !$result) : ?>
            <p class="intro-text">Error occurred please signup again</p>
        <?php else : ?>
            <p class="intro-text">Sucessfully logged in</p>
        <?php endif; ?>
        
      </div>
      <?php if($conn->connect_error || !$result) : ?>
        <section class="container">
        <div class="Scarecrow"></div>
        <div class="error-message-container">
          <!-- <p id="greeting" class="error-heading"></p> -->
          <p class="error-text">The page you are looking for might be removed or is temporarily unavailable
          </p>
          <div class="button">
            <a href="index.html">Go back to signup page</a>
          </div>
        </div>
        </section>
      <?php else : ?>
        <section class="container">
        <div class="Sucess"></div>
        <div class="error-message-container">
          <p id="greeting" class="error-heading"></p>
          <div class="row123 noMargin123">
                <div class="one1"></div>
                <div class="two2"></div>
          </div>
          <div class="row123 noMargin123">
                <div class="three3"></div>
                <div class="four4"></div>
          </div>
          <div class="button">
            <a href="index.html">logout</a>
          </div>
        </div>
        </section>
      <?php endif; ?>
      
    </main>
    <script>
        function getCookies() {
            const phpecho="<?php echo "Hello, ".$username; ?>";
            let strvar="String = "+phpecho;
            document.getElementById("greeting").innerHTML = strvar;
        }
        
        
    </script>
  </body>
</html>
