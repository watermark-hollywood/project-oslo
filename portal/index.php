<?php
    require_once ('includes/managesessions.php'); 
    require_once ('includes/swdb_connect.php'); 
    require_once ('includes/utilityfunctions.php'); 

    ValidateDomain($_SERVER['HTTP_HOST']);
?>

<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>Welcome to Project Oslo</title>

    <!-- domo arigato mr roboto.. load this font -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- BEGIN Load Styles for Plugins -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" >


    <!-- page styles -->
    <link rel="stylesheet" href="assets/css/home.css" />
    <?php if(isset($_SESSION['domain'])) { ?>
        <link rel="stylesheet" href="domains/<?=$_SESSION['domain']?>/css/portal.css" /> 
    <?php } else { ?>
        <link rel="stylesheet" href="domains/<?php echo(ExtractSubdomains($_SERVER['HTTP_HOST'])); ?>/css/portal.css" /> 
    <?php } ?>

</head>

<body>
	<?php include('includes/topbar.php'); ?>
	
    <div class="container py-3 mb-5" id="body-container">
        <?php 
            $aCarouselItems = getCarouselItems(ExtractSubdomains($_SERVER['HTTP_HOST']));
            if(count($aCarouselItems) > 0) { ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <div id="promotedCarousel" class="carousel slide" data-ride="carousel">                
                            <ol class="carousel-indicators">
                                <?php for($i=0; $i<count($aCarouselItems); $i++) { ?>
                                    <li data-target="#promotedCarousel" data-slide-to="<?= $i ?>" <?php if($i == 0){ ?> class="active"> <?php } ?></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                            <?php for($i=0; $i<count($aCarouselItems); $i++) { ?>
                                <?php if($i ==0) { ?>
                                <div class="carousel-item active">
                                <?php } else { ?>
                                <div class="carousel-item">
                                <?php } ?>
                                    <a href="<?= $aCarouselItems[$i]['link'] ?>"><img class="d-block img-fluid" src="domains/<?php echo(ExtractSubdomains($_SERVER['HTTP_HOST'])); ?>/images/carousel/<?= $aCarouselItems[$i]['file_name'] ?>" border="0" alt="<?= $aCarouselItems[$i]['slide_title'] ?>"></a>
                                }
                                </div>
                                <? } ?>
                            </div>
                            <a class="carousel-control-prev" href="#promotedCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#promotedCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <div id="promotedCarousel" class="carousel slide" data-ride="carousel">                
                            <ol class="carousel-indicators">
                                <li data-target="#promotedCarousel" data-slide-to="1" class="active"></li>
                                <li data-target="#promotedCarousel" data-slide-to="2"></li>
                                <li data-target="#promotedCarousel" data-slide-to="0"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <a href="/login.php"><img class="d-block img-fluid" src="/assets/images/default_slide1.jpg" border="0" alt="Create Products"></a>
                                </div>
                                <div class="carousel-item">
                                    <a href="/login.php"><img class="d-block img-fluid" src="/assets/images/default_slide2.jpg" border="0" alt="Invite Users"></a>
                                </div>
                                <div class="carousel-item">
                                    <a href="/login.php"><img class="d-block img-fluid" src="/assets/images/default_slide3.jpg" border="0" alt="Create Featured Items"></a>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#promotedCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#promotedCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php 
            $aFeatured = getFeatured(ExtractSubdomains($_SERVER['HTTP_HOST']));
            if(count($aFeatured) > 0) { ?>
        <div class="row mt-5">
            <div class="col-12"><h3>Featured</h3></div>
            <?php foreach($aFeatured as $product) { ?>
        
                <div class="col-md-3 col-sm-6 col-xs-12 mb-3">
                    <div class="card featured-card">
                        <div class="card-block">
                            <a href="/product.php?id=<?= $product['id'] ?>"><img class="featured-image img-fluid" border="0" src="domains/<?php echo(ExtractSubdomains($_SERVER['HTTP_HOST'])); ?>/images/products/<?= $product['file_name'] ?>" alt="<?= $product['name'] ?>"></a>
                            <h4 class="featured-product-name mt-2"><a href="/product.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a></h4>
                            <p><?= $product['description'] ?></p>
                            <p class="my-2 text-muted">$<?= $product['price'] ?> for <?= $product['per_unit'] ?></p>
                            <p class="small-text">Category: <a class="my-2" href="/category.php?id=<?= $product['category_id'] ?>"><?= $product['category_name'] ?></a></p>
                        </div>
                        <div class="card-footer featured-footer text-muted">
                            <div class="btn-group featured-footer-group text-muted" role="group">
                                <button type="button" class="btn btn-secondary feature-footer-cart-btn" onclick=""><i class="fa fa-shopping-cart"></i> <span class="hidden-md-down">Add to Cart</span></button>
                                <button type="button" class="btn btn-secondary " data-toggle="tooltip" title="" onclick="" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                                <button type="button" class="btn btn-secondary " data-toggle="tooltip" title="" onclick="" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    </div>

    <?php include('includes/footer.php'); ?>
    <!-- common functions -->
    <script src="assets/js/common.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // run test on initial page load
            resizeFeatured();

            // run test on resize of the window
            $(window).resize(resizeFeatured);
        });


        // Make all of the featured equal height
        function resizeFeatured() {
            var tallest = 0;
            $(".featured-card").each(function(i,e){
                var var_e = jQuery(e);
                tallest = (var_e.height() > tallest) ? var_e.height() : tallest;

            });
            $(".featured-card").height(tallest);
        }

    </script>
</body>
</html>