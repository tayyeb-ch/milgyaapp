<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
        ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">Reward Settings</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Reward Details</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Reward Coins</strong></td>
                                                <td><?php echo $admin['reward_coins']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Withdraw Limit</strong></td>
                                                <td><?php echo $admin['withdraw_limit']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Update Reward Settings</h3>
                                <form action="" method="POST">
                                    <?php
                                    if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                        if (isset($_POST['updatereward'])) {
                                            
                                            $reward_coins = $_POST['reward_coins'];
                                            $withdraw_limit = $_POST['withdraw_limit'];

                                            $updatereward = mysqli_query($connection, "UPDATE admin SET reward_coins = '$reward_coins', withdraw_limit = '$withdraw_limit'");

                                            $_SESSION['msg'] = "<div class='alert alert-success'>Reward Setting Updated Updated.</div>";

                                            header("Location: reward-setting.php");

                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="">Reward Coins</label>
                                        <input type="number" name="reward_coins" value="<?php echo $admin['reward_coins']; ?>" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Withdraw Limit</label>
                                        <input type="number" name="withdraw_limit" value="<?php echo $admin['withdraw_limit'] ?>" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="updatereward" value="Update" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>


<?php include("partials/footer.php"); ?>