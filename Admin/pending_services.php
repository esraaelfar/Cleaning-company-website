<?php include("include/header.php");
  include("../includes/db/db.php");
  if(!isset($_SESSION['login_admin'])){
    header('location: ../login.php');
}                       

?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-3">
            <?php include("include/sidebar.php");?>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-1">
                    <img src="../includes/assets/images/pending.png" alt="" class="pend_icon">
                </div>
                <div class="col-md-11 text-left mt-4 ">
                    <h1 class="ml-3 display-4 font-weight-normal">Pending Services:</h1>
                </div>
            </div>
            <hr>
            <form method="post">
                <table class="table table-responsive table-hover ">
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
                                        echo "<i class='fas fa-exclamation-circle text-warning'></i>". $result['status'];
                                    }
                                    ?>
                            </td>
                            <td><a href="edit_service_verify_pen.php?service_id=<?php echo $result['id']; ?>"><button
                                        type="button" class="btn btn-primary btn-sm">Edit</button></a></td>
                        </tr>
                        <?php 
                            }}else {
                              echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>You have not any Pending Services</h2></td></tr>";
                            }
                        ?>
                    </tbody>
                </table>

                <div class="text-right">

                </div>

            </form>
        </div>



    </div>
</div>
<?php include("include/footer.php"); ?>