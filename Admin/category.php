<?php 
  require_once('include/header.php');
  include("../includes/db/db.php");
  if(!isset($_SESSION['login_admin'])){
    header('location: ../login.php');
}

?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php require_once('include/sidebar.php'); ?>
        </div>

        <?php
        if(isset($_GET['del'])){
            $del   = $_GET['del'];
            $statment = $connect->prepare("DELETE FROM categories WHERE id = $del");
            $statment->execute();
        }
        ?>
        <div class="col-md-9 col-lg-9">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-1">
                        <i class="fad fa-th-list fa-6x text-primary"></i>
                    </div>
                    <div class="col-md-11 text-left mt-4">
                        <h1 class="ml-5 display-4 font-weight-normal">View Services Categories:</h1>
                    </div>
                </div>
                <hr>
                <form action="" method="post">
                    <div class="row">
                        <?php
                        if(isset($_POST['submit'])){
                            $service = $_POST['service'];
                            $price = $_POST['price'];
                            $statment = $connect->prepare("INSERT INTO `categories`(`service`, price) VALUES ('$service',' $price')");
                            $statment->execute();
                        } 
                    ?>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="service" class="form-control" placeholder="Add Category">
                                </div>

                                <div class="col-lg-6">
                                    <input type="text" name="price" class="form-control"
                                        placeholder="Add Price">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="submit" name="submit" class="btn btn-primary" value="Add cat" name="category">
                        </div><br />

                    </div>
                </form>
                <?php
                  $statment= $connect->prepare("SELECT * FROM categories ORDER BY id ASC");
                  $statment->execute();
                  $rowcount = $statment->rowCount(); 
                  $result = $statment->fetchAll();
                  if($rowcount > 0){
                ?>
                <!-- Button to Open the Modal -->

                <div class="row mt-5">
                    <div class="col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Services</th>
                                    <th>Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  foreach($result as $row){
                                      $id = $row['id'];
                                      $service = $row['service'];
                                      $price = $row['price'];
                                ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $service;?></td>
                                    <td><?php echo $price;?></td>
                                    <td class="text-center">
                                        <a href="editcat.php?edit=<?php echo $id; ?>"><button type="button"
                                                class="btn btn-primary">Edit</button>
                                        </a>
                                        <a href="category.php?del=<?php echo $id;?>"><button class='ml-2 btn btn-danger'
                                                value='Delete'>Delete</button></a>
                                    </td>
                                </tr>
                                <?php
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>

        </div>
        <!---edit category query-->

        <!-- Modal -->

    </div>
    <?php 

require_once('include/footer.php');
?>