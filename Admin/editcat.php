<?php 
ob_start();
require_once('include/header.php');
include("../includes/db/db.php");
if(!isset($_SESSION['login_admin'])){
    header('location: ../login.php');
} 
if(isset($_GET['edit'])){
    $edit = $_GET['edit'];
    $statment =$connect->prepare("SELECT * FROM categories WHERE id = ?");
    $statment->execute(array($edit));
    $result = $statment->fetch();
    $id = $result['id'];
    $dbcat = $result['service'];
    $catprice = $result['price'];
    }
if(isset($_POST['submit'])){

    $category = $_POST['catname'];
    $price = $_POST['catprice'];
    if($category == $dbcat){
        $error = "Category already Exist!";
    }
    
    
    $statment  = $connect->prepare("UPDATE categories SET service = ? , price = ? WHERE id = ?");
          $statment->execute(array($category,$price,$id));
          if($statment->execute(array($category,$price,$id))){
              $msg = "Catgory Updated Successfully!";
              header("Location:category.php");
    }
    else{
        $error="Not updated";
    }
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
                    <img src="../includes/assets/images/edit-clipboard-svgrepo-com.png" alt="" style="width: 100%;">
                </div>
                <div class="col-md-10 mt-1">
                    <h1 style="font-size:50px;">Edit Services Category</h1>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-md-8">
                    <?php if(isset($msg)){echo "<span class='text-success' style='font-weight:bold;'>$msg</span>";}?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="cid" class="form-control" disabled placeholder="Edit id"
                                    value="<?php echo $id;?>">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="catname" class="form-control" placeholder="Edit Category"
                                    value="<?php echo $dbcat;?>">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="catprice" class="form-control" placeholder="Edit Price"
                                    value="<?php echo $catprice;?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary btn-block"
                                    value="Edit Category">
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>