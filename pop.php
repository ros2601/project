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
            </script>";
        }
        else{
            echo"<script>
            alert('Sorry can't Upload the Picture...');
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
            window.location.href='pop.php';
            </script>";   
  }
 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Main page</title>
<link rel="stylesheet" href="pop.css" />
</head>
<body>
<div class="maincontainer">


<!-------------------------------Designing of NAV BAR--------------------------->
    <nav class="navbar">
    <div class="logo" >Pixer</div>
        <ul class="links"> 
            <div class="menu">
              <li><a href="nav.php">
                <?php  echo "Hello, ";
                 echo $_SESSION['username'];?>
                </a></li>
              <li onclick="togglePopup1()"><a> Upload</a> </li>
              <li><a href="pop.php">Popular</a></li>
              <li><a  onclick="togglePopup2()">Log Out</a></li>
            </div>
        </ul>
    </nav>
    
<!------------------------desiging of upload button------------------------->
<div class="popup1" id="popup-1" >
    <form enctype="multipart/form-data" method="post" >
        <div class="content">
            <div class="close-btn" onclick="togglePopup1()">&times;</div>
              <h2>Upload a Picture</h2>
            <input type="file" name="file"/>
              <select name="privacy" name="privacy">
                  <option value="public">Public</option>
                  <option value="private">Private</option>
              </select>
            <button type="submit" name="upload" value="upload" id="upload">Upload</a>
        </div>
      </form>
    </div>
    <script>
        function togglePopup1()
        {
        document.getElementById("popup-1").classList.toggle("active")
        };
    </script>
<!----------------------------Designing of logout button------------------------>

<div class="popup2" id="popup-2" >
    <div class="content">
      <div class="close-btn" onclick="togglePopup2()">&times;</div>
        <p>Do you really want to Log out?</p>
            <a href="logout.php" >Yes</a>
            <a href="pop.php">No</a>
      </div>
    </div>
    <script>
        function togglePopup2()
        {
        document.getElementById("popup-2").classList.toggle("active")
        };
    </script>

<!------------------------------pictures section inner div-------------------->
<div class="heading">
<h1>Showing our most popular Images</h1>
</div>
<table>

    <?php 
    
      $query="select * from image order by views desc";
        $result=mysqli_query($connect,$query);
        while($row=mysqli_fetch_assoc($result))
        {		
    ?>
        <tr>
          <form>
            <td><input type="hidden"  type="submit"  value="<?php echo $row['id']?>"></td>
            <td><img   alt="Image not found"  src="upload/<?php echo $row['name'] ?>"></td>
            <td><a href="pop.php?did=<?php echo $row['id'] ?>">Delete</td>
            <td ><a href="details_pop.php?details=<?php echo $row['id']?>">Details</td>

          </form>
        </tr>
        <?php   
      }
      ?>
</table>
<!--------------------------------FOOTER---------------------------->
<footer>
      <div class="row">

        <div class="column">
          <h3>Pixer</h3>
          <p>PiXER is a place that puts a world of possibilities at a single place,
            where you can upload and view 1000 of pictures.</p> 
            <p>E-mail address:pixer@gmail.com</p>
            <p>Copyright &copy; PIXER</p> 
        </div>
        <div class="column1">
          <h3>Some Links</h3>
          <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="# ">Contact Us</a></li>
          </ul>  
        </div>

      </div>
    </footer>
<!-----------------------------popup for pic details------------------------>
<div class="popup3" id="popup-3" >
    <div class="content">
      <div class="close-btn" onclick="togglePopup3()">&times;</div>

      <h1>Showing details of picture</h1>
        <?php 
        session_start();
        $connect=mysqli_connect("localhost:3308","root","","roshni") or die("connection failed"); 
            if(!empty($_REQUEST['details']))
            {
              $id=$_GET['details'];
              $q1="update image set views=views+1 where id=$id";
              mysqli_query($connect,$q1);
              $query="select * from image where id=$id";
              $result=mysqli_query($connect,$query);
            }
        ?>
       <table>
            <?php   
            while($row=mysqli_fetch_assoc($result))
             {
                if($row['privacy']=="private"	)
                {   
                    echo "<h2>Sorry !</h2>";
                    echo $_SESSION['username'];
                    echo "<h2>We can't show this Image details as it is private</h2>";
                }	
                else
                {
            ?>
            <tr><td><img   alt="Image not found"  src="upload/<?php echo $row['name'] ?>"></td></tr>
            <tr><td>Privacy: <?php echo $row['privacy']?></td></tr>
            <tr><td>Posted by:  <?php echo $row['user']?></td></tr>
            <tr><td>Views: <?php echo $row['views']?></td></tr>
            <tr><td>Posted On: <?php echo $row['add1']?></td></tr>
            <?php   
             }
             }
             ?>
     </table>
    </div>
</div>
    <script>
        function togglePopup3()
        {
        document.getElementById("popup-3").classList.toggle("active")
        };
    </script>

</div>
</body>
</html>
