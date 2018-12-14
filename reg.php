<?php 
class user{
    private $login;
    private $password;
    private $number;
    private $role;
    private $group;
    private $activation;
    private $id;
    private $token;
    private $name;
    private $secondname;
    public function setsname($secondname)
    {
        $this->secondname = $secondname;
    }
    public function setname($name)
    {
        $this->name = $name;
    }
    public function setlogin($login)
    {
        $this->login = $login;
    }
    public function setid($id)
    {
        $this->id = $id;
    }
    
    public function setpassword($password)
    {
        $this->password = $password;
    }
    public function setnumber($number)
    {
        $this->number = $number;
    }
    public function setrole($role)
    {
        $this->role = $role;
    }
    public function setgroup($group)
    {
        $this->group = $group;
    }
    public function getuserinfo($id)
    {
        global $mysqli;
        $res1 = $mysqli->query("SELECT * FROM `profileatr` Where `user_id`='$id' ");
        $res1 = mysqli_fetch_assoc($res1);
        echo "
        <h3 class = 'center'>Profile by ".$res1['name']."<h3>
        <h4>Name: ".$res1['name']."<h3>
        <h4>Sname: ".$res1['secondname']."<h3>
        <h4>Number: ".$res1['number']."<h3>
        <h4>Role: ".$res1['role']."<h3>
        <h4>Group: ".$res1['group_id']."<h3>
        <a href='#!' class = 'btn sendml' id ='$id'>send message</a>";   
    }
    public function generateRandomString() 
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->activation = $randomString;
    }
    public function addtodb()
    {
         global $mysqli;
        $mysqli->query("INSERT INTO `users`(`email`, `password`, `activation`)
                         VALUES('$this->login','$this->password','$this->activation')");
        $id_user = $mysqli->insert_id;
        $mysqli->query("INSERT INTO `profileatr`(`user_id`, `name`, `secondname`, `number`, `group_id`, `role`)
                         VALUES('$id_user','$this->name','$this->secondname','$this->number','$this->group','$this->role')");
        $a = $mysqli->query("SELECT * FROM `chatid` where `NAME`= '$this->group'");
        if(mysqli_num_rows($a)==NULL)
        {
            $mysqli->query("INSERT INTO `chatid`(`NAME`) VALUES('$this->group')");
             $id_chat=$mysqli->insert_id;
        }
        else
        {
            $id_chat = mysqli_fetch_assoc($a);
            $id_chat = $id_chat['Chat_id'];
        }
         $mysqli->query("INSERT INTO `userchat`(`Chat_id`,`UserID`) VALUES('$id_chat','$id_user')");
         $mysqli->close();
    }
    public function CheckMailDB()
    {   
        global $mysqli;
        $email = $this->login;
        $row = $mysqli->query("SELECT `id` FROM `users`
                    WHERE `email`='$email'");
        $row = mysqli_fetch_assoc($row);
        
        
        if(empty($row['id']))
        {
            
            return 1;
        }
        else
        {   
            return 0;
        }

    }
    public function filteremail()
    {
        return filter_var($this->login, FILTER_VALIDATE_EMAIL);
    }
    public function autorization()
    {
         global $mysqli;
        $res = $mysqli->query("SELECT * FROM `users`
                           Where `email`='$this->login' AND `password` = '$this->password' ");
        $res = mysqli_fetch_assoc($res);

        $res = $res['id'];
        print_r('1');
 
       session_start();
        if(empty($res))
        {
             print_r('affffff');
             $_SESSION['token']='0';

        }
         else{
            
            $_SESSION['token']='1';
             $_SESSION['USER_ID']=$res;
             $res1 = $mysqli->query("SELECT * FROM `profileatr`Where `user_id`='$res' ");
             
             $res1 = mysqli_fetch_assoc($res1);
                      
             $_SESSION['name']=$res1['name'];
             $_SESSION['sname']=$res1['secondname'];
             $_SESSION['num']=$res1['number'];
             $_SESSION['role']=$res1['role'];
             
                   
           
             
            

         }
    }
    public function getNameGroup()
    {
        global $mysqli;
        $s = $mysqli->query("SELECT `Name` FROM `chatid` WHERE 1");
        
        $a = [];
        while($res = mysqli_fetch_assoc($s))
        {
             $name  = $res['Name'];
            $temp[]['name'] =$name; 
           
             
           
            
        }
        
        $a = json_encode ($temp,true);
        echo $a ;
        $mysqli->close();
    }
    
}


function addtodb($arr)
{
    global $mysqli;
    $user = new USER;
    $user->setlogin($login = htmlspecialchars($_POST['login']));
    $user->setpassword($password =htmlspecialchars(md5($_POST['Password'])));
    $user->setnumber($number = htmlspecialchars($_POST['number']));
    $user->setrole($role = htmlspecialchars($_POST['role']));
    $user->setgroup($group = htmlspecialchars($_POST['group']));
    $user->setname($name = htmlspecialchars($_POST['name']));
    $user->setsname($name = htmlspecialchars($_POST['secondname']));
    $user->generateRandomString();
    //print_r($user->activation);
    if ($user->filteremail())
    {
        
        if($user->CheckMailDB()==1)
        {       
            $user->addtodb();
           echo "Регистрация успешна";
        }
        else
        {
            echo "Возможно даный аккаунт уже зарегестрирован";
        }
    }                           
}
function autorization($arr)
    
{   
     
   
    $user = new USER;
    $user->setlogin($login = htmlspecialchars($_POST['loginA']));
    $user->setpassword($password =htmlspecialchars(md5($_POST['password'])));
    $user->autorization();
    
        
    
}
function getuserinfo()
{
    $user= new USER;
    $user->getuserinfo($_POST['user_id']);
}

function getNameGroup()
{
    $user = new USER;
     $user->getNameGroup();
}
?>
