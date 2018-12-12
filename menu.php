<nav>
    <div class="nav-wrapper">
        <div class="row">
            <div class="col l8 offset-l2" id = "navbarM">
                <a href="#!" class="brand-logo">KVN</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="profile.php">Чат</a></li>
                    <li><a href="train.php">Тренировки</a></li>
                    <li><a href="MainTest.php">Тесты</a></li>
                    <li><a href="#!">Материалы</a></li>
                    <li><a href="#!">Профиль</a></li>
                    <li><a href="dictionary.php">Словарь</a></li>
                    <li><a id='EXIT' href="#!">Выход</a></li>
                   
                    
                </ul>
            </div>
        </div>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="profile.php">Чат</a></li>
    <li><a href="traine.php">Тренировки</a></li>
    <li><a href="MainTest.php">Тесты</a></li>
    <li><a class="disabled" href="#!">Материалы</a></li>
    <li><a href="#!">Профиль</a></li>
    <li><a href="dictionary.php">Словарь</a></li>
    <li><a id='EXIT' href="#!">Выход</a></li>
</ul>
<script>
    
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
