<?php 
include('includes/temp/init.php');
?>
<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="about.php" class="nav-link">About</a></li>
            <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
            <li class="nav-item"><a href="portfolio.php" class="nav-link">Portfolio</a></li>
            <li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
            <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <?php 
                if(isset($_SESSION['login_user'])){
            ?>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            <?php 
                }else if(isset($_SESSION['login_admin'])){
            ?>
            <li class="nav-item"><a href="./Admin/dashboard.php" class="nav-link">Go Back to Dashboard</a></li>
            <?php
                }else{
            ?>
            <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
            <?php } ?>
        </ul>
    </div>
    </div>
</nav>
<!-- END nav -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('includes/assets/images/bg_2.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Staff <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Staff</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-12 heading-section  text-center ftco-animate">
                <span class="subheading">Our Team</span>
                <h2>We have the best team for your needs!</h2>
            </div>
        </div>
        <div class="row">
            <?php 
                $statement = $connect->prepare("SELECT officer_name,position,image FROM team ORDER BY salary DESC ");
                $statement->execute();
                $rowcount = $statement->rowCount();
                if($rowcount > 0){
                    $result  = $statement->fetchAll();
                    foreach($result as $data){
            ?>
            <div class="col-md-5 col-lg-4 ftco-animate d-flex mb-5">
                <div class="staff">
                    <div class="img-wrap d-flex align-items-stretch">
                        <div class="img align-self-stretch" style="background-image:  url(data:image/jpeg;base64,<?php echo base64_encode($data['image']); ?>);"></div>
                    </div>
                    <div class="text pt-3 px-3 pb-4 text-center">
                        <h3><?php echo $data['officer_name']; ?></h3>
                        <span class="position mb-2"><?php echo $data['position']; ?></span>
                    </div>
                </div>
            </div>
            <?php }}else{
                echo "No data found";
            }
            ?>
        </div>
    </div>
</section>
<?php 
include('includes/temp/footer.php');
?>
