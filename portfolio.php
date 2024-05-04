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
                                class="fa fa-chevron-right"></i></a></span> <span>Portfolio <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Portfolio</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-12 heading-section  text-center ftco-animate">
                <span class="subheading">Our Project</span>
                <h2>We have done many latest cleaning project</h2>
            </div>
        </div>
        <div class="row">
        <?php 
            try {
                $statment = $connect->prepare("SELECT * FROM gallery LIMIT 8");
                $statment->execute();
                $rowcount = $statment->rowCount();
                if($rowcount >0){
                    $result = $statment->fetchAll();
                    foreach ($result as $data) { ?>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="work img d-flex align-items-center" style="background-image: url(data:image/jpeg;base64,<?php echo base64_encode($data['image']); ?>);" onclick="openImage(this)" id="thumbnail">
                    <a href="includes/assets/images/work-1.jpg"
                        class="icon image-popup d-flex justify-content-center align-items-center">
                        <span class="fa fa-expand"></span>
                    </a>
                    <div class="desc w-100 px-4 text-center pt-5 mt-5">
                        <div class="text w-100 mb-3 mt-4">
                            <h2><a href="work-single.html"><?php echo $data['description']; ?></a></h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
                } else {
                    echo "No Projects found.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            <!-- The modal -->
            <div id="myModal" class="modal">
            <span class="close" onclick="closeImage()">&times;</span>
            <img class="modal-content" id="modalImage">
            </div>
        </div>
    </div>
</section>
<?php 
include('includes/temp/footer.php');
?>