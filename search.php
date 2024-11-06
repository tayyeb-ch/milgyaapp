<?php include("partials/header.php"); ?>

    <?php include("partials/navigation.php"); ?>
    
        <section class="page-title">
            
            <div class="container">

                <div class="row">

                    <div class="col-md-8 offset-md-2 text-center">
                        <h3>Search</h3>
                    </div>

                </div>

            </div>

        </section>
        
        <section class="popular-deals section bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="search.php" method="GET">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <input type="text" name="keyword" class="form-control my-2 my-lg-1" id="inputtext4" placeholder="What are you looking for" required="">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select name="category_id" class="w-100 form-control mt-lg-1 mt-md-2" required="">
                                                <option value="">Category</option>
                                                <?php
                                                    $cats = mysqli_query($connection, "SELECT * FROM categories");
                                                    while ($cat = mysqli_fetch_array($cats)) {
                                                        ?>
                                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="text" name="location" class="form-control my-2 my-lg-1" id="inputLocation4" placeholder="Location">
                                        </div>
                                        <div class="form-group col-md-2 align-self-center">
                                            <button type="submit" class="btn btn-primary">Search Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        if (isset($_GET['location'])) {
                            
                            $keyword = $_GET['keyword'];
                            $location = $_GET['location'];
                            $category_id = $_GET['category_id'];
                            
                            $latestitems = mysqli_query($connection, "SELECT * FROM  items WHERE category_id = '$category_id' AND title LIKE '%$keyword%' AND location  LIKE '%$location%'");

                        } else {

                            $keyword = $_GET['keyword'];
                            $category_id = $_GET['category_id'];

                            $latestitems = mysqli_query($connection, "SELECT * FROM  items WHERE category_id = '$category_id' AND title LIKE '%$keyword%'");

                        }

                            
                        

                        
                        if (mysqli_num_rows($latestitems) > 0) {
                        
                            while ($item = mysqli_fetch_array($latestitems)) {
                                ?>
                                <div class="col-sm-12 col-lg-4">
                                    <!-- product card -->
                                    <div class="product-item bg-light">
                                        <div class="card">
                                            <div class="thumb-content">
                                                <?php
                                                    if (!empty($item['picture'])) {
                                                        $itempicturepath = $item['picture'];
                                                    } else {
                                                        $itempicturepath = "images/placeholder.png";
                                                    }
                                                ?>
                                                <a href="item.php?id=<?php echo $item['id']; ?>">
                                                    <img class="card-img-top img-fluid" src="<?php echo $itempicturepath; ?>" alt="<?php echo $item['title']; ?>" style="width: 350px;height: 260px;">
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"><a href="item.php?id=<?php echo $item['id']; ?>"><?php echo $item['type'] . " : " . $item['title']; ?></a></h4>
                                                <ul class="list-inline product-meta">
                                                    <li class="list-inline-item">
                                                        <a href="item.php?id=<?php echo $item['id']; ?>">
                                                            <i class="fa fa-folder-open-o"></i>
                                                            <?php
                                                                $category = mysqli_fetch_array(mysqli_query($connection, "SELECT name FROM categories WHERE id = '" . $item['category_id'] . "'"));
                                                                echo $category['name'];
                                                            ?>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="item.php?id=<?php echo $item['id']; ?>"><i class="fa fa-calendar"></i><?php echo date('d-M-Y',strtotime($item['created_at'])); ?></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $item['views']; ?></a>
                                                    </li>
                                                </ul>
                                                <p class="card-text">
                                                    <?php
                                                        echo substr($item['description'], 0,60);
                                                    ?>...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                        } else {
                            ?>
                            <div class="col-md-12 text-center">
                                <h4>No Items Found!</h4>
                            </div>
                            <?php
                        }
                    ?>
                                    

                </div>
            </div>
        </section>
        
        <section class="call-to-action overly bg-3 section-sm">
            <!-- Container Start -->
            <div class="container">
                <div class="row justify-content-md-center text-center">
                    <div class="col-md-8">
                        <div class="content-holder">
                            <h2>
                                Facing Trouble finding lost item?
                            </h2>
                            <ul class="list-inline mt-30">
                                <li class="list-inline-item"><a class="btn btn-main" href="about.php">Read more</a></li>
                                <li class="list-inline-item"><a class="btn btn-secondary" href="contact.php">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </section>
        
<?php include("partials/footer.php"); ?>