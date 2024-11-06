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
                            
                            <h4>Wallet Balance</h4>
                            <p><?php echo $user['coins']; ?></p>

                        </div>
                        
                        <div class="widget dashboard-container my-adslist">
                            
                            <h4 class="mb-30">Reward History</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Rewarded By</th>
                                        <th>Item</th>
                                        <th>Coins</th>
                                        <th>Created At</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $histories = mysqli_query($connection, "SELECT * FROM reward_history WHERE rewarded_to = '" . $_SESSION['user_id'] . "'");
                                            $inc = 1;
                                            while ($row = mysqli_fetch_array($histories)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td>
                                                        <?php
                                                            $rewardedby = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $row['rewarded_by'] . "'"));
                                                        ?>
                                                        <strong><?php echo $rewardedby['fullname']; ?></strong><br>
                                                        <a href="tel:<?php echo $rewardedby['phone']; ?>"><?php echo $rewardedby['phone']; ?></a><br>
                                                        <a href="mailto:<?php echo $rewardedby['email']; ?>"><?php echo $rewardedby['email']; ?></a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $item = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM items WHERE id = '" . $row['item_id'] . "'"));
                                                        ?>
                                                        <img src="<?php echo $item['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <strong><?php echo $item['title']; ?></strong><br><br>
                                                        <a href="item.php?id=<?php echo $item['id']; ?>" target="_blank">View Item</a>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['coins']; ?>
                                                    </td>
                                                    <td><?php echo $row['created_at']; ?></td>
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