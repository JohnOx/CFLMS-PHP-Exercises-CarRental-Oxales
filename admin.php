<?php
ob_start();
session_start();
require_once './crud/actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['admin' ]) && !isset($_SESSION['user']) ) {
 header("Location: login.php");
 exit;
}

if(isset($_SESSION["user"])){
    header("Location: home.php");
    exit;
  }
// select logged-in users details
$res=mysqli_query($con, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $userRow['user_email' ]; ?></title>


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

        <a class="navbar-brand" href="#">Car Rentals</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Register <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login">Login</a>
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
        
            <a class="btn btn-primary btn-lg" href="crud\add.php" role="button">Add new car</a>
    </div>

    <h1>Car Showroom</h1>
        Hi <?php echo $userRow['user_email' ]; ?>
           
           <a  href="logout.php?logout">Sign Out</a>
    <hr>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Brand</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Modify</th>
            </tr>
        </thead>

        <tbody>
                    <?php
                        $sql = "SELECT * FROM car";
                        $display = mysqli_query($con, $sql);

                        if($display -> num_rows == 0) {
                            echo "No cars to display!";
                        } 
                            elseif($display -> num_rows == 1) {
                                $row = $display -> fetch_assoc();
                                echo "<tr>  <td>".$row['brand']."</td>
                                            <td>".$row['type']."</td>
                                            <td>".$row['price']."</td>
                                                <td> <a href='edit.php?id=" .$row['id']."'><button type='button'>Edit</button></a>
                                                        <a href='delete.php?id=" .$row['id']."'><button type='button'>Delete</button></a>
                                                </td>
                                        </tr>";
                            }
                                else {
                                    $rows = $display -> fetch_all(MYSQLI_ASSOC);
                                    foreach ($rows as $key => $value) {
                                        echo "<tr>  <td>".$value['brand']."</td>
                                                    <td>".$value['type']."</td>
                                                    <td>".$value['price']."</td>
                                                        <td> <a href='edit.php?id=" .$value['id']."'><button type='button'>Edit</button></a>
                                                                <a href='delete.php?id=" .$value['id']."'><button type='button'>Delete</button></a>
                                                        </td>
                                                </tr>";
                                    }
                            }
                    ?>
            </tbody>

            
    </table>

    </body>
    
</html>
<?php ob_end_flush(); ?>