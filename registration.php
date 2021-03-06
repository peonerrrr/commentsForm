

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href='css/bootstrap.css' crossorigin="anonymous">
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<title>Авторизация</title>
</head>
<body>
  
	<main>

      <p style="padding: 25px; text-align: right;"><a class="btn btn-success" href="/form-auth.php">Войти</a></p>
    <div class="container-form">
      <h1>Регистрация</h1>
      <form method="post" id="c-send" enctype=multipart/form-data>
      	<div class="form-group">
          Ваш логин
      		<input type="text" class="form-control" name='name' id='name' placeholder="Логин">
      	</div>
          <div class="form-group">
          Ваш телефон 
          <input type="text" class="form-control" maxlength="9" id='tel' name="tel" id="recaller" placeholder="(XX) XXX-XX-XX">
        </div>
        <div class="form-group">
          Ваш Email 
          <input type="email" class="form-control" name='mail' id='mail' placeholder="mail">
        </div>
      	<div class="form-group">
            Ваш пароль 
        		<input type="password" class="form-control" id='password' name="password" placeholder="Пароль" >
      	</div>
        <div class="form-group">
            Аватарка 
            <input type="file" class="form-control" id='avatar' name="avatar">
        </div>
         
        <button id="signup" class="btn btn-success" type="submit">Зарегистрироваться</button>
        <div class="alert" id="error"></div>
      </form>
      
    </div>
</div>
<style>
  
  .container-form{
    text-align: center;
    padding: 25px;
    position: absolute;
    width: 35%;
    left: 50%;
    top:50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    background-color: #fff;
    border-radius: 25px;
  }
  body{
    background-color: #eff4f8;

  }
  @media (max-width: 1000px){
    .container-form {
      width: 50%;
    }
  }
  @media (max-width: 750px){
    .container-form {
      width: 80%;
    }
  }
  @media (max-width: 450px){
    .container-form form p{
      width: 100%;
    }
  }
</style>
<script src="js/jQuery.min.js"></script>
<script src="js/script.js"></script>
</html>