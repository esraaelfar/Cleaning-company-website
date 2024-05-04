<?php
session_start(); 
include('includes/temp/init.php');
$page = "All";
if(isset($_GET['page'])){
    $page  = $_GET['page'];
}
if($page == "All"){
    if (isset($_SESSION['login_user'])) {
        $email = $_SESSION['login_user'];
    
        $statement = $connect->prepare("SELECT acc_id, username, phone, `address`, gender FROM `accounts` WHERE email=:email");
        $statement->bindParam(":email", $email);
        $statement->execute();       
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }else{
        $result['username'] = "";
        $result['address'] = "";
        $result['phone'] = "";

    }
?>
    <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item "><a href="about.php" class="nav-link">About</a></li>
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
<div class="hero-wrap js-fullheight" style="background-image: url('includes/assets/images/bg_1.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
            data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate">
                <h2 class="subheading">Leave the house cleaning chores to us</h2>
                <h1 class="mb-4">Let us do the dirty work, so you don't have to.</h1>
                <p><a href="#more" class="btn btn-primary mr-md-4 py-2 px-4">Learn more <span
                            class="ion-ios-arrow-forward"></span></a></p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-md-flex justify-content-center">
            <div class="col-md-12">
                <div class="wrap-appointment bg-white d-md-flex pl-md-4 pb-5 pb-md-0">
                    <form action="?page=appointment" class="appointment w-100" method="post">
                        <?php if(isset($_SESSION['message'])){
                            echo '<p class="mt-2 mb-0" style="color:green;">'.$_SESSION['message'].'</p>';
                            unset($_SESSION['message']);
                        } ?>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md d-flex align-items-center pt-4 pt-md-0">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="namee" placeholder="Your Name" value="<?php echo $result['username'] ?>">
                                </div>
                            </div>
                            <div class="col-12 col-md d-flex align-items-center">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0">
                                    <label for="name">Phone number</label>
                                    <input type="text" class="form-control" placeholder="Phone number" name="phone" value="<?php echo $result['phone']; ?>">
                                </div>
                            </div>
                            <div class="col-12 col-md d-flex align-items-center pt-4 pt-md-0">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Your address" value="<?php echo $result['address'] ?>">
                                </div>
                            </div>
                            <div class="col-12 col-md d-flex align-items-center">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0">
                                    <label for="name">Select Services</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="service" id="" class="form-control">
                                                <option>Select Services</option>
                                                <?php 
                                                    $statement = $connect->prepare("SELECT * FROM categories");
                                                    $statement->execute();
                                                    $result = $statement->fetchAll();
                                                    foreach($result as $data){
                                                ?>
                                                <option><?php echo $data['service'] .'--'. $data['price']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md d-flex align-items-center pb-4 pb-md-0">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0">
                                    <label for="name">Officer</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="officer" id="" class="form-control">
                                                <option>Select Cleaners</option>
                                                <?php 
                                                    $statement = $connect->prepare("SELECT officer_name FROM team WHERE position='Officer'");
                                                    $statement->execute();
                                                    $result = $statement->fetchAll();
                                                    foreach($result as $data){
                                                ?>
                                                <option><?php echo $data['officer_name']; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md d-flex align-items-center pt-4 pt-md-0">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0">
                                    <label for="date">Choose Date</label>
                                    <input type="datetime-local" class="form-control" name="date" placeholder="Choose Date">
                                </div>
                            </div>
                            <div class="col-12 col-md d-flex align-items-center align-items-stretch">
                                <div class="form-group py-md-4 py-2 px-4 px-md-0 d-flex align-items-stretch bg-primary">
                                    <input type="submit" value="ASK A SERVICE" class="btn btn-primary py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb" id="more">
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
                                    <span><strong>Sunday – Thursday:</strong> 9am to 8 pm</span>
                                    <span><strong>Saturday :</strong> 9am to 5 pm</span>
                                </p>
                                <h4>Vacations:</h4>
                                <p class="pl-3">
                                    <span>All Friday Days</span>
                                    <span>All Official Holidays</span>
                                </p>
                            </div>
                        </div>
                        <div class="desc p-4 bg-secondary">
                            <h3 class="heading">For Emergency Cases</h3>
                            <span class="phone">(+02) 123 456 7890</span>
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

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Services</span>
                <h2>How We Works</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-workplace"></span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Office Cleaning</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                            unorthographic.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-pool"></span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Pool Cleaning</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                            unorthographic.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-rug"></span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Carpet Cleaning</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                            unorthographic.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-kitchen"></span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Kitchen Cleaning</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                            unorthographic.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-garden"></span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Garden Cleaning</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                            unorthographic.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <span class="flaticon-balcony"></span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Window Cleaning</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                            unorthographic.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt">
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

<section class="ftco-section testimony-section ftco-bg-dark">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
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

<section class="ftco-section ftco-no-pb">
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
                $statment = $connect->prepare("SELECT * FROM news  ORDER BY created_at DESC LIMIT 3");
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
                        <div class="posted mb-3 d-flex">
                            <div class="desc pl-3">
                                <span>Posted by <?php echo $r['publisher']; ?></span>
                                <span><?php echo $r['created_at']; ?></span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="#"><?php echo $r['title']; ?></a></h3>
                        <p><?php echo $r['content']; ?></p>
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
} else if($page == "appointment"){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $namee = $_POST['namee'];
        $phone = $_POST['phone'];
        $service = $_POST['service'];
        $officer = $_POST['officer'];
        $address = $_POST['address'];
        $date = $_POST['date'];
        $email = $_SESSION['login_user'];

        $statement = $connect->prepare("SELECT acc_id FROM accounts WHERE email = ?");
        $statement->execute(array($email));
        $acc_id = $statement->fetchColumn();

        $statement = $connect->prepare("SELECT id FROM team WHERE officer_name = ?");
        $statement->execute(array($officer));
        $officer_id = $statement->fetchColumn();


        $statement = $connect->prepare("INSERT INTO appointment (owner_id,owner,phone,service,officer,address,date,officer_id,status,created_at)
                                        VALUES (?,?,?,?,?,?,?,?,'Pending',NOW()) 
        ");
        $statement->execute(array($acc_id,$namee,$phone,$service,$officer,$address,$date,$officer_id));
        $_SESSION['message'] =  "Successfully made an appointment!";
        header("Location: index.php");
    }
}
?>