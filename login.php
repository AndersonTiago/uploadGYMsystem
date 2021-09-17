<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="img/img_logo_login.jpg" class="w-75 img_login" alt="Logo"></span><br/>
            <span class="logo_title mt-5">GYM SYSTEM</span>
        </div>
        <div class="card-body">
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" id="login" class="form-control" placeholder="Email">
            </div>

            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" id="senha" class="form-control" placeholder="Password">
            </div>

            <div class="form-group">
                <button name="btn" id="btn_login" class="btn btn-outline-danger login_btn">Login</button>
            </div>

            <div id="msg_login"></div>
        </div>

    </div>
</div>

<link href="./css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="./js/bootstrap.min.js"></script>
<script src="./js/jquery-3.2.1.min.js"></script>
<script src="./backend/login/app.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"> 
</body>
</html>