<?php
ob_start();
session_start(); // start a new session or continues the previous
require_once './crud/actions/db_connect.php';

if( isset($_SESSION['user'])!="" ){
 header("Location: home.php" ); // redirects to home.php
}


$error = false;

if ( isset($_POST['btn-login']) ) {
 

 $email = trim($_POST[ 'email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);


 if(empty($email)){
    $error = true;
    $emailError = "Please enter your email address.";
   } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;
    $emailError = "Please enter valid email address.";
   }
 // password validation
  if (empty($pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($pass) < 6) {
  $error = true;
  $passError = "Password must have at least 6 characters." ;
 }


 // if there's no error, continue to login
 if (!$error) {
 
    $password = hash( 'sha256', $pass); // password hashing
  
    $res=mysqli_query($con, "SELECT * FROM users WHERE user_email='$email'" );
    $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row
   
    if( $count == 1 && $row['userpw' ]==$password ) {
        if($row["status"] == 'admin'){
            $_SESSION["admin"] = $row["user_id"];
            header("Location: admin.php");
      
          }else {
            $_SESSION['user'] = $row['user_id'];
            header( "Location: home.php");
          }
         
        } else {
         $errMSG = "Incorrect Credentials, Try again..." ;
        }
   
   }
  
  }
  ?>



<!DOCTYPE html>
<html>

<head>

    <title>User Login</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    <style>
        #jambo {
            background-image: url("https://cdn.pixabay.com/photo/2012/11/02/13/02/ford-63930_960_720.jpg");
            background-repeat: no-repeat;
            background-size: cover;
           
        }

    </style>

</head>





<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">

        <a class="navbar-brand" href="register.php">Car Rentals</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Register <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
        </div>
    </nav>

    <div class="jumbotron" id="jambo">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>


<div class ="container">

    <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
    
        
                    <h2>Please sign in:</h2>
                    <hr />
                
                    <?php
        if ( isset($errMSG) ) {
        
        ?>
                <div  class="alert alert-<?php echo $errTyp ?>" >
                                <?php echo  $errMSG; ?>
            </div>

        <?php
        }
        ?>
         
    <div class="form-row">
  
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email" placeholder = "Enter Your Email"   maxlength = "40"   value = "<?php echo $email ?>" >
                <span  class = "text-danger" > <?php   echo  $emailError; ?> </span >
            </div>

            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder = "Enter Password at least 6 characters"   maxlength = "25">
                <span  class = "text-danger" > <?php   echo  $passError; ?> </span >
            </div>

        </div>


                <button type="submit" class="btn btn-primary" name = "btn-login" >Login</button>
    </form>

        <hr />
 
                <a  href="register.php">Sign Up Here...</a>
   
 
</div>


</body >

</html >
<?php  ob_end_flush(); ?>