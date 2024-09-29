<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    <style>
table{
animation: transitionIn-Y-bottom 0.5s;
 }
body{
background-image: url(bg.jpg);
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
background-position: center;
height: 100%;
}

html, body {
    height: 100%;
    margin: 0;
  }
  
.full-height {
    background: rgba(26, 26, 26, 0.548);
    background-attachment: fixed;
    max-height: 100vh;
    height: 100vh;


}
table{
    width: 100%;
    padding-top: 5px;
    
}
.heading-text{
    color: white;
    font-family: helvetica, sans-serif;
    font-size: 45px;
    font-weight: 700;
    line-height: 63px;
    margin-top: 15%;
    text-align: center;
    margin-bottom: 0;
}

.sub-text2{
    color: rgba(255, 255, 255, 0.822);
    font-family: helvetica, sans-serif;
    font-size: 27px;
    line-height: 45px;
    font-weight: 400;
    text-align: center;
    margin-top: 0;
}


.register-btn{
    background-color: rgba(240, 248, 255, 0.589);
    font-family: helvetica, sans-serif;
    color: #345cc4;
}


.logo{
    color: white;
    font-family: helvetica, sans-serif;
    font-weight: bolder;
    font-size: 50px;
    padding-left: 20px;
    animation: transitionIn-Y-over 0.5s;
}

.logo-sub{
    color: rgba(255, 255, 255, 0.733);
    font-family: helvetica, sans-serif;
    font-size: 35px;

}


.nav-item{
    background-color: #04AA6D;
    border: none;
    color: #ffffff;
    padding: 20px;
    font-family: helvetica, sans-serif;
    text-align: center;
    font-size: 25px;
    font-weight: 500;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 12px;
    transition-duration: 0.4s;
}

.nav-item:hover{
    background-color: #ffffff;
    color: #04AA6D;

}
.button {
  background-color: #04AA6D; 
  border: none;
  color: #ffffff;
  padding: 20px;
  font-family: helvetica, sans-serif;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 26px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 12px;
  transition-duration: 0.4s;
}
.button:hover {
    background-color: #ffffff;
    color: #04AA6D;
}

    </style>
        
</head>
<body>
    
    <div class="full-height">
        <center>
        <table border="0">
            <tr>
                <td width="80%">
                    <font class="logo">AW-K9 </font>
                    <font class="logo-sub">| Petshop & Grooming Station</font>
                </td>
                <td width="10%">
                   <a href="login.php"  class="non-style-link"><p class="nav-item">LOGIN</p></a>
                </td>
                <td  width="10%">
                     <a href="register.php" class="non-style-link"><p class="nav-item" style="padding-right: 10px;">REGISTER</p></a>
                </td>
            </tr>
            <tr>
                <td  colspan="3">
                    <p class="heading-text">Less hassle, more happiness.</p>
                </td>
            </tr>
            <tr>
                <td  colspan="3">
                    <p class="sub-text2">Book now your grooming for dogs and cats <br> Book now for your Dog hotel reservation needs</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <center>
                    <a href="login.php">
                        <input type="button" value="Grooming" class="button" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </a>
                    
                    <a href="login.php">
                        <input type="button" value="Dog Hotel" class="button" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </a>
                </center>
                </td>
                
            </tr>
            <tr>
                <td colspan="3">
                   
                </td>
            </tr>
        </table>
    </center>
    </div>
</body>
</html>