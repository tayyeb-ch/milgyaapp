<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
        <section class="dashboard section">

            <div class="container">

                <div class="row">
                    <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                        <?php include("partials/sidebar.php"); ?>
                    </div>
                    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                        <!-- Recently Favorited -->
                        <div class="widget dashboard-container my-adslist">
                            <h3 class="widget-header">Dashboard</h3>
                            <p>Welcome to your dashboard <strong><?php echo $user['fullname']; ?></strong>!</p>
                        </div>
                        
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </section>

<?php include("partials/footer.php"); ?>