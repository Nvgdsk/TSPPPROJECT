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

 
  
  
    <div class="container" >
        <a class = "left" href="example.php">назад</a>
       
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="eng" type="text" class="validate">
                        <label for="eng">Word</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="ua" type="text" class="validate">
                        <label for="ua">Слово</label>
                    </div>
                    <a class="btn right" id="translateaddtodatabase">Добавить в словарь</a>
                </div>
            </form>
        </div>
        <h3 class="center">Словарь</h3>
        <div id="MyDict">

        </div>
    </div>

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

        function getwords() {
            $.ajax({
                type: 'POST',
                url: 'jq_link.php?a=getwords',
                success: function(data) {

                    $('#MyDict').html('');
                    $('#MyDict').html(data);
                }
            });
        }
        getwords();
        $('#translateaddtodatabase').on('click', function() {

            var fd = new FormData();
            var ua = $('#ua').val();
            var eng = $('#eng').val();
            fd.append("ua", ua);
            fd.append("eng", eng);
            if (ua != '' && eng != '') {
                $.ajax({
                    type: 'POST',
                    url: 'jq_link.php?a=addtodict',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        M.toast({
                            html: 'Слово добавленно в словарь!'
                        });
                        getwords();
                    }
                });
            }
        })

    </script>
</body>

</html>
