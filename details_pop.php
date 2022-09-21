<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <style>
        .container{
            width: 100%;
            height: 100%;
        }
        .inner{
            width: 50%;
            margin:auto;
            margin-top: 50px;
            background-color: lightgrey;
            border-radius: 10px;
            text-align: center;
            padding-top:20px;
            padding-bottom:20px;

        }
        .inner table {
            width: 50%;
            align-items: center;
            margin: auto;
        }
        .inner a{
            font-size: 20px;
            margin-top: 10px;       
        }
        .inner img{
            width: 60%;
            height:300px;
            border:4px solid white;
        
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="inner">
        <h1>Showing details of picture</h1>
        <?php 
        session_start();
        $connect=mysqli_connect("localhost:3308","root","","roshni") or die("connection failed"); 
            if(!empty($_REQUEST['details']))
            {
              $id=$_GET['details'];
              $q1="update image set views=views+1 where id=$id";


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
                    echo "<h2>we Can't show this Image details as it is private</h2>";
                }	
                else
                {
            ?>
            <tr>
            <td><img   alt="Image not found"  src="upload/<?php echo $row['name'] ?>"></td>
            </tr>
            <tr>
              <td>Privacy: <?php echo $row['privacy']?></td> 
            </tr>
            <tr>
            <td>Posted by:  <?php echo $row['user']?></td>
            </tr>
            <tr>
            <td>Views: <?php echo $row['views']?></td>
            </tr>
            <tr>
            <td>Posted On: <?php echo $row['add1']?></td>
            </tr>
          <?php   
             }
            }
           ?>
      </table>

      <a href="pop.php">Go back to popular images page</a>
        </div>
      
    </div>
    
  
</body>
</html>