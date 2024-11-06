<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
        
        <?php
            if (isset($_GET['id'])) {
                
                $item_id = $_GET['id'];

                $item = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM items WHERE id = '$item_id'"));

                $postedBy = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $item['user_id'] . "'"));

                $category = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM categories WHERE id = '" . $item['category_id'] . "'"));

                $views = $item['views'] + 1;

                $updateViewCount = mysqli_query($connection, "UPDATE items SET views = '$views' WHERE id = '$item_id'");

                $specifications = mysqli_query($connection, "SELECT * FROM item_specifications WHERE item_id = '$item_id'");

                $reviews = mysqli_query($connection, "SELECT * FROM user_reviews WHERE review_to = '" . $item['user_id'] . "'");

            }
        ?>

        <style>
            .product_review_form input {
                border: 1px solid #ddd;
                background: none;
                width: 100%;
                height: 40px;
                padding: 0 20px;
            }
            .rate:not(:checked) > label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #ccc;
            }
            .rate:not(:checked) > label:before {
                content: '★ ';
            }
            .rate:not(:checked) > label:hover, .rate:not(:checked) > label:hover ~ label {
                color: #deb217;
            }
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
            }
            .rate:not(:checked) > input {
                display: none;
            }
            .rate:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
            }
            .rate:not(:checked) > label:before {
                content: '★ ';
            }
            .rate > input:checked ~ label {
                color: #ffc700;    
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #deb217;  
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #c59b08;
            }
        </style>

        <?php
            if (isset($_POST['submitreview'])) {
                
                $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);
                $rate = mysqli_real_escape_string($connection, $_POST['rate']);
                $review_from = mysqli_real_escape_string($connection, $_POST['review_from']);
                $review_to = mysqli_real_escape_string($connection, $_POST['review_to']);
                $review_description = mysqli_real_escape_string($connection, $_POST['review_description']);

                $addreview = mysqli_query($connection, "INSERT INTO user_reviews(review_from, review_to, item_id,rating, review_description) VALUES('$review_from', '$review_to', '$item_id','$rate', '$review_description')");

                if ($addreview) {
                    echo "<div class='alert alert-success'>Review Submited.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Problem submitting review.</div>";
                }

            }

            if (isset($_POST['sendrequest'])) {
                
                $requested_by = $_POST['requested_by'];
                $posted_by = $_POST['posted_by'];
                $item_id = $_POST['item_id'];
                $request = $_POST['request'];

                $checkRequestDuplication = mysqli_query($connection, "SELECT * FROM requests WHERE requested_by = '$requested_by' AND posted_by = '$posted_by' AND item_id = '$item_id'");

                if (mysqli_num_rows($checkRequestDuplication) > 0) {
                    echo "<div class='alert alert-danger'>You have already submitted the request to this user.</div>";
                } else {

                    $sendrequest = mysqli_query($connection, "INSERT INTO requests(requested_by, posted_by, item_id, request) VALUES('$requested_by', '$posted_by', '$item_id', '$request')");

                    echo "<div class='alert alert-success'>Request Submitted Successfully!</div>";

                }

            }

        ?>
        <section class="section bg-gray">
            
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="product-details">
                            <h1 class="product-title"><?php echo $item['title']; ?></h1>
                            <div class="product-meta">
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fa fa-user-o"></i> By <a><?php echo $postedBy['fullname']; ?></a></li>
                                    <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category<a><?php echo $category['name']; ?></a></li>
                                    <li class="list-inline-item"><i class="fa fa-location-arrow"></i> Location<a><?php echo $item['location']; ?></a></li>
                                    <li class="list-inline-item"><i class="fa fa-eye" aria-hidden="true"></i> Views<a><?php echo $item['views']; ?></a></li>
                                </ul>
                            </div>
                            <?php
                                if (!empty($item['picture'])) {
                                    $itempicturepath = $item['picture'];
                                } else {
                                    $itempicturepath = "images/placeholder.png";
                                }
                            ?>
                            
                            <div class="product-slider">
                                <div class="product-slider-item my-4" data-image="<?php echo $itempicturepath; ?>">
                                    <img class="img-fluid w-50" src="<?php echo $itempicturepath; ?>" alt="product-img">
                                </div>
                            </div>
                            

                            <div class="content mt-5 pt-5">
                                <ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                         aria-selected="true">Product Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
                                         aria-selected="false">Specifications (<?php echo mysqli_num_rows($specifications); ?>)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
                                         aria-selected="false">Reviews (<?php echo mysqli_num_rows($reviews); ?>)</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                <!-- style="color:red !important;" -->
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <h3 class="tab-title">Product Description</h3>
                                        <p>
                                            <?php echo $item['description']; ?>
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <h3 class="tab-title">Product Specifications</h3>
                                        <table class="table table-bordered product-table">
                                            <tbody>
                                                <?php
                                                    if (mysqli_num_rows($specifications) > 0) {
                                                        while ($spec = mysqli_fetch_array($specifications)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $spec['name']; ?></td>
                                                                <td><?php echo $spec['value']; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {

                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <h3 class="tab-title">Product Review</h3>
                                        <div class="product-review">
                                            <?php
                                            if (mysqli_num_rows($reviews) > 0) {
                                                while ($review = mysqli_fetch_array($reviews)) {
                                                    $reviewer = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $review['review_from'] . "'"));
                                                   
                                            ?>
                                            <div class="media">
                                                <div class="media-body">
                                                    <!-- Ratings -->
                                                    <div class="ratings">
                                                        <ul class="list-inline d-flex">
                                                            <?php
                                                        
                                                                if ($review['rating'] < 1) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] <= 1) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 1 AND $review['rating'] <=2) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 2 AND $review['rating'] <=3) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 3 AND $review['rating'] <=4) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                                    ';
                                                                } elseif ($review['rating'] > 4 AND $review['rating'] <=5) {
                                                                    echo '
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                        <li><a href="#"><i class="fa fa-star green"></i></a></li>
                                                                    ';
                                                                }

                                                                
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="name">
                                                        <h5><?php echo $reviewer['fullname']; ?></h5>
                                                    </div>
                                                    
                                                    <div class="date">
                                                        <p><?php echo $review['created_at']; ?></p>
                                                    </div>
                                                    <div class="review-comment">
                                                        <p>
                                                            <?php echo $review['review_description']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                                if (isset($_SESSION['user_id'])) {
                                                    ?>
                                                    <div class="review-submission">
                                                        <h3 class="tab-title">Submit your review</h3>
                                                        <!-- Rate -->
                                                        <form action="" method="POST" class="row">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                                                        <div class="rate">
                                                                            <input type="radio" id="star5" name="rate" value="5" required="" />
                                                                            <label for="star5" title="text">5 stars</label>
                                                                            <input type="radio" id="star4" name="rate" value="4" required="" />
                                                                            <label for="star4" title="text">4 stars</label>
                                                                            <input type="radio" id="star3" name="rate" value="3" required="" />
                                                                            <label for="star3" title="text">3 stars</label>
                                                                            <input type="radio" id="star2" name="rate" value="2" required="" />
                                                                            <label for="star2" title="text">2 stars</label>
                                                                            <input type="radio" id="star1" name="rate" value="1" required="" />
                                                                            <label for="star1" title="text">1 star</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="review-submit w-100">
                                                                <div class="row">
                                                                    <input type="hidden" name="review_from" value="<?php echo $_SESSION['user_id']; ?>">
                                                                    <input type="hidden" name="review_to" value="<?php echo $item['user_id']; ?>">
                                                                    <div class="col-12">
                                                                        <textarea name="review_description" id="review" rows="10" class="form-control" placeholder="Message" required=""></textarea>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button type="submit" name="submitreview" class="btn btn-main">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Please login to review.
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="sidebar">
                            
                            <div class="widget user text-center">
                                <h4><a href=""><?php echo $postedBy['fullname']; ?></a></h4>
                                <p class="member-time">Member Since <?php echo date('d-M-Y',strtotime($postedBy['created_at'])); ?></p>
                                <h4>Phone No : <a href=""><?php echo $postedBy['phone']; ?></a></h4>

                                <a class="btn btn-contact d-inline-block btn-dark text-white" data-toggle="modal" data-target="#exampleModal">Request</a>

                                <a href="tel:<?php echo $postedBy['phone']; ?>" class="btn btn-contact btn-primary">Contact</a>

                            </div>

                            <div class="widget coupon text-center">
                                
                                <p>Having problem regarding lost item? Contact Us</p>
                                
                                <a href="contact.php" class="btn btn-transparent-white">Contact us</a>

                            </div>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="" method="POST">
                                        <input type="hidden" name="posted_by" value="<?php echo $item['user_id']; ?>">
                                        <input type="hidden" name="requested_by" value="<?php echo $_SESSION['user_id']; ?>">
                                        <input type="hidden" name="item_id" value="<?php echo $_GET['id']; ?>">
                                        <div class="form-group">
                                            <label for="">Request</label>
                                            <textarea name="request" cols="5" rows="5" placeholder="Write here..." class="form-control" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="sendrequest" value="Send Request" class="btn btn-dark">
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            
        </section>

<?php include("partials/footer.php"); ?>