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
<style>
    html {
        background-color: white;
    }

    body {
        background-color: white;
    }

    .container {
        margin-top: 10vh;
        height: 85vh;
    }

    #leftP {
        border: 2px solid rgba(128, 128, 128, 0.47);
        height: 85vh;
        background-color: white;
    }

    #listss {
        margin-left: 40px;
    }

    #rightpan {
        height: 85vh;
        border: 2px solid rgba(128, 128, 128, 0.47);
        border-left: 0px;
        background-color: white;
    }

    .row {
        margin-bottom: 0px;
        padding: 0px;
    }

    .collection {
        border: 0px;
    }

    .collection .collection-item {
        border: 0px;
        cursor: pointer;
    }

    .collection.collection-item:hover {

        background-color: rgba(215, 232, 232, 0.38)
    }

    .asd {
        margin-left: 20px;
    }

    .card .card-content {
        padding: 0px;

    }
    .GO{
        margin-bottom: 10px;
    }
    #ChatH{
        height: 10vh;
        overflow-x: scroll;
        overflow-y: hidden;
    }
    .row .col.s2 {
        width: 50px;
    }
    #ChatH::-webkit-scrollbar { width: 0; }

/* ie 10+ */
#ChatH { -ms-overflow-style: none; }

/* фф (свойство больше не работает, других способов тоже нет)*/
#ChatH { overflow: -moz-scrollbars-none; }
</style>

<body>


    <div class="container">
        <ul id='dropdown1' class='dropdown-content'>
            <li><a href="#!">one</a></li>
            <li><a href="#!">two</a></li>

        </ul>
        <div class="row no-padign">
            <div class="col s3" id="leftP">
                <div class="collection">
                    <a href="example.php" class="collection-item ">Home</a>
                    <a href="#!" class="collection-item bold">Train</a>
                    <div class="asd">
                        <a href="#!" class="collection-item active">Flash Cards</a><a href="#!" class="collection-item">Audio Training</a>
                        <a href="speech.php" class="collection-item">Speech Training</a>
                    </div>
                    <a href="#!" class="collection-item">Materials</a>
                    <a href="examplechat.php" class="collection-item ">Chat</a>

                </div>
            </div>
            <div class="col s9" id="rightpan">
              <div class="row" id='cardgame'>






        </div>
            </div>
        </div>


    </div>
    <script>
  $(document).ready(function() {
            
            $('.sidenav').sidenav();
            $('.modal').modal();
            $("#field_message").scrollTop('9999999999');

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
        $.ajax({
            type: 'POST',
            url: 'jq_link.php?a=getcard',
            success: function(data) {
                $('#cardgame').html('');
                $('#cardgame').html(data);

            }
        })


    </script>
</body>

</html>
