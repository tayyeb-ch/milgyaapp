<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
        <section class="dashboard section">

            <div class="container" style="max-width: 1500px;">

                <div class="row">

                    <div class="col-md-3">
                        <?php include("partials/sidebar.php"); ?>
                    </div>

                    <div class="col-md-9">
                        
                        <div class="widget dashboard-container my-adslist">
                            <h3 class="widget-header">My Requests</h3>
                        </div>
                        
                        <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>

                        <div class="widget dashboard-container my-adslist">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Requested To</th>
                                        <th>Item</th>
                                        <th>Request</th>
                                        <th>Status</th>
                                        <th width="200">Action</th>
                                        <th>Created At</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $requests = mysqli_query($connection, "SELECT * FROM requests WHERE requested_by = '" . $_SESSION['user_id'] . "'");
                                            if (mysqli_num_rows($requests) > 0) {
                                                $inc = 1;
                                                while ($request = mysqli_fetch_array($requests)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <?php
                                                                $user = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $request['posted_by'] . "'"));
                                                            ?>
                                                            <strong><?php echo $user['fullname']; ?></strong><br>
                                                            <a href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a><br>
                                                            <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $item = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM items WHERE id = '" . $request['item_id'] . "'"));
                                                            ?>
                                                            <img src="<?php echo $item['picture']; ?>" class="img-thumbnail" style="width: 25px;height: 25px;"> <strong><?php echo $item['title']; ?></strong><br><br>
                                                            <a href="item.php?id=<?php echo $item['id']; ?>" target="_blank">View Item</a>
                                                        </td>
                                                        <td><?php echo $request['request']; ?></td>
                                                        <td>
                                                            <?php
                                                                if ($request['status'] == "Pending") {
                                                                    echo "<span class='badge badge-secondary'>" . $request['status'] . "</span>";
                                                                } elseif ($request['status'] == "Accepted") {
                                                                    echo "<span class='badge badge-success'>" . $request['status'] . "</span>";
                                                                } elseif ($request['status'] == "Rejected") {
                                                                    echo "<span class='badge badge-danger'>" . $request['status'] . "</span>";
                                                                }
                                                            ?>
                                                            
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($request['status'] == "Accepted") {
                                                                    if ($request['rewarded'] == 0) {
                                                                        ?>
                                                                            <a href="my-requests.php?request_id=<?php echo $request['id']; ?>&posted_by=<?php echo $request['posted_by']; ?>" class="badge badge-primary shadow py-1 px-2" onclick="return confirm('Are you sure you want to give reward to this user?');">Give Reward</a>
                                                                        <?php
                                                                    } else {
                                                                        echo "Reward Given ✔";
                                                                    }
                                                                } else {
                                                                    echo "No Action.";
                                                                }
                                                            ?>
                                                        </td>   
                                                        <td><?php echo $request['created_at']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $inc++;    
                                                }

                                            } else {
                                                echo "<tr class='text-center'><td colspan='6'>You have no requests.</td></tr>";
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

        <?php

            if (isset($_GET['accept'])) {

                $id = $_GET['accept'];

                $accept = mysqli_query($connection, "UPDATE requests SET status = 'Accepted' WHERE id = '$id'");

                $_SESSION['msg'] = "<div class='alert alert-success'>Request Accepted. Please provide this item to its owner to get rewards.</div>";

                header("Location: user-requests.php");

            }

            if (isset($_GET['reject'])) {

                $id = $_GET['reject'];

                $reject = mysqli_query($connection, "UPDATE requests SET status = 'Rejected' WHERE id = '$id'");

                $_SESSION['msg'] = "<div class='alert alert-success'>Request Accepted. Please provide this item to its owner to get rewards.</div>";

                header("Location: user-requests.php");

            }

            if (isset($_GET['request_id']) AND isset($_GET['posted_by'])) {
                
                $request_id = $_GET['request_id'];

                $posted_by = $_GET['posted_by'];

                $requestdetail = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM requests WHERE id = '$request_id'"));

                $user = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '$posted_by'"));

                $reward = mysqli_fetch_array(mysqli_query($connection, "SELECT reward_coins FROM admin"));

                $coins = $user['coins'] + $reward['reward_coins'];
                
                $addcoins = mysqli_query($connection, "UPDATE users SET coins = '$coins' WHERE id = '$posted_by'");

                $rewarded = mysqli_query($connection, "UPDATE requests SET rewarded = 1 WHERE id = '$request_id'");

                $history = mysqli_query($connection, "INSERT INTO reward_history(rewarded_by, rewarded_to, item_id, coins) VALUES('" . $requestdetail['requested_by'] . "', '" . $requestdetail['posted_by'] . "', '" . $requestdetail['item_id'] . "', '$coins')");

                $_SESSION['msg'] = "<div class='alert alert-info'>Thankyou for giving reward to the user.</div>";

                header("Location: my-requests.php");

            }

        ?>

<?php include("partials/footer.php"); ?>