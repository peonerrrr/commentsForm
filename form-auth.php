<!-- <?php require "auth.php"; ?> -->
   <!doctype html>
    <html lang="en">
    <head>
    <link rel="stylesheet" href='css/bootstrap.css' crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Страница авторизации(Тест)</title>
    </head>
    <body>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form">
                <h1 style="text-align: center;">Авторизация</h1>
         
                <div class="links">   
                    <p><a class="btn btn-primary" href="/">На Главную</a></p>
                    <p><a class="btn btn-primary" href="/registration.php">Регистрация</a></p>
                </div>

                <form id="authForm" action="auth.php" method="post" enctype=multipart/form-data>

                    <div class="form-group">Имя
                        <input id="comName" type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">Пароль
                        <input id="password" type="password" name="password" class="form-control"></input>
                    </div>

                    <div class="form-group">
                        <button id="btn_add" class="btn btn-success" type="submit">Вход</button>
                    </div>
                    <div class="alert alert-danger" style="display: none;"><?php echo $value[$i] ?></div>
                </form>

            </div>
        </div>
            
    </div>
</div>
  <script src="js/jQuery.min.js"></script>
    <script src="js/script.js"></script>
    </body>
</html>