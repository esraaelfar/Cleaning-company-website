<?php 
session_start();
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
                                class="fa fa-chevron-right"></i></a></span> <span>Blog <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Blog</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">News &amp; Blog</span>
                <h2>Latest News</h2>
            </div>
        </div>
        <div class="row d-flex">
            <?php 
            try{
                $statment = $connect->prepare("SELECT * FROM news  ORDER BY created_at DESC");
                $statment->execute();
                $rowcount = $statment->rowCount();
                
                if($rowcount > 0){
                    $result = $statment->fetchAll();
                    foreach($result as $r){
                
            ?>
            <div class="col-md-6 col-lg-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="blog-single.html" class="block-20 rounded"
                        style="background-image: url(data:image/jpeg;base64,<?php echo base64_encode($r['image']); ?>);">
                    </a>
                    <div class="text mt-3 px-4">
                        <div class="posted mb-0 d-flex">
                            <div class="desc pl-3">
                                <span>Posted by <?php echo $r['publisher']; ?></span>
                                <span><?php echo $r['created_at']; ?></span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#"><?php echo $r['title']; ?></a></h3>
                        <p style="font-size: 15px;"><?php echo $r['content']; ?></p>
                    </div>
                </div>
            </div>
            <?php }}else{
                echo "No Data Found";
            }}catch(PDOException $e){echo $e;}
            ?>
        </div>
    </div>
</section>
<?php 
include('includes/temp/footer.php');
?>