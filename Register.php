<?php
 ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php");
 }
 include_once 'dbconnect.php';

 
 if ( isset($_POST['btn-signup']) ) {
  
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  if (empty($name)) {
  echo "Please enter your full name.";
  } 
  
  if (empty($email)) {
  echo "Please enter your full email.";
  } else {


   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    echo "Provided Email is already in use.";
   }
  }



  if (empty($pass)){
   echo "Please enter password.";
  } else if(strlen($pass) < 6) {
   echo "Password must have atleast 6 characters.";
  }
  

  $password = hash('sha256', $pass);
  
   if( !$error ) {
   
   $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
  
 }
?>
<!DOCTYPE html>
<html>

<body>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
           
             <h2 class="">Sign Up.</h2>
         
             <input type="text" name="name"  placeholder="Name"   />
              <br>
            
             <input type="email" name="email"  placeholder="Email"  />
                
            <br>
     
             <input type="password" name="pass" placeholder="Password"  />
         
            <br>
             <button type="submit" name="btn-signup">Sign Up</button>
          <br>
            
             <a href="index.php">Sign in Here...</a>
        
       
   
    </form>
    </div> 

</div>

</body>
</html>
<?php ob_end_flush(); ?>