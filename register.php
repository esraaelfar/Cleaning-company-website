<?php 
include('includes/db/db.php');

$page = "All";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
if($page == "All"){
    $accErr = $nameErr = $emailErr = $passwordErr = $genderErr = $addressErr =  "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleaning Company</title>
    <link rel="stylesheet" href="includes/assets/css/register.css">
    <link rel="stylesheet" href="includes/vendor/bootstrap-5.3.1-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/vendor/fontawesome-free-6.4.2-web/css/all.min.css" />
</head>

<body>
    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2 class="text-center">Sign UP</h2>
                <p class="text-center" style="color: red;"><?php echo $accErr ?></p>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form action="?page=confirm" method="post">
                        <div class="row clearfix">
                            <div class="col_half">
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                    <input type="text" name="fname" placeholder="First Name" required />
                                </div>
                            </div>
                            <div class="col_half">
                                <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                    <input type="text" name="lname" placeholder="Last Name" required />
                                    <p style="color: red;"><?php echo $nameErr ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email" required />
                            <p style="color: red;"><?php echo $emailErr ?></p>
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password" placeholder="Password" required />
                            <p style="color: red;"><?php echo $passwordErr ?></p>
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="confpass" placeholder="Re-type Password" required />
                            <p style="color: red;"><?php echo $passwordErr ?></p>
                        </div>
                        <div class="input_field"> <span><i class="fa-solid fa-mobile"></i></span>
                            <input type="text" name="phone" placeholder="type your phone" required />
                            <p style="color: red;"><?php echo $passwordErr ?></p>
                        </div>
                        <div class="input_field radio_option">
                            <input type="radio" name="gender" value="male" id="rd1"
                                <?php  if(isset($gender) && $gender=="male") echo "checked"; ?>>
                            <label for="rd1">Male</label>
                            <input type="radio" name="gender" value="female" id="rd2"
                                <?php  if(isset($gender) && $gender=="female") echo "checked"; ?>>
                            <label for="rd2">Female</label>
                            <p style="color: red;"><?php echo $genderErr ?></p>
                        </div>
                        <div class="input_field"> <span><i aria-hidden="true" class="fa-solid fa-location-dot"></i></span>
                            <input type="text" name="address" placeholder="Type your address" required />
                            <p style="color: red;"><?php echo $addressErr ?></p>
                        </div>
                        <div class="input_field checkbox_option">
                            <input type="checkbox" id="cb1">
                            <label for="cb1">I agree with terms and conditions</label>
                        </div>
                        <div class="input_field checkbox_option">
                            <input type="checkbox" id="cb2">
                            <label for="cb2">I want to receive the newsletter</label>
                        </div>
                        <input class="btn btn-primary button" type="submit" value="Register" />
                    </form>
                    <a href="login.php" style="margin-left: 86px;">Already have an account?</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php 
}else if($page == "confirm"){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['fname'].$_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confpass = $_POST['confpass'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $statment = $connect->prepare("INSERT INTO `accounts` (username	, `password` , email , phone , `address` , gender , `status` , `role` , created_at)
                                        VALUES (?, ? , ? , ? , ? , ? , '1' , 'user' , now())");
        $statment = $statment->execute(array($username,$password, $email, $phone , $address, $gender));

        $_SESSION['message'] =  "Registration Successful! Please login.";
        header("Location: login.php");

    }
}
?>