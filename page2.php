<?php
$username = $_COOKIE['username123'];
$color1 = $_COOKIE['color1'];
$color2 = $_COOKIE['color2'];
$color3 = $_COOKIE['color3'];
$color4 = $_COOKIE['color4'];
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
    <!-- <link rel="stylesheet" href="./assets/styles.css"> -->
  

    <title>Landing Page</title>

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
  height: 50px;
}

.row123 div {
  width: 20%;
}

.noMargin123 {
  margin: 0px;
}

.one1 {
  background-color: <?php echo $color1; ?>;
}

.two2 {
  background-color: <?php echo $color2; ?>;
}

.three3 {
  background-color: <?php echo $color3; ?>;
}

.four4 {
  background-color: <?php echo $color4; ?>;
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
    margin-top: 20px;
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
            <p class="intro-text">Sucessfully logged in</p>
        
      </div>
        <section class="container">
        <div class="Sucess"></div>
        <div class="error-message-container">
          <p id="greeting" class="error-heading"></p>
          <p class="error-text">Welcome, Please remember your password</p>
          <div class="row123 noMargin123">
                <div class="one1"></div>
                <div class="two2"></div>
                <div class="three3"></div>
                <div class="four4"></div>
          </div>
         
          <div class="button">
            <a href="index.html">logout</a>
          </div>
        </div>
        </section>
      
    </main>
    <script>
        function getCookies() {
            const phpecho="<?php echo "Hello, ".$username; ?>";
            document.getElementById("greeting").innerHTML = phpecho;
        }
        
        
    </script>
  </body>
</html>
