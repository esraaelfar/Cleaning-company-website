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
                                class="fa fa-chevron-right"></i></a></span> <span>Pricing <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Pricing</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading mb-3">Price &amp; Plans</span>
                <h2>Choose Your Perfect Plans</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="block-7">
                    <div class="text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa flaticon-sprayer"></span></div>
                        <h4 class="heading-2">Starter</h4>
                        <span class="price"><sup>$</sup> <span class="number">49</span></span>

                        <ul class="pricing-text mb-5">
                            <li><span class="fa fa-check mr-2"></span>Basic cleaning services for small spaces or one-time cleanings</li>
                            <li><span class="fa fa-check mr-2"></span>Essential areas covered such as bathrooms, kitchens, and common areas.</li>
                            <li><span class="fa fa-check mr-2"></span>Standard cleaning equipment and supplies provided.</li>
                            <li><span class="fa fa-check mr-2"></span>One cleaner assigned per session.</li>
                        </ul>

                        <a href="#" class="btn btn-primary px-4 py-3">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="block-7 active">
                    <div class="text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa flaticon-vacuum-cleaner"></span></div>
                        <h4 class="heading-2">Standard</h4>
                        <span class="price"><sup>$</sup> <span class="number">79</span></span>

                        <ul class="pricing-text mb-5">
                            <li><span class="fa fa-check mr-2"></span>Comprehensive cleaning services for homes and small offices.</li>
                            <li><span class="fa fa-check mr-2"></span>Regular scheduled cleanings (weekly, bi-weekly, or monthly)</li>
                            <li><span class="fa fa-check mr-2"></span>Use of environmentally friendly cleaning products upon request.</li>
                            <li><span class="fa fa-check mr-2"></span>Two cleaners assigned per session for faster service.</li>
                        </ul>

                        <a href="#" class="btn btn-primary px-4 py-3">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="block-7">
                    <div class="text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa flaticon-tap"></span></div>
                        <h4 class="heading-2">Premium</h4>
                        <span class="price"><sup>$</sup> <span class="number">109</span></span>

                        <ul class="pricing-text mb-5">
                            <li><span class="fa fa-check mr-2"></span>Extensive cleaning services suitable for larger homes and offices.</li>
                            <li><span class="fa fa-check mr-2"></span>Deep cleaning of all areas, including hard-to-reach spots and high-touch surfaces.</li>
                            <li><span class="fa fa-check mr-2"></span>Interior window cleaning included.</li>
                            <li><span class="fa fa-check mr-2"></span>Assigned team of cleaners for efficient service</li>
                        </ul>

                        <a href="#" class="btn btn-primary px-4 py-3">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="block-7">
                    <div class="text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="fa flaticon-cleaning"></span></div>
                        <h4 class="heading-2">Platinum</h4>
                        <span class="price"><sup>$</sup> <span class="number">159</span></span>

                        <ul class="pricing-text mb-5">
                            <li><span class="fa fa-check mr-2"></span>Premium organic cleaning products used exclusively.</li>
                            <li><span class="fa fa-check mr-2"></span>Deep carpet cleaning and upholstery steaming.</li>
                            <li><span class="fa fa-check mr-2"></span>Specialized treatments for delicate surfaces like marble or hardwood floors.</li>
                            <li><span class="fa fa-check mr-2"></span>Dedicated team of expert cleaners with extensive training and experience.</li>
                        </ul>

                        <a href="#" class="btn btn-primary px-4 py-3">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
include('includes/temp/footer.php');
?>