<?php
    session_start();
if(!isset($_SESSION['token']))
{
    header ('Location: index.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <meta charset="utf-8">
    <title>Learn and play</title>
</head>


<body>

    
    <div class="container">
      <a class = "left" href="example.php">назад</a>
       <h2 class="center">Тренировка речи</h2>
        <div class="row" id='cardgame'>
            
            <input type="text" id="textInput">
        </div>
        <button class="btn pulse" id = "hearing" onclick="speech ()">Слушать</button>



    </div>



    <script>
        // Создаем распознаватель
        var recognizer = new webkitSpeechRecognition();

        // Ставим опцию, чтобы распознавание началось ещё до того, как пользователь закончит говорить
        recognizer.interimResults = true;

        // Какой язык будем распознавать?
        recognizer.lang = 'en-us';

        // Используем колбек для обработки результатов
        recognizer.onresult = function(event) {

            var result = event.results[event.resultIndex];
            if (result.isFinal) {
                $('#textInput').val(result[0].transcript);
            }
        };

        function speech() {
            $('#hearing').removeClass('pulse');
            M.toast({
                html: 'Запись'
            });
            // Начинаем слушать микрофон и распознавать голос
            recognizer.start();
        }

    </script>



    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();


        });
        $('#EXIT').on('click', function() {
            $.ajax({
                type: 'POST',
                url: 'jq_link.php?a=logout',
                success: function(data) {
                    location.reload();

                }
            });

        })

    </script>

</body>

</html>
