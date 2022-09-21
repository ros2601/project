<?php
session_start();

class login{

function login()
{
$connect=mysqli_connect("localhost:3308","root","","roshni")
    or
die("Connection failed");
if(!empty($_POST['login']))
{
    if(empty($_REQUEST['username'] && $_REQUEST['password'] && $_REQUEST['email'] && ($_REQUEST['phone'])))
    {
        echo"<script>
        alert('Please enter All the fields')
        window.location.href='head.php';
        </script>";
    }
    else{
    $username=$_POST['username'];
    $password= $_POST['password'];
    $email= $_POST['email'];
    $phone=$_POST['phone'];

    $_SESSION['username']=$_POST['username'];

    $filename=$_FILES['file']['name'];
    $filepath=$_FILES['file']['tmp_name'];
    $imagename=explode(".",$filename);
    $ext=$imagename[1];
 
    $query="show table  status like 'roshni1'";
    $result=mysqli_query($connect,$query);
    $row=(mysqli_fetch_assoc($result)); 
    //print_r($row);
    $id=$row['Auto_increment'];
    //echo "$id";
    $newfilename=$id.".".$ext;
    //echo  "<br/>$newfilename";

    $query="INSERT INTO roshni1(name,password,email,phone,profile) values('$username','$password','$email',$phone,'$newfilename')";
    if(mysqli_query($connect,$query)) 
    {
     move_uploaded_file($filepath,"profile/".$newfilename);
     echo"<script>
     alert('Welcome to Pixer');
     window.location.href='nav.php';
     </script>";
    }
    else 
    {
        echo"<script>
        alert('Can't login Something wents wrong !');
        window.location.href='head.php';
        </script>";
    }	
}   
}
}
}
?>