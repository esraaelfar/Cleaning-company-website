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
                <div class="col-md-1 mt-2 px-1">
                    <img src="../includes/assets/images/message-square-dots-svgrepo-com (1).png" alt="" style="width: 120%;">
                </div>
                <div class="col-md-11 text-left mt-4">
                    <h1 class="ml-4 display-4 font-weight-normal">View All Messages:</h1>
                </div>
            </div>
            <hr>
            <table class="table table-responsive table-hover ">
                <thead class="thead-light">
                    <tr>
                        <th>#Id</th>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Content</th>
                        <th>Send At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php     
                            $statment = $connect->prepare("SELECT * FROM `message` ORDER BY created_at DESC"); 
                            $statment->execute();
                            $customers = $statment->rowCount();
                            $users = $statment->fetchAll();
                            if($customers > 0){
                                foreach($users as  $user) {
                            ?>
                    <tr>
                        <td>
                            <?php echo $user['id'];?>
                        </td>
                        <td width="150px">
                            <?php echo $user['owner'];?>
                        </td>
                        <td>
                            <?php echo $user['full_name'];?>
                        </td>
                        <td>
                            <?php echo $user['subject'] ?>
                        </td>
                        <td>
                            <?php echo $user['content'] ?>
                        </td>
                        <td>
                            <?php echo $user['created_at'] ?>
                        </td>
                    </tr>
                    <?php 
                        }
                        }else {
                            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>No Messages Yet</h2></td></tr>";
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