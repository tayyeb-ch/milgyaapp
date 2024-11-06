<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
    
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <h3 >Contact Us</h3>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-us-content p-4">
                            <h5>Contact Us</h5>
                            <h1 class="pt-3">Hello, what's on your mind?</h1>
                            <p class="pt-3 pb-5">If you are facing any issue regarding our service or have any query just fill the form and hit submit and we will contact you shortly.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="POST">
                            <?php
                                if (isset($_POST['sendmessage'])) {
                                    
                                    $name = mysqli_real_escape_string($connection, $_POST['name']);
                                    $email = mysqli_real_escape_string($connection, $_POST['email']);
                                    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
                                    $message = mysqli_real_escape_string($connection, $_POST['message']);
                                    
                                    $sendmessage = mysqli_query($connection, "INSERT INTO contact_messages(name, email, subject, message) VALUES('$name', '$email', '$subject', '$message')");

                                    if ($sendmessage) {
                                        echo "<div class='alert alert-success'>Your message has been recieved. We will contact you shortly!</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Problem sending message. Please try again!</div>";
                                    }

                                }
                            ?>
                            <fieldset class="p-4">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 py-2">
                                            <span id="fullnamemsg" class="text-danger"></span>
                                            <input id="fullname" type="text" name="name" placeholder="Name *" class="form-control" required>
                                        </div>
                                        <div class="col-lg-6 pt-2">
                                            <input type="email" name="email" placeholder="Email *" class="form-control" required>
                                        </div>
                                        <div class="col-lg-12 pt-2">
                                            <input type="subject" name="subject" placeholder="Subject *" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <textarea name="message" id="" name="message" placeholder="Message *" class="border w-100 p-3" required></textarea>
                                <div class="btn-grounp">
                                    <button type="submit" name="sendmessage" class="btn btn-primary mt-2 float-right">SUBMIT</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    
<?php include("partials/footer.php"); ?>