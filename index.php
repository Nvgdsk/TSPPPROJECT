<?php
    session_start();
if(isset($_SESSION['token']))
{
    if($_SESSION['token']==1)
        header ('Location: profile.php');
}
?>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
     <link type="text/css" rel="stylesheet" href="css/indexstyle.css" />
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <title>Learn and play</title>
</head>

<body>
   
    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 id="finalreg"></h4>
            <p>
                <?php require("codex.php");?>
            </p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
    <div class="container">
        <div class="carousel carousel-slider center" id="carousel" >

            <div class="carousel-item " href="#one!">
                <div id="Autorization">
                    <div class="row">

                        <div class="col s4 offset-s4 ">
                            <h3 class="color-black">Авторизация</h3>
                            <form action="" type='POST' id="auform">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input type="email" id="autocomplete-input" name="loginA" class="autocomplete">
                                        <label for="autocomplete-input">Email</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <input type="password" id="autocomplete-input" name="password" class="autocomplete">
                                        <label for="autocomplete-input">Password</label>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn right" id="logbut"><i class="material-icons right">send</i>Авторизация</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" href="#two!">
                <div id="Registration">

                    <div class="row">
                        <div class="col s4 offset-s4 ">
                            <h3>Регистрация</h3>
                            <form action="" type='POST' id="regform">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input type="email" id="autocomplete-input" name='login' class="autocomplete">
                                        <label for="autocomplete-input">Email</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <input type="text" id="autocomplete-input" name='Password' class="autocomplete">
                                        <label for="autocomplete-input">Password</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">face</i>
                                        <input type="text" id="autocomplete-input" name='name' class="autocomplete">
                                        <label for="autocomplete-input">Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">face</i>
                                        <input type="text" id="autocomplete-input" name='secondname' class="autocomplete">
                                        <label for="autocomplete-input">Secondname</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">contact_phone</i>
                                        <input name="number" type="text" id="autocomplete-input" class="autocomplete">
                                        <label for="autocomplete-input">+380966815412</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <i class=" material-icons prefix">business_center

                                        </i>
                                        <select name='role'>

                                            <option value="student" disabled selected>Студент</option>
                                            <option value="student">Студент</option>
                                            <option value="teacher">Преподователь</option>

                                        </select>

                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">forum</i>
                                        <input type="text" id="autocomplete-input" name='group' class="autocomplete1">
                                        <label for="autocomplete-input">Group</label>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn right" id='regbut'><i class="material-icons right">send</i>Регистрация</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>






    </div>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').formSelect();
            $('select').formSelect();
            $('.modal').modal();
            $('.carousel.carousel-slider').carousel({
                fullWidth: true,
                indicators: true,
                numVisible:2
            })

        });

        $.ajax({
            url: 'jq_link.php?a=getNameGroup', //url страницы (action_ajax_form.php)
            type: 'POST',
            success: function(data) {
                data = $.parseJSON(data);
                let res = new Object;
                for (let i = 0; i < data.length; i++) {
                    res[data[i]['name']] = null;
                }
                $('input.autocomplete1').autocomplete({
                    data: res
                });
            }
        });


        $('#regbutform').on('click', function() {
            $('#regbutform').addClass('hide');
            $('#Autorization').addClass('hide');
            $('#Registration').removeClass('hide');
            $('#abut').removeClass('hide');
        })
        $('#abut').on('click', function() {
            $('#regbutform').removeClass('hide');
            $('#Autorization').removeClass('hide');
            $('#Registration').addClass('hide');
            $('#abut').addClass('hide');
        })
        $('#regbut').on('click', function() {
            var fin = 0;
            $('#regform input').each(function(i, elem) {
                if ($(this).val() == '') {
                    M.toast({
                        html: 'Заполните все поля' + $(this).attr('name')
                    });
                    fin = 1;

                }
            });
            if (fin != 1) {
                $.ajax({
                    url: 'jq_link.php?a=reg', //url страницы (action_ajax_form.php)
                    type: "POST", //метод отправки
                    dataType: "html", //формат данных
                    data: $("#regform").serialize(), // Сеарилизуем объект
                    beforeSend: function() {

                    },
                    success: function(data) { //Данные отправлены успешно
                        $("#finalreg").text(data);
                        $('.modal').modal('open');
                    },
                    error: function(response) { // Данные не отправлены
                        //alert(response);
                    }
                });
            }
        })
        $('#logbut').on('click', function() {
            $.ajax({
                url: 'jq_link.php?a=au', //url страницы (action_ajax_form.php)
                type: "POST", //метод отправки
                dataType: "html", //формат данных
                data: $("#auform").serialize(), // Сеарилизуем объект
                success: function(data) { //Данные отправлены успешно\

                    location.reload();
                    //location.reload();
                },
                error: function(response) { // Данные не отправлены
                    alert(response);
                }
            });
        })

    </script>

</body>

</html>
