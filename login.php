<?php 
session_start();
include('includes/db/db.php');

$page = "All";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
if($page == "All"){
    $email = "";

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
    <div class="form_wrapper" style="margin: 13% auto 0;">
        <div class="form_container">
            <div class="title_container">
                <h2 class="text-center">Sign in</h2>
                <p class="text-center" style="color: red;"><?php 
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                } ?></p>
            </div>
            <div class="row clearfix">
                <div class="">
                    <form action="?page=confirm" method="post">
                        <div class="input_field"> 
                            <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required />
                            <p style="color: red;"></p>
                        </div>
                        <div class="input_field"> 
                            <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            <input type="password" name="password" placeholder="Password" required />
                            <p style="color: red;"></p>
                        </div>
                        <input class="btn button" type="submit" value="Login in" />
                    </form>
                    <span>Don't have an account?<a href="register.php">register now</a></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php 
}else if($page == "confirm"){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $statment = $connect->prepare("SELECT * FROM `accounts` WHERE email=? and `password`=?");
        $statment->execute(array($email,$password));
        $userCount = $statment->rowCount();
        if($userCount > 0){
            $result = $statment->fetch();
            if($result['status']==1){
                if($result['role']== "admin"){
                    $_SESSION['login_admin'] = $email;
                    header('Location:Admin/dashboard.php');
                }else if($result['role'] == "user"){
                    $_SESSION['login_user'] = $email;
                    header('Location:index.php');
                }

            }else{
                $_SESSION['message'] = "Not activated";
                header('Location: login.php');
            }

        }else{
            $_SESSION['message'] = "Invalid email or password";
            header('Location: login.php');
        }
    }
}
?>