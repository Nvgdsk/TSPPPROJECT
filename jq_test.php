<?php
include_once("createtest.php");
include_once("db.php");


$action = $_REQUEST['a'];
    
switch ($action)
{

    case 'addtest':
       // print_r('reg');
        addtest($_POST);
        break;
    case 'gettest':
        gettest($_POST);
        break;

   
}
?>