<!-- <meta http-equiv="refresh" content="60;url=userlogin.php">   -->
 <!DOCTYPE html>
<html>
 
<?php
 include("connection.php");
session_start();
    if(!isset($_SESSION['x']))
        header("location:userlogin.php");
    
    
   
    
    $u_id=$_SESSION['u_id'];
        
        $result=mysqli_query($conn,"SELECT id_no FROM user where u_id='$u_id' ");
        $q2=mysqli_fetch_assoc($result);
        $id_no=$q2['id_no'];
    
        $result1=mysqli_query($conn,"SELECT u_name FROM user where u_id='$u_id' ");
        $q2=mysqli_fetch_assoc($result1);
        $u_name=$q2['u_name'];
    
    
        if (isset($_POST['s'])) {
          $con = mysqli_connect('localhost', 'root', '');
          if (!$con) {
              die('could not connect: ' . mysqli_error());
          }
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $location = $_POST['location'];
              $type_crime = $_POST['type_crime'];
              $d_o_c = $_POST['d_o_c'];
              $description = $_POST['description'];
      
              $var = strtotime(date("Ymd")) - strtotime($d_o_c);
      
              if ($var >= 0) {
                  // Handle image upload
                  $targetDir = "imageuploads/"; // Specify the target directory
                  $targetFile = $targetDir . basename($_FILES["my_image"]["name"]); // Get the file name with the target directory
                  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Get the file extension
      
                  // Check if the uploaded file is an image
                  $validExtensions = array("jpg", "jpeg", "png", "gif"); // Define the allowed extensions
                  if (in_array($imageFileType, $validExtensions)) {
                      $maxFileSize = 64 * 1024 * 1024; // Maximum file size in bytes (64MB)
                      if ($_FILES["my_image"]["size"] <= $maxFileSize) {
                          if (move_uploaded_file($_FILES["my_image"]["tmp_name"], $targetFile)) {
                              $image_url = $targetFile; // Store the file path or name in the $image_url variable
      
                              // Perform database insertion or update with $image_url
                              $comp = "INSERT INTO complaint (id_no, location, type_crime, d_o_c, description, image_url) VALUES ('$id_no', '$location', '$type_crime', '$d_o_c', '$description', '$image_url')";
                              $res = mysqli_query($conn, $comp);
      
                              if (!$res) {
                                  $message1 = "Complaint already filed";
                                  echo "<script type='text/javascript'>alert('$message1');</script>";
                              } else {
                                  $message = "Complaint Registered Successfully";
                                  echo "<script type='text/javascript'>alert('$message');</script>";
                              }
                          } else {
                              // Failed to move the uploaded file
                              $message = "Failed to upload the image.";
                              echo "<script type='text/javascript'>alert('$message');</script>";
                          }
                      } else {
                          // File size exceeds the limit
                          $message = "The file size should not exceed 64MB.";
                          echo "<script type='text/javascript'>alert('$message');</script>";
                      }
                  } else {
                      // Invalid file extension
                      $message = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                      echo "<script type='text/javascript'>alert('$message');</script>";
                  }
              } else {
                  $message = "Enter Valid Date";
                  echo "<script type='text/javascript'>alert('$message');</script>";
              }
          }
      }
      
      

?>




                                    
    
 <script>
     function f1()
        {
           var sta1=document.getElementById("desc").value;
           var x1=sta1.trim();
          if(sta1!="" && x1==""){
          document.getElementById("desc").value="";
          document.getElementById("desc").focus();
          alert("Space Found");
        }
}
 </script>
   
<head>
	<title>Complainer Home Page</title>
 

  <link rel="stylesheet" type="text/css" href="./Assets/css/complainerpage.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">



</head>

 <body>

         <header>
         <a href=""> <img class="pic" src="./Assets/pictures/logos.png" alt="Addis Ababa police commission logo"  ></a>
         
         
         <nav class="navigation">
            
            
            <a href="home.php" > Home </a>
            <a href="complainer_page.php" class="active">Log New Complain </a>
            <a href="complainer_complain_history.php">Complaint History</a>
        
       
         </nav>   
</header>
<main>
	<div class="wrapper">
       <a href="userlogin.php" class="icon-close"> <ion-icon name="close-outline"></ion-icon></a>

          <div class="form-box login">
          <h2 style="color:#659DBD"> Welcome <?php echo "$u_name" ?> </h2>
          <p><h3 style="text-align:center; margin-top:5px; color:white;">Log New Complain</h3></p><br>
      
	   	<form method="post" enctype="multipart/form-data">


             <div class="input-box">
                            
                 <span class="icon"><ion-icon name="id-card"></ion-icon></span>
                 <input type="text"  name="ID_number" placeholder="ID Number" required="" disabled value=<?php echo "$id_no"; ?>>
                 <label for="exampleInputEmail1">ID Number</label>
      
                </div>

                <div class="input-dropdown">

                       <p style="margin-bottom:8px; padding-left:3px;  color:white;"> Location of Crime</p>  
                              <select class="form-control" name="location">
                                <option>Akaki-Kality</option>
                                <option>Addis Ketema</option>
                                <option>Arada</option>
                                <option>Bole</option>
                                <option>Gulele</option>
                                <option>Kolfe Keranio</option>
                                <option>Lideta</option>
                                <option>Nefas Silk-Lafto</option>
                                <option>Kirkos</option>
                                <option>Yeka</option>
                                <option>Lemi Kura</option>
                                
                              </select>
                       <div>    
                        
                       <br>
                       <p style="margin-bottom:8px; padding-left:3px;color:white;"> Type of Crime</p> 
                            <select class="form-control" name="type_crime">
                                    <option>Theft</option>
                                    <option>Robbery</option>
                                    <option>Pick Pocket</option>
                                    <option>Murder</option>
                                    <option>Rape</option>
                                    <option>Molestation</option>
                                    <option>Kidnapping</option>
                                    <option>Missing Person</option>
                            </select>

                           
                    </div>
                      
           <div class="input-box">
              
               
              	<input style="display:flex;" type="date" name="d_o_c" required>
                <label for="exampleInputEmail1">	Date Of Crime  </label>
           
            </div>
     <!-- change to text area         -->
           <div class="input-box" >
       
                <span class="icon"><ion-icon name="reader"></ion-icon></ion-icon></span>
                <input type="text" name="description" rows="20" cols="50" placeholder="Describe the incident in details with time" onfocusout="f1()" id="desc" required>
                <label for="exampleInputPassword1">	Description </label>
              </div>

            

  
           <p style="margin-bottom:8px; padding-left:3px;  color:white;">	Upload Image </p> <br>
           <input type="file"  name="my_image" > <br> <br>

     


              <button type="submit" class="btn" name="s">Submit</button>
       </form>    
       

        
    </div>
    </div>
</main>

<?php
  include("footers.php");
  ?>



<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>