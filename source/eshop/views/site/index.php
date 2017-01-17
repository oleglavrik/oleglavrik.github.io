<?php include(ROOT . '/views/layout/header.php'); ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">
                            <?php include(ROOT . '/views/layout/left-sidebar.php'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Последние товары</h2>
                        <?php foreach($latestProduct as $productItem) : ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="product/<?php echo $productItem['id']; ?>">
                                                <img src="<?php echo Product::getImage($productItem['id']); ?>" alt="" />
                                            </a>
                                            <h2><?php echo '$' . $productItem['price']; ?></h2>
                                            <a href="product/<?php echo $productItem['id']; ?>"><p><?php echo $productItem['name']; ?></p></a>
                                            <a href="#" data-id="<?php echo $productItem['id']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                        </div>
                                        <?php if($productItem['is_new']) : ?>
                                            <img src="/template/images/home/new.png" class="new" alt="" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div><!--features_items-->
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Рекомендуемые товары</h2>
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="cycle-slideshow"
                                         data-cycle-fx=carousel
                                         data-cycle-timeout=5000
                                         data-cycle-carousel-visible=3
                                         data-cycle-carousel-fluid=true
                                         data-cycle-slides="div.item"
                                         data-cycle-prev="#prev"
                                         data-cycle-next="#next"
                                        >
                                        <?php foreach ($sliderProducts as $sliderItem): ?>
                                            <div class="item">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="/template/<?php echo $sliderItem['image']; ?>" alt="" />
                                                            <h2>$<?php echo $sliderItem['price']; ?></h2>
                                                            <a href="/product/<?php echo $sliderItem['id']; ?>">
                                                                <?php echo $sliderItem['name']; ?>
                                                            </a>
                                                            <br/><br/>
                                                            <a href="#" class="btn btn-default add-to-cart" data-id="<?php echo $sliderItem['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                                        </div>
                                                        <?php if ($sliderItem['is_new']): ?>
                                                            <img src="/template/images/home/new.png" class="new" alt="" />
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" id="next"  href="#recommended-item-carousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!--/recommended_items-->
            </div>
        </div>
    </section>
<?php include(ROOT . '/views/layout/footer.php'); ?>