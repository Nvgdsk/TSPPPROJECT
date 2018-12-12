<?php
include_once("db.php");
function addtest($arr)
{
    session_start();
    $id_creator= $_SESSION['USER_ID'];
    $q = json_encode($_POST['quetion']);
    $a = json_encode($_POST['answer']);
    $k = json_encode($_POST['key']);
    print_r($k);
    global $mysqli;
    $mysqli->query("INSERT INTO `testtable`(`id_creator`)
                         VALUES('$id_creator')");
     $test_id = $mysqli->insert_id;
        $mysqli->query("INSERT INTO `testqanda`(`quetion`, `Answer`, `keyA`,`test_id`)
                         VALUES('$q','$a','$k','$test_id')");
         $mysqli->close();

     
         print_r($test_id);
    
}
function gettest($arr)
{
    global $mysqli;
    $html = '';
    $a = $mysqli->query("Select * FROM `testqanda`");
    while($row = mysqli_fetch_assoc($a))
    {
        $quetion_list = json_decode($row['quetion']);
        $answer = json_decode($row['Answer']);
        $idQ=$row['id'];
        echo "<div id ='$idQ'>
                    <h3>Test ".($row['id']+1)."</h3>";
        for($i=0;$i<count($quetion_list);$i++)
        {
            
            echo "<div id = 'quetion$i'>
                  <h4>".($i+1).". $quetion_list[$i]</h4>";
            for($j=0;$j<count($answer[$i]);$j++)
            {   
                echo '<p>
      <label>
        <input name="answer'.$i.'" type="radio" checked />
        <span>'.$answer[$i][$j].'</span>
      </label>
    </p>';
            }
              echo "</div>";
        }
        echo "</div>";
    }
 
    $mysqli->close();
}
?>
