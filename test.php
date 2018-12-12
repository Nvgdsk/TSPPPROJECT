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
    <meta charset="utf-8">
    <title>Learn and play</title>
</head>


<body>

    <?php
    require("menu.php");
    ?>
    <div class="container">
        <?php
        if($_GET['a']=='mytest')
        {
            require("mytest.php");
        }
           
        else
        {
          echo '<a class="btn pulse" id="AddTest" href="#!"> Добавить тест</a>';  
        }
        ?>


    </div>


    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
        var quetion = 1;
        var fd = new FormData();
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

        $('#AddTest').on('click', function() {
            let a = `<h4 class="center">Создание теста</h4><div id = "CTest">
                    </div><div><a id = "saveT"class="btn right" href = "#!"><i class="material-icons right">save</i>Сохранить</a></div>`;

            $(".container").append(a);

            $("#saveT").on('click', function() {
                for (let i = 0; i < $(".autocomplete").length; i++) {

                    console.log($('input[type=text][name=quetion' + (i + 1) + ']').val());
                    fd.append("quetion[" + i + "]", $('input[type=text][name=quetion' + (i + 1) + ']').val());
                    var counts = 0;

                    $('input[type=text][name=Ranswer' + (i + 1) + '].validate').each(function() {
                        console.log("Ответы: " + $(this).val());
                        fd.append("answer[" + i + "][" + counts + "]", $(this).val());
                        counts++;

                    });
                    var counts = 0;

                    $('input[type=radio][name=group' + (i + 1) + ']').each(function() {
                        if ($(this).is(':checked')) {
                            fd.append("key[" + i + "]", counts);
                        }
                        counts++;
                    });
                }
                $.ajax({
                    type: 'POST',
                    url: 'jq_test.php?a=addtest',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                    }
                });

            })
            $("#AddTest").hide();
            let b = `<a class='btn' id ="addQ" href="#!">Добавить вопрос</a>`;

            $(".container").prepend(b);
            $("#addQ").on('click', function() {
                let a = `<div class="row" >
                    <div class="col s12">
                        <div class="row" >
                            <div class="input-field col s12" id ="${quetion}">
                                <i class="material-icons prefix">forward</i>
                                <input type="text" id="autocomplete-input" class="autocomplete" name="quetion${quetion}">
                                <label for="autocomplete-input">Quetion ${quetion}</label>
                                <a  class = "btn addchexbox"><i class="material-icons right">add_box</i>Добавить варианты ответа</a>
                            </div>
                        </div>
                    </div>
                </div>`;
                quetion++;
                $(".addchexbox").unbind();
                $('#CTest').append(a);
                $('.addchexbox').on('click', function() {
                    let id = $(this).parent().attr("id");

                    let a = ` <div class="row"><div class="input-field col s8">
          <input  type="text" class="validate" name= "Ranswer${id}">
          <label for="validate">Answer</label>

        </div><p>
      <label>
        <input name="group${id}" type="radio" checked />
        <span>correct answer</span>
      </label>
    </p></div>`;
                    $(this).before(a);

                })

            })

        })

    </script>
</body>

</html>
