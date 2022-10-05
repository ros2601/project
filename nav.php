    <?php
    include('uploading.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Main page</title>
      <link rel="stylesheet" href="nav.css" />
      </head>
      <body>
    <div class="maincontainer">

        <!-------------------------------Designing of NAV BAR--------------------------->
        <nav class="navbar">
          <div class="logo">Pixer</div>
          <ul class="links"> 
            <div class="menu">
              <li><a href="nav.php"> <?php  echo "Hello, ";
                            echo $_SESSION['username'];?>
                  </a></li>
              <li onclick="togglePopup()"><a> Upload</a> </li>
              <li><a href="pop.php">Popular</a></li>
              <li><a  onclick="togglePopup1()">Log Out</a></li>
            </div>
          </ul>
        </nav>


          <!-------------------------Designing of upload button------------------------>

    <div class="popup" id="popup-1" >
      <form action="uploading.php" enctype="multipart/form-data" method="post" >
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
              <h1>Upload a Picture</h1>
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
            function togglePopup(){
                document.getElementById("popup-1").classList.toggle("active")};
            </script>

    <!-------------------------Designing of logout button------------------------>

    <div class="popup2" id="popup-2" >
      <div class="content">
      <div class="close-btn" onclick="togglePopup1()">&times;</div>
    <p>Do you really want to Log out?</p>
      <a href="logout.php" >Yes</a>
      <a href="nav.php">No</a>
            </div>
    </div>
        
        <script>
            function togglePopup1(){
                document.getElementById("popup-2").classList.toggle("active")};
            </script>
    </div>
  <!-------------------------for picture section------------------------>
  

    <table>
    <?php 
      $query="select * from image order by name desc";
        $result=mysqli_query($connect,$query);
        while($row=mysqli_fetch_assoc($result))
        {		
    ?>
        <tr>
          <form>
            <td><input type="hidden"  type="submit"  value="<?php echo $row['id']?>"></td>
            <td><img   alt="Image not found"  src="upload/<?php echo $row['name'] ?>"></td>
            <td><a href="nav.php?did=<?php echo $row['id'] ?>">Delete</td>
            <td ><a href="details.php?details=<?php echo $row['id']?>">Details</td>

          </form>
        </tr>
        <?php   
      }
      ?>
      </table>
      <!---------------FOOTER------------->
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
    </body>
    </html>
