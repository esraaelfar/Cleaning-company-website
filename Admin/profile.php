<?php 
require_once('include/header.php');
include("../includes/db/db.php");

if(!isset($_SESSION['login_admin'])){
  header('location: ../login.php');
}
if(isset($_SESSION['login_admin'])){
    $session_email = $_SESSION['login_admin'];
}
?>
<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php require_once('include/sidebar.php'); ?>
        </div>

        <div class="col-md-9 col-lg-9">

            <div class="row">
                <div class="col-md-1">
                    <i class="fad fa-user-cog fa-6x text-primary"></i>
                </div>
                <div class="col-md-11 text-left mt-4">
                    <h1 class="ml-5 display-4 font-weight-normal">Profile Setting:</h1>
                </div>
            </div>
            <hr>

            <!-- Extended material form grid -->
            <form method="post" enctype="multipart/form-data">
                <?php
                  $statment = $connect->prepare("SELECT * FROM accounts WHERE role='admin' AND email = ?");
                  $statment->execute(array($session_email));
                  $result = $statment->fetch();
                  $username =  $result["username"];
                  $pass = $result['password'];
                  $message = '';
                  if(isset($_POST['submit']))
                  {  
                      $name   = $_POST['name'];
                      $password = $_POST['password'];                   
                      $statment = $connect->prepare("UPDATE accounts SET username=?, `password`=? WHERE acc_id =?");
                      $statment->execute(array($name,$password,$session_id));
                      if($statment->execute(array($name,$password,$session_id))==TRUE){
                          $message = "Profile Has Been Updated";
                          header('location:profile.php');
                      }
                  }
                  ?>
                <div class="row">
                    <?php if(isset($message)){
                        echo "<p style='color:green; font-weight:bold;'>$message</p>";
                    }?>
                    <div class="col-md-12 mt-4">
                        <label for="name" class="font-weight-bold">Email:</label> <?php echo $session_email;?>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Name:</label>
                            <input type="text" name="name" value="<?php echo $username;?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Password:</label>
                            <input type="password" name="password" value="<?php echo $pass;?>"
                                class="form-control" id="inputPassword4MD" placeholder="Password">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-primary btn-md" value="Submit">
            </form>
        </div>
    </div>
    <!-- Extended material form grid -->
</div>

<?php 
require_once('include/footer.php');
?>