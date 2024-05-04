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
                                class="fa fa-chevron-right"></i></a></span> <span>About us <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">About Us</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row d-flex no-gutters">
            <div class="col-md-6 d-flex">
                <div class="img d-flex align-items-center justify-content-center py-5 py-md-0"
                    style="background-image:url(includes/assets/images/about.jpg);">
                    <div class="time-open-wrap">
                        <div class="desc p-4">
                            <h2>Business Hours</h2>
                            <div class="opening-hours">
                                <h4>Opening Days:</h4>
                                <p class="pl-3">
                                    <span><strong>Monday – Friday:</strong> 9am to 20 pm</span>
                                    <span><strong>Saturday :</strong> 9am to 17 pm</span>
                                </p>
                                <h4>Vacations:</h4>
                                <p class="pl-3">
                                    <span>All Sunday Days</span>
                                    <span>All Official Holidays</span>
                                </p>
                            </div>
                        </div>
                        <div class="desc p-4 bg-secondary">
                            <h3 class="heading">For Emergency Cases</h3>
                            <span class="phone">(+01) 123 456 7890</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-md-5 pt-md-5">
                <div class="row justify-content-start py-5">
                    <div class="col-md-12 heading-section ftco-animate">
                        <span class="subheading">Welcome to Cleaning Company</span>
                        <h2 class="mb-4">Let's make you fresher than ever</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the
                            Semantics, a large language ocean. A small river named Duden flows by their place and
                            supplies it with the necessary regelialia. It is a paradisematic country, in which roasted
                            parts of sentences fly into your mouth.</p>
                    </div>
                </div>
                <div class="row ftco-counter py-5" id="section-counter">
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="45">0</strong>
                            </div>
                            <div class="text">
                                <span>Years of <br>Experienced</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="2342">0</strong>
                            </div>
                            <div class="text">
                                <span>Happy <br>Customers</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text">
                                <strong class="number" data-number="30">0</strong>
                            </div>
                            <div class="text">
                                <span>Building <br>Cleaned</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 pr-md-4 pb-lg-0 pb-4">
                <div class="heading-section ftco-animate text-center text-lg-left">
                    <span class="subheading">Team &amp; Staff</span>
                    <h2>Our Team</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                        is a paradisematic country</p>
                    <p><a href="staff.php" class="btn btn-secondary">View All Staff</a></p>
                </div>
            </div>
            <?php
                $statement = $connect->prepare("SELECT officer_name,position,image FROM team ORDER BY salary DESC LIMIT 3 ");
                $statement->execute();
                $rowcount = $statement->rowCount();
                if($rowcount > 0){
                    $result  = $statement->fetchAll();
                    foreach($result as $data){
            ?>
            <div class="col-md-4 col-lg-3 ftco-animate d-flex">
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


<section class="ftco-section testimony-section bg-light">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Testimonies</span>
                <h2>Happy Customer</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-quote-right"></span></div>
                            <div class="text">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="user-img" style="background-image: url(includes/assets/images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                                <p class="mb-1">Far far away, behind the word mountains, far from the countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-quote-right"></span></div>
                            <div class="text">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="user-img" style="background-image: url(includes/assets/images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                                <p class="mb-1">Far far away, behind the word mountains, far from the countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-quote-right"></span></div>
                            <div class="text">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="user-img" style="background-image: url(includes/assets/images/person_3.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                                <p class="mb-1">Far far away, behind the word mountains, far from the countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-quote-right"></span></div>
                            <div class="text">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="user-img" style="background-image: url(includes/assets/images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                                <p class="mb-1">Far far away, behind the word mountains, far from the countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-quote-right"></span></div>
                            <div class="text">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="user-img" style="background-image: url(includes/assets/images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                                <p class="mb-1">Far far away, behind the word mountains, far from the countries Vokalia
                                    and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-intro" style="background-image: url('includes/assets/images/bg_3.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2>Together we will explore new things</h2>
                <a href="" class="icon-video d-flex align-items-center justify-content-center"><span
                        class="fa fa-play"></span></a>
            </div>
        </div>
    </div>
</section>
<?php 
include('includes/temp/footer.php');
?>