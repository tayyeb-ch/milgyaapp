<?php include("partials/head.php"); ?>

        <?php include("partials/top-nav.php"); ?>
        
        <?php include("partials/sidebar.php"); ?>
          
        <?php
            $admin = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM admin"));
        ?>

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="page-header">
                        <h2 class="pageheader-title">Contact Form Submissions</h2>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                            <th>Created At</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $messages = mysqli_query($connection, "SELECT * FROM contact_messages");
                                                $inc = 1;
                                                while ($message = mysqli_fetch_array($messages)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $inc; ?></td>
                                                        <td>
                                                            <strong><?php echo $message['name']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $message['email']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $message['subject']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $message['message']; ?></strong>
                                                        </td>
                                                        <td>
                                                            <a href="contact-form.php?delete=<?php echo $message['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?')" class="btn btn-danger btn-sm">Delete</a>
                                                        </td>
                                                        <td><?php echo $message['created_at'] ?></td>
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
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $delete = mysqli_query($connection, "DELETE FROM contact_messages WHERE id = '$id'");
                header("Location: contact-form.php");
            }
        ?>

<?php include("partials/footer.php"); ?>