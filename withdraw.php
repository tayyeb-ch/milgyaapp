<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
        <?php
            $user = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'"));
        ?>

        <section class="dashboard section">

            <div class="container">

                <div class="row">

                    <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                        <?php include("partials/sidebar.php"); ?>
                    </div>

                    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                        
                        <div class="widget dashboard-container my-adslist">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>My Wallet</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="withdraw.php" class="badge badge-dark py-3 px-4">Withdraw</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="widget dashboard-container my-adslist">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Wallet Balance</h4>
                                    <p><?php echo $user['coins']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Minimum Withdraw Limit</h4>
                                    <p>5000</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="widget dashboard-container my-adslist">
                            
                            <h4 class="mb-30">Withdraw Coins</h4>
                            <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                            ?>
                            <form action="" method="POST">
                                <?php
                                    if (isset($_POST['withdraw'])) {
                                        
                                        $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));

                                        if ($_POST['coins_to_withdraw'] <= $user['coins'] AND $_POST['coins_to_withdraw'] >= $admin['withdraw_limit']) {
                                            
                                            $coins_to_withdraw = $_POST['coins_to_withdraw'];

                                            $coins_left = $user['coins'] - $coins_to_withdraw;

                                            $minus = mysqli_query($connection, "UPDATE users SET coins = '$coins_left' WHERE id = '" . $_SESSION['user_id'] . "'");

                                            $save = mysqli_query($connection, "INSERT INTO withdraw_requests(user_id, coins) VALUES('" . $_SESSION['user_id'] . "', '$coins_to_withdraw')");

                                            $_SESSION['msg'] = "<div class='alert alert-success'>Request Submitted.</div>";

                                            header("Location: withdraw.php");

                                        } else {
                                                
                                            $_SESSION['msg'] = "<div class='alert alert-success'>Insufficiant Coins. Please write correctly.</div>";

                                            header("Location: withdraw.php");

                                        }

                                    }
                                ?>
                                <div class="form-group">
                                    <label for="">Enter Coins</label>
                                    <input type="number" name="coins_to_withdraw" placeholder="Enter Coins" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="withdraw" value="Withdraw" class="btn btn-dark">
                                </div>
                            </form>

                        </div>
                        
                        <div class="widget dashboard-container my-adslist">
                            
                            <h4 class="mb-30">Withdraw History</h4>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Coins Withdraw</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $requests = mysqli_query($connection, "SELECT * FROM withdraw_requests WHERE user_id = '" . $_SESSION['user_id'] . "'");
                                            $inc = 1;
                                            while ($req = mysqli_fetch_array($requests)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $inc; ?></td>
                                                    <td><?php echo $req['coins']; ?></td>
                                                    <td><?php echo $req['status']; ?></td>
                                                    <td><?php echo $req['created_at']; ?></td>
                                                </tr>
                                                <?php
                                                $inc++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        
                    </div>

                </div>
                
            </div>

        </section>

<?php include("partials/footer.php"); ?>