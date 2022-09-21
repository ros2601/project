<?php
session_start();
 $connect=mysqli_connect("localhost:3308","root","","roshni")
 or
die("Connection Failed");

if(isset($_REQUEST['upload']))
{
  if(empty($_FILES['file']['name']))
  {
    echo"<script>
    alert('Please Select a image before uploading');
    window.location.href='nav.php';
    </script>";   
  }
  else{
    $privacy=$_REQUEST['privacy'];
    $user=$_SESSION['username'];
    $filename=$_FILES['file']['name'];
    $filepath=$_FILES['file']['tmp_name'];

    $filename=explode('.',$filename);
    $extension=$filename['1'];  
   
    
    $imagepath=explode('.',$filepath);
 
    $query="show table status like 'image'";
    $result=mysqli_query($connect,$query);
    $row=mysqli_fetch_assoc($result);
  
    $time= $row['Update_time'];
    $id= $row['Auto_increment'];

    $newfilename=$id.".".$extension;

    $query="insert into image(name,privacy,user,add1) values('$newfilename','$privacy','$user','$time')";
    
    if(mysqli_query($connect,$query))
    {
       
        if(move_uploaded_file($filepath,"upload/".$newfilename))
        {
            echo"<script>
            alert('Picture Uploaded Successfully!');
            window.location.href='nav.php';
            </script>";
        }
        else{
            echo"<script>
            alert('Sorry can't Upload the Picture...');
            window.location.href='nav.php';
            </script>";   
        }
    }
}   
}

if(!empty($_GET['did']))
{
  $id=$_GET['did'];
  $query="delete from image where id=$id";
  
  if(mysqli_query($connect,$query))
  {
    echo"<script>
            alert('Picture deleted Successfully');
            window.location.href='nav.php';
            </script>";   
  }
 
}

?>