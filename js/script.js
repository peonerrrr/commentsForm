$(document).ready(function(){

$('#addComment').on('submit', function(e){
        var formData = new FormData();
        jQuery.each($('#comImage')[0].files, function(i, file) {
            formData.append('comImage', file);
        });
        formData.append('comName', $('input#comName').val());
        formData.append('comEmail', $('input#comEmail').val());
        formData.append('comText', $('#comText').val());
        formData.append('comDate', $('input#comDate').val());
        formData.append('comImage', $('input#comImage').val());
       $.ajax({
        url: "store.php",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,         
        data: formData, //указываем что отправляем
        success: function(data){
            console.log(data);
            if (data == 'nameLenght') {
                $('#errors-block').show('fast').text('Длина поля (Имя) должно быть менее 50 символов');
            }else if(data == 'errorEmail'){
                $('#errors-block').show('fast').text('e-mail введен не верно!');
            }else if(data == 'emptyVars'){
                $('#errors-block').show('fast').text('Заполните все поля');
            }else if(data == 'textLenght'){
                $('#errors-block').show('fast').text('Длина поля (Сообщение) должно быть менее 200 символов');   
            }else if(data == 'sizeImage'){
            $('#error').show('fast').addClass('alert-danger').html('Размер файла не должен превышать 5Мб');
            }else if(data == 'typeImage'){
                $('#error').show('fast').addClass('alert-danger').html('Картинка должна быть формата JPG, GIF или PNG');
            }
            else {
                // $('#errors-block').show('fast').removeClass('alert-danger').addClass('alert-success').text('Ваш комментарий добавлен');
                var data = jQuery.parseJSON(data);
                $('#addComment').addClass('alert-success').addClass('alert').html("<b>Ваш комментарий добавлен</b>");
                $('#errors-block').hide('fast');   
                if (data.user.userName == 'admin') {
                $('.comments-list').append(`
                    <li>
                        <div class="comment-body">
                            <div class="image-wrapper">
                                <img src="`+ data['user']['userImage'] +`">
                            </div>
                            <div class="person-info-block"><b>` + data['name'] + `</b>
                                <p class="comments-email">`+ data['email'] +`</p>
                                <p class="comment-date">` + data['date'] +`</p>
                            </div>
                            <div class="comments-text">
                                <p>`+ data['text'] +`</p>
                            </div>
                        </div>
                        <div class="comment-action">
                            <a class="btn btn-danger delete" href="delete.php?id=`+ data['id'] +`">Удалить</a>
                        </div>
                    </li>`);
                deletePost();
                }else{
                    $('.comments-list').append(`
                    <li>
                        <div class="comment-body">
                            <div class="image-wrapper">
                                <img src="`+ data['image'] +`">
                            </div>
                            <div class="person-info-block"><b>` + data['name'] + `</b>
                                <p class="comments-email">`+ data['email'] +`</p>
                                <p class="comment-date">` + data['date'] +`</p>
                            </div>
                            <div class="comments-text">
                                <p>`+ data['text'] +`</p>
                            </div>
                        </div>
                    </li>`);
                }
            }
        }
     });
    e.preventDefault();
});
    
    $('#sortForm').on('submit', function(event){
        event.preventDefault();
        $.post('sort.php',$(this).serialize(), function(data){
              var data = jQuery.parseJSON(data);
              console.log(data);
              $('.comments-list').html('');
               if (data[data.length - 1]['userName'] == 'admin') {
                  for(var i = 0; i < data.length - 1; i++){
                    console.log(i);
    	                $('.comments-list').append(`
                            <li>
                                <div class="comment-body">
                                    <div class="image-wrapper">
                                        <img src="`+ data[i]['image'] +`" alt="`+ data[i]['name'] +`">
                                    </div>
                                    <div class="person-info-block">
                                        <b>` + data[i]['name'] + `</b>
                                        <p class="comments-email">`+  data[i]['email'] +`</p>
                                        <p class="comments-email">`+  data[i]['date'] +`</p>
                                    </div>
                                    <div class="comments-text">
                                        <p>`+ data[i]['text'] +`</p>
                                    </div>
                                </div>
                                <div class="comment-action">
                                    <a class="btn btn-danger delete" href="delete.php?id=`+ data[i]['id'] +`">Удалить</a>
                                </div>
                            </li>`);
    	                deletePost();
                    }
                }else{
                    console.log(i);
                    for(var i = 0; i < data.length - 1; i++){
                    $('.comments-list').append(`
                            <li>
                                <div class="comment-body">
                                    <div class="image-wrapper">
                                        <img src="`+ data[i]['image'] +`" alt="`+ data[i]['name'] +`">
                                    </div>
                                    <div class="person-info-block">
                                        <b>` + data[i]['name'] + `</b>
                                        <p class="comments-email">`+  data[i]['email'] +`</p>
                                        <p class="comments-email">`+  data[i]['date'] +`</p>
                                    </div>
                                    <div class="comments-text">
                                        <p>`+ data[i]['text'] +`</p>
                                    </div>
                                </div>
                            </li>`);
                    }   
                }
        });
    });

    // $( "#sortForm .btn" ).trigger('click');
    
    function deletePost(){
        $('.delete').click(function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
                var id = $(this).attr('href');
                id = id.replace('delete.php?id=', '');
                
                $.post( "delete.php", {id}, function( data ) {
                }); 
            });
    }
    deletePost();
	

    function redirectSleep(){
    window.location.replace("/");
}

$('#authForm').on('submit', function(event){
    event.preventDefault();
    $.post('auth.php', $(this).serialize(), function(data){
        console.log(data);
        if(data == 'error'){
            $('.alert').show('fast').addClass('alert-success').text('Неверные данные');
        }else if(data == 'notAllVal'){
            $('.alert').show('fast').addClass('alert-success').text('Остались пустые поля');
        }else if(data == 'passwordError'){
            $('.alert').show('fast').addClass('alert-success').text('Неверный пароль');
        }
        else{
        	function timer(){
			 var obj=document.getElementById('timer_inp');
			 obj.innerHTML--;
			 
			 if(obj.innerHTML==0){setTimeout(function(){},1000);}
			 else{setTimeout(timer,1000);}
			}
			setTimeout(timer,1000);
        	$('.alert').removeClass('alert-danger').show('fast').addClass('alert-success').html('Вы успешно вошли. Перейдите на <a href="/">Главную</a> страницу...<span id="timer_inp">3</span>');
            setTimeout(redirectSleep, 3000);
        }
    });
});


$('#c-send').on('submit', function(event){
var formData = new FormData();
        jQuery.each($('#avatar')[0].files, function(i, file) {
            formData.append('image', file);
        });
        formData.append('name', $('input#name').val());
        formData.append('mail', $('input#mail').val());
        formData.append('tel', $('#tel').val());
        formData.append('password', $('input#password').val()); 
          $.ajax({
        url: "process.php",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,         
        data: formData, //указываем что отправляем
        success: function(data){
            console.log(data);
              if (data == 'usernameexists') {
                $('#error').show('fast').removeClass('alert-success').addClass('alert-danger').text("Пользователь с таким логином уже существует");
              }
              if (data == 'success') {
                $('#error').show('fast').removeClass('alert-danger').addClass('alert-success').html("Вы упешно зарегестрировались");
                function location(){
                  window.location.replace("/form-auth.php");
                }
                setTimeout(location, 2000);

              }
              if (data == 'empty') {
                $('#error').show('fast').addClass('alert-danger').html("Заполните все поля");

              }
               if (data == 'mailError') {
                $('#error').show('fast').addClass('alert-danger').html("e-mail введен не корректно");

              }
              if (data == 'telError') {
                $('#error').show('fast').addClass('alert-danger').html("Телефон введен не корректно");

              }
              if(data == 'sizeImage'){
                $('#error').show('fast').addClass('alert-danger').html('Размер файла не должен превышать 5Мб');
                }
                if(data == 'typeImage'){
                    $('#error').show('fast').addClass('alert-danger').html('Картинка должна быть формата JPG, GIF или PNG');
                }
              if (data == 'userNameError') {
                $('#error').show('fast').addClass('alert-danger').html("Пользователь с таким логином уже существует!");
              }

          }
      });
        event.preventDefault();
    });
});