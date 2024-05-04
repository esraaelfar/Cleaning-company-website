<?php 

include('include/header.php');
include('../includes/db/db.php');

if(!isset($_SESSION['login_admin'])){
    $_SESSION['message'] = "You must login first";
    header('location:../login.php');
}
if(isset($_SESSION['login_admin'])){
    $email = $_SESSION['login_admin'];
}

?>
<div class="container-fluid mt-2">
    <div class="row">
        <!---sidenavbar Column-->
        <div class="col-md-3 col-lg-3">
            <?php require_once('include/sidebar.php'); ?>
        </div>
        <!---Main Column -->
        <div class="col-md-9 col-lg-9">
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <img src="../includes/assets/images/thumbtack-svgrepo-com.png" alt=""
                                    style="width: 19%;">
                            </div>
                            <?php  
                                $statment = $connect->prepare("SELECT * FROM appointment WHERE  status='Pending'");
                                $statment->execute();
                                $services_count = $statment->rowCount();
                                $result = $statment->fetchAll();
                            ?>
                            <div class="mr-5"> <span style="font-size:24px;"><?php echo $services_count;?></span>
                                Pending Services</div>

                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="pending_services.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <img src="../includes/assets/images/completed.png" style="width: 20%;" alt="">
                            </div>
                            <div class="mr-5">
                                <?php  
                                    $statment = $connect->prepare("SELECT * FROM appointment WHERE  status='Completed'");
                                    $statment->execute();
                                    $services_comp = $statment->rowCount();
                                ?>
                                <span style="font-size:24px;"><?php echo $services_comp;?></span> Completed
                                Services
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="completed_service.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fad fa-fw fa-users fa-2x"></i>
                            </div>
                            <div class="mr-5">
                                <?php  
                                    $statment = $connect->prepare("SELECT * FROM accounts WHERE role='User'"); 
                                    $statment->execute();
                                    $customers = $statment->rowCount();
                                    $users = $statment->fetchAll();
                                ?>
                                <span style="font-size:24px;"><?php echo $customers;?></span> Active Customers
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="customers.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <img src="../includes/assets/images/message.png" alt="" style="width: 20%;">
                            </div>
                            <div class="mr-5">
                                <?php  
                                    $statment = $connect->prepare("SELECT * FROM `message`");
                                    $statment->execute();
                                    $messages_count = $statment->rowCount();
                                ?>
                                <span style="font-size:24px;"><?php echo $messages_count; ?></span> Messages
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="message.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- DataTables Example -->
            <h3 class="mt-5">New Services</h3>
            <table class="table table-responsive table-hover mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>Service ID</th>
                        <th>Customer Id</th>
                        <th>Officer ID</th>
                        <th>Officer Name</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Address</th>
                        <th>Service Category & Price</th>
                        <th>Service_Date</th>
                        <th>Service_Status</th>
                        <th>Change Status </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                            $statment = $connect->prepare("SELECT * FROM appointment WHERE status='Pending'");
                            $statment->execute();
                            $rowcount = $statment->rowCount(); 
                            if($rowcount > 0){
                                $results = $statment->fetchAll();
                                foreach ($results as $result) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $result['id'];?>
                        </td>
                        <td>
                            <?php echo $result['owner_id'];?>
                        </td>
                        <td>
                            <?php echo $result['officer_id'];?>
                        </td>
                        <td>
                            <?php echo $result['officer'];?>
                        </td>
                        <td>
                            <?php echo $result['owner'];?>
                        </td>
                        <td>
                            <?php echo $result['phone'];?>
                        </td>
                        <td>
                            <?php echo $result['address'];?>
                        </td>
                        <td>
                            <?php echo $result['service'];?>
                        </td>

                        <td><?php echo $result['date'];?></td>

                        <td>
                            <?php 
                                    if($result['status'] == 'Pending'){
                                        echo "<i class='fas fa-exclamation-circle text-warning'></i> $result[status]";
                                    }
                                    ?>
                        </td>

                        <td><a href="pending_services.php"><button class="btn btn-primary btn-sm">Verify
                                    order</button></td>
                    </tr>
                    <?php 
                            }}else {
                                echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>You have not any Pending Services</h2></td></tr>";
                            }
                        ?>
                </tbody>
            </table>

            <h3 class="mt-5">Customers Account</h3>
            <table class="table table-responsive table-hover mt-3">
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






<!-- /.container-fluid -->
<?php include('include/footer.php');?>