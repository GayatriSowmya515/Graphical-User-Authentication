<?php
$username = $_COOKIE['username123'];
// session_start();
// if(empty($_SESSION['userLogin1']) || $_SESSION['userLogin1'] == ''){
//     header("Location: http://localhost:3000");
//     die();
// }
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
            <p class="intro-text">Sucessfully logged in</p>
        
      </div>
        <section class="container">
        <div class="Sucess"></div>
        <div class="error-message-container">
          <p id="greeting" class="error-heading"></p>
          <!-- <p class="error-text">The page you are looking for might be removed or is temporarily unavailable
          </p> -->
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
