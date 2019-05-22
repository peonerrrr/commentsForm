<?php session_start();
  require "sort.php";
    ?>
    <!doctype html>
    <html lang="en">
    <head>
    <link rel="stylesheet" href='css/bootstrap.css' crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Страница комментариев(Тест)</title>
    </head>
    <body>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <h1>Список комментариев</h1>
            <div class="sort-block">Сортировка по:
                <form id='sortForm' action='/' method='post' onchange="$(this).submit()">
                     <select name='select'>
                        <option value='dateAsc'>по дате(Последний внизу)</option>
                        <option value='dateDesc'>по дате(Последний Вверху)</option>
                        <option value='name'>по имени</option>
                        <option value='email'>по e-mail</option>
                    </select>
                </form>
            </div>
            
            <ul class="comments-list">
            <?php if ($_SESSION['user']['userName'] === 'admin'): ?>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <div class="comment-body">
                            <div class="image-wrapper">
                                <img src="<?php echo $comment['image'] ?>">
                            </div>
                            <div class="person-info-block">
                                <b><?php echo $comment['name']; ?></b>
                                <p class="comments-email"><?php echo $comment['email']; ?></p>
                                <p class="comment-date"><?php echo $comment['date'] ?></p>
                            </div>
                            <div class="comments-text">
                                <p><?php echo $comment['text']; ?></p>
                            </div>
                        </div>
                        <div class="comment-action">
                            <a class="btn btn-danger delete" href="delete.php?id=<?php echo $comment['id']; ?>">Удалить</a>
                        </div>
                    </li>
                <?php endforeach ?>
             <?php else: ?>
                    <?php foreach ($comments as $comment): ?>

                    <li>
                        <div class="comment-body">
                            <div class="image-wrapper">
                                <img src="<?php echo $comment['image'] ?>">
                            </div>
                            <div class="person-info-block">
                                <b><?php echo $comment['name']; ?></b>
                                <p class="comments-email"><?php echo $comment['email']; ?></p>
                                <p class="comment-date"><?php echo $comment['date'] ?></p>
                            </div>
                            <div class="comments-text">
                                <p><?php echo $comment['text']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
            </ul>
        </div>
    </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Добавить комментарий</h1>
            <?php if (!$_SESSION['user']['userName']): ?>
             <div class="links">   
                    <p><a class="btn btn-success" href="/form-auth.php">Вход</a></p>
                    <p><a class="btn btn-primary" href="/registration.php">Регистрация</a></p>
                </div>
             <div id="errors-block" class="alert alert-danger" style="display: none;"></div>
            <form id="addComment" action="store.php" method="post" enctype=multipart/form-data>

                <div class="form-group">Имя
                    <input id="comName" type="text" class="form-control" name="comName" value="<?php echo $_POST['comName'] ?>">
                </div>

                <div class="form-group">E-mail
                    <input id="comEmail" type="email" name="comEmail" class="form-control"></input>
                </div>

                <div class="form-group">Сообщение
                    <textarea id="comText" name="comText" class="form-control"></textarea>
                </div>
                <div class="form-group">Фото
                   <input id="comImage" type="file" name="comImage" class="form-control"></input>
               </div>
                    <input id="comDate" type="hidden" name="comDate" class="form-control" value="<?php echo date("Y-m-d H:i:s"); ?>"></input>

                <div class="form-group">
                    <button id="btn_add" class="btn btn-success" type="submit">Добавить</button>
                </div>
            </form>
             <?php else: ?>
            <p>Добро пожаловать, <?php echo $_SESSION['user']['userName'] ?> <a href="/logout.php">выход</a> </p>
            <div id="errors-block" class="alert alert-danger" style="display: none;"></div>
            <form id="addComment" action="store.php" method="post" enctype=multipart/form-data>

                <div class="form-group">
                    <input id="comName" type="hidden" class="form-control" name="comName" value="<?php echo $_SESSION['user']['userName'] ?>">
                </div>

                <div class="form-group">
                    <input id="comEmail" type="hidden" name="comEmail" class="form-control" value="<?php echo $_SESSION['user']['userEmail'] ?>"></input>
                </div>
                
                <div class="form-group">Сообщение
                    <textarea id="comText" name="comText" class="form-control"></textarea>
                </div>
                <div class="form-group">
                   <input id="comImage" type="hidden" name="comImage" class="form-control" value="<?php echo $_SESSION['user']['userImage'] ?>"></input>
               </div>
                    <input id="comDate" type="hidden" name="comDate" class="form-control" value="<?php echo date("Y-m-d H:i:s"); ?>"></input>

                <div class="form-group">
                    <button id="btn_add" class="btn btn-success" type="submit">Добавить</button>
                </div>
            </form>
            <?php endif ?>
        </div>
    </div>
</div>
    </body>
        
    </script>
    <style>
        .btn{
            display: inline-block;
        }
    </style>
    <script src="js/jQuery.min.js"></script>
    <script src="js/script.js"></script>
    </html>