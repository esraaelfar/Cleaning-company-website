<?php 
require_once('include/header.php');
include("../includes/db/db.php");
if(!isset($_SESSION['login_admin'])){
    header('location: ../login.php');
}
if(isset($_SESSION['email'])){
    $session_id = $_SESSION['id'];
    $session_email = $_SESSION['email'];
    $session_name = $_SESSION['name'];
}
if(isset($_GET['service_id'])){
    $service_id = $_GET['service_id'];
    $statment = $connect->prepare("SELECT * FROM appointment WHERE id = ?");
    $statment->execute(array("$service_id"));
    $result = $statment->fetch();
}
?>

<div class="container-fluid mt-2">
    <script src="ckeditor/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php require_once('include/sidebar.php'); ?>
        </div>
        
        <div class="col-md-9 col-lg-9">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_id">Service ID:</label>
                            <input type="text" class="form-control" value="<?php echo $result['id'];?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="furniture">Customer Id:</label>
                            <input type="text" class="form-control" value="<?php echo $result['owner_id'] ;?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="furniture">Officer ID:</label>
                            <input type="text" class="form-control" value="<?php echo $result['officer_id'];?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="furniture">Officer Name:</label>
                            <input type="text" class="form-control" value="<?php echo  $result['officer'];?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="size">Address:</label>
                            <input type="text" class="form-control" value="<?php echo $result['address'];?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="size">Service Category & Price:</label>
                            <input type="text" class="form-control" value="<?php echo $result['service'];?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="size">Service_Date:</label>
                            <input type="text" class="form-control" value="<?php echo $result['date'];?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label for="category">Customer Name:</label>
                        <input type="text" class="form-control" value="<?php echo $result['owner'] ?>" disabled>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="size">Customer Phone:</label>
                            <input type="text" class="form-control" value="<?php echo $result['phone'];?>" disabled>
                        </div>
                    </div>

                    
                </div>
                <!-- Grid column -->


                <div class="row mt-3">
                    <div class="col-md-6">
                        <span>Choose Status</span>
                        <select class="form-control" name="status">
                            <?php if($result['status'] == 'Pending'){    
                                echo "<option value='Pending'  selected >Pending</option>";
                                echo "<option value='Verified'>Verified</option>";
                                } else if($result['status'] == 'Verified'){
                                    echo "<option value='Verified' selected >Verified</option>";
                                    echo "<option value='Pending'>Pending</option>";
                                    echo "<option value='Completed'>Completed</option>";
                                } else if ($result['status']=='Completed'){
                                    echo "<option value='Verified' >Verified</option>";
                                    echo "<option value='Pending'>Pending</option>";
                                    echo "<option value='Completed' selected>Completed</option>";
                                }
                    ?> 
                        </select>
                    </div>
                </div>
                <input type="submit" name="update" class=" mt-3 btn btn-primary btn-md" value="Update">
                
            </form>
        </div>

    </div>


<?php 
require_once('include/footer.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
    $status = $_POST['status'];
    $statment = $connect->prepare("UPDATE appointment  SET status=? WHERE id=?");
    $statment->execute(array($status,$service_id));
    if($status=='Pending'){
        header("location:pending_service.php");
    }else if($status=='Verified'){
        header("location:verified_service.php");
    }else if($status=='Completed'){
    header("location:completed_service.php");
    } 
}
?>