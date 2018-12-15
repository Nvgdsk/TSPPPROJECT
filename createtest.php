<?php
include_once("db.php");
function getQ()
{
    global $mysqli;
        $html = '';
        $a = $mysqli->query("Select * FROM `testqanda` WHERE `test_id`=".$_POST['idd']);
        while($row = mysqli_fetch_assoc($a))
        {
            $quetion_list = json_decode($row['quetion']);
            $answer = json_decode($row['Answer']);
            $idQ=$row['id'];

           



            for($i=0;$i<count($quetion_list);$i++)
            {
                
                echo "<div id = 'quetion'.$i class='Quet'>
                      <h4>".($i+1).". $quetion_list[$i]</h4>";
                for($j=0;$j<count($answer[$i]);$j++)
                {   
                    echo '<p>
          <label>
            <input  name="group'.$i.'" type="radio" checked />
            <span>'.$answer[$i][$j].'</span>
          </label>
        </p>';
                }
                  echo "</div>";
            }
            echo "</div>
            <a class = 'btn' id='endtest'>Закончить тест</a>";
        }
        ?>
        <script>
        var fd = new FormData();
         $('#endtest').on('click',function(){
        
            for (let i = 0; i < $('.Quet').length; i++) {
                 
                 
                  
                    var counts = 0;
     
                    
               
                    $('input[type=radio][name=group' + (i) + ']').each(function() {
                        if ($(this).is(':checked')) {
                            fd.append("key[" + i + "]", counts);
                               
                        }
                     
                        counts++;
                    });
                }
                return;
          

        })
        </script>
        <?php

        $mysqli->close();
     
}
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
function getnametest($arr)
{
    global $mysqli;
    $html = '';
    $a = $mysqli->query("Select * FROM `testqanda`");
    while($row = mysqli_fetch_assoc($a))
    {
        $quetion_list = json_decode($row['quetion']);
        $answer = json_decode($row['Answer']);
        $idQ=$row['id'];
        
         echo"<a href='#!'id ='$idQ' class='collection-item center'>Test ".($row['id']+1)."</a>";
        
      
       
//        for($i=0;$i<count($quetion_list);$i++)
//        {
//            
//            echo "<div id = 'quetion$i'>
//                  <h4>".($i+1).". $quetion_list[$i]</h4>";
//            for($j=0;$j<count($answer[$i]);$j++)
//            {   
//                echo '<p>
//      <label>
//        <input name="answer'.$i.'" type="radio" checked />
//        <span>'.$answer[$i][$j].'</span>
//      </label>
//    </p>';
//            }
//              echo "</div>";
//        }
//        echo "</div>";
    }
    echo "<script>$('.wall .center').on('click', function() {
            let id =$(this).attr('id');
            console.log(id);
            
            
            $.ajax({
                type: 'POST',
                url: 'jq_test.php?a=getQ',
                data: 'idd='+id,
                success: function(data) {
                    $('#rightpan').html(data);
                }
            });
        })</script>";
    $mysqli->close();
}
?>
