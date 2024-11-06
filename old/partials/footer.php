        <footer class="footer section section-sm">
            <!-- Container Start -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- About -->
                        <div class="block about">
                            <!-- footer logo -->
                            <h1 class="text-white">Find Lost Item</h1>
                            <!-- description -->
                            <p class="alt-color">
                                <strong>Find Lost Item</strong> - #1 Global Lost & Found Platform.
                            </p>
                        </div>
                    </div>
                    <!-- Link list -->
                    <div class="col-md-6">
                        <div class="block">
                            <h4>Site Pages</h4>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <a href="search.php">Search</a>
                                </li>
                                <li>
                                    <a href="about.php">About Us</a>
                                </li>
                                <li>
                                    <a href="contact.php">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </footer>
        <!-- Footer Bottom -->
        <footer class="footer-bottom">
            <!-- Container Start -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <!-- Copyright -->
                        <div class="copyright">
                            <p>
                                Copyright © <script>
                                    var CurrentYear = new Date().getFullYear()
                                    document.write(CurrentYear)
                                </script>. All Rights Reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container End -->
            <!-- To Top -->
            <div class="top-to">
                <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
            </div>
        </footer>
        <!-- JAVASCRIPTS -->
        <script src="plugins/jQuery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/popper.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap-slider.js"></script>
        <!-- tether js -->
        <script src="plugins/tether/js/tether.min.js"></script>
        <script src="plugins/raty/jquery.raty-fa.js"></script>
        <script src="plugins/slick-carousel/slick/slick.min.js"></script>
        <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
        <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
        <!-- google map -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
        <script src="plugins/google-map/gmap.js"></script>
        <script src="js/script.js"></script>
        <script>
            function hasNumber(myString) {
              return /\d/.test(myString);
            }
            $("#fullname").on("keyup change", function(e) {

                if(hasNumber($(this).val())) {
                    $("#fullnamemsg").text('You can not use numbers here');
                } else {
                    $("#fullnamemsg").text('');
                }

            });
        </script>
    </body>
</html>