<?php 
    if($_POST){
        $u=$_POST["username"];
        $p=$_POST["password"];
        $conn = new mysqli("localhost", "root", "", "100kasa");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $result=$conn->query("select * from users where username='$u' && password='$p'");

        if($result->num_rows>0){
           
            $_SESSION=array(
                "username"=>$u,
                "password"=>$p,
                "login"=>true
            );
            header("Refresh:0");
        }
        $conn->close();
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Giriş Yap</title>

   
    <style>
        html,
        body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="">
      
      <h1 class="h3 mb-3 font-weight-normal">Giriş Yap</h1>
      <label for="inputEmail" class="sr-only">Kullanıcı Adı</label>
      <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Kullanıcı Adı" required autofocus>
      <label for="inputPassword" class="sr-only">Şifre</label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Şifre" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
      <p class="mt-5 mb-3 text-muted">&copy;2018</p>
    </form>
  </body>
</html>