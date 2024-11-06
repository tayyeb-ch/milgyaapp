<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">Dashboard</h2>
                    </div>
                    
                </div>

            </div>
            
            <?php
                $countcategories = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM categories"));
                $countitems = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM items"));
                $countusers = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM users"));
                $countmsgs = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM contact_messages"));
            ?>

            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Categories</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">
                                        <?php echo $countcategories; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Items</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">
                                        <?php echo $countitems; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Users</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1"><?php echo $countusers; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted">Contact Form Submissions</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1"><?php echo $countmsgs; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>


<?php include("partials/footer.php"); ?>