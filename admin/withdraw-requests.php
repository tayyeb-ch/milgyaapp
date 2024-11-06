<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $requests = mysqli_query($connection, "SELECT * FROM withdraw_requests");
        ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">Withdraw Requests</h2>
                    </div>

                </div>

            </div>
            
            <div class="ecommerce-widget">

                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Coins</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Created At</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $inc = 1;
                                                while ($req = mysqli_fetch_array($requests)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <?php
                                                                $user = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $req['user_id'] . "'"));
                                                            ?>
                                                            <strong><?php echo $user['fullname']; ?></strong><br>
                                                            <a href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a><br>
                                                            <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $req['coins']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $req['status']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($req['status'] == 'Processing') {
                                                                    ?>
                                                                    <a href="withdraw-requests.php?transfer=<?php echo $req['id']; ?>" onclick="return confirm('Are you sure you have transferred the amount to this user?')" class="btn btn-primary btn-sm">Transfer</a>
                                                                    <?php
                                                                } else {
                                                                    echo $req['status'];
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $req['created_at'] ?></td>
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
                
            </div>

        <?php
            if (isset($_GET['transfer'])) {
                $id = $_GET['transfer'];
                $transfer = mysqli_query($connection, "UPDATE withdraw_requests SET status = 'Transferred' WHERE id = '$id'");
                header("Location: withdraw-requests.php");
            }
        ?>

<?php include("partials/footer.php"); ?>