<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <marquee class="bg-gray">
                    <?php
                        $news = mysqli_query($connection, "SELECT * FROM news");
                        while ($new = mysqli_fetch_array($news)) {
                            echo $new['news'] . " | ";
                        }
                    ?>
                </marquee>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light navigation">
                    <img src="images/logo 3.png" width="100px" height="100px" alt="" style="border-radius:100%;border:1px solid black;margin-right:15px;margin-left:-15px;">
                    <a class="navbar-brand" href="index.php">
                        <h1 style="font-family: system-ui;">Find Lost Item</h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto main-nav ">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>
                            <!-- <li class="nav-item dropdown dropdown-slide">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Dashboard<span><i class="fa fa-angle-down"></i></span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="dashboard.html">Dashboard</a>
                                    <a class="dropdown-item" href="dashboard-my-ads.html">Dashboard My Ads</a>
                                    <a class="dropdown-item" href="dashboard-favourite-ads.html">Dashboard Favourite Ads</a>
                                    <a class="dropdown-item" href="dashboard-archived-ads.html">Dashboard Archived Ads</a>
                                    <a class="dropdown-item" href="dashboard-pending-ads.html">Dashboard Pending Ads</a>
                                </div>
                            </li> -->
                        </ul>
                        <ul class="navbar-nav ml-auto mt-10">
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link login-button" href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link text-white add-button" data-toggle="modal" data-target="#logout"><i class="fa fa-power-off"></i> Logout</a>
                                    </li>
                                    <?php
                                } else {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white add-button" href="register.php"><i class="fa fa-plus-circle"></i> Register</a>
                                </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Logout Modal -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
                <h6 class="py-2">Are you sure you want to logout your account?</h6>
            </div>
            <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-lg-between justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- End Logout Modal -->