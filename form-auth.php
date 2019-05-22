<!-- <?php require "auth.php"; ?> -->
   <!doctype html>
    <html lang="en">
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Страница авторизации(Тест)</title>
    </head>
    <body>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Авторизация</h1>
             <p><a href="/">На Главную</a></p>
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
            </form>
            <div class="alert alert-danger" style="display: none;"><?php echo $value[$i] ?></div>
        </div>
    </div>
</div>
  <script src="js/jQuery.min.js"></script>
    <script src="js/script.js"></script>
    </body>
</html>