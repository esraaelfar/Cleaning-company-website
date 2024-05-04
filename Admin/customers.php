<?php  
require_once('include/header.php');
include('../includes/db/db.php');
if(!isset($_SESSION['login_admin'])){
  header('location: ../login.php');
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
                    <i class="fad fa-users fa-6x text-primary"></i>
                </div>
                <div class="col-md-11 text-left mt-4">
                    <h1 class="ml-5 display-4 font-weight-normal">View All Customers:</h1>
                </div>
            </div>
            <hr>
            <table class="table table-responsive table-hover ">
                <thead class="thead-light">
                    <tr>
                        <th>#Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Join At</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php     
                            $statment = $connect->prepare("SELECT * FROM accounts WHERE role='User'"); 
                            $statment->execute();
                            $customers = $statment->rowCount();
                            $users = $statment->fetchAll();
                            if($customers > 0){
                              foreach($users as  $user) {
                            ?>
                    <tr>
                        <td>
                            <?php echo $user['acc_id'];?>
                        </td>
                        <td width="150px">
                            <?php echo $user['username'];?>
                        </td>
                        <td>
                            <?php echo $user['email'];?>
                        </td>
                        <td>
                            <?php echo $user['phone'] ?>
                        </td>
                        <td>
                            <?php echo $user['address'] ?>
                        </td>
                        <td>
                            <?php echo $user['gender'] ?>
                        </td>
                        <td>
                            <?php
                                if($user['status'] == '1'){
                                    echo "Activated";
                                }else if($user['status'] == '0'){
                                    echo "Blocked";
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo $user['created_at'];?>
                        </td>
                        <td><a href="customers.php"><button class="btn btn-primary btn-sm">EDIT</button></td>
                    </tr>
                    <?php 
                        }
                        }else {
                            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>No Registered Customer Yet</h2></td></tr>";
                        }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
 require_once('include/footer.php');
?>