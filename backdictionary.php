<?php
class Dictionary{
private $ua_word;
private $engword;
public function setUa($w)
{
    $this->ua_word=$w;
}
public function setEng($w)
{
    $this->engword=$w;
}
public function addtodb()
    {
         global $mysqli;
        
        $mysqli->query("INSERT INTO `maindictionary`(`Eng`, `Ua`,`Description`) VALUES ('$this->engword','$this->ua_word','Soon')");
         $mysqli->close();
        $mysqli->query("INSERT INTO `english_word`(`eng_word`) VALUES ('$this->engword')");
             $mysqli->close();
        $mysqli->query("INSERT INTO `maindictionary`(`ukrainian_word`) VALUES ('$this->ua_word')");
             $mysqli->close();
    }
public function getwords()
{
    global $mysqli;
        
        $a = $mysqli->query("SELECT * FROM `maindictionary`");
    echo'<table>
        <thead>
          <tr>
              <th class = "center">ENGLISH</th>
              <th class = "center">UKRAINIAN</th>
               <th class = "center">DEFENITION</th>
          </tr>
        </thead>

        <tbody>
          ';
      
     echo "<div class= 'row'>";
        while($row = mysqli_fetch_assoc($a))
        {
            $ua = $row['Ua'];
            $eng = $row['Eng'];
            $dd=$row['Description'];
            echo "<tr><td class = 'center'>$eng</td><td class = 'center'>$ua</td>
            <td class = 'center'>$dd</td></tr>";
        }
    echo "  </tbody>
      </table>";
         $mysqli->close();
}

}
function add_to_db($arr)
{
    
    $dict = new Dictionary;
    $dict->setUa(htmlspecialchars($_POST['ua']));
    $dict->setEng(htmlspecialchars($_POST['eng']));
    $dict->addtodb();
    
}
function getwords($arr)
{

   $dict = new Dictionary;
    $dict->getwords();
}

















?>