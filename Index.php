<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 

 
 if( isset($_POST['btn-login']) ) { 
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  if(empty($email)){
   echo "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   echo "Please enter valid email address.";
  }
  
  if(empty($pass)){
   echo "Please enter your password.";
  }
  

   
   $password = hash('sha256', $pass); 
  
   $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); 
   
   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location: home.php");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
    
  
  
 }
?>
<!DOCTYPE html>
<html>

<body>

<div >

 <div >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div >
        
         <div >
             <h2 class="">Sign In.</h2>
            </div>
        
        
            


            
            <div >


             <input type="email" name="email"  placeholder="Your Email" value="<?php echo $email; ?>"  />


                
            </div>
            
            <div >
             <input type="password" name="pass" placeholder="Your Password"  />
            </div>
            
            <div>
             <hr />
            </div>
            
            <div >
             <button type="submit"  name="btn-login">Sign In</button>
            </div>
            
            
            <div >
             <a href="register.php">Sign Up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>
<?php ob_end_flush(); ?>