<?php include('tmp-inc/header-main.php'); ?> 
<?php use classes\Utility, classes\Product, classes\Category; ?>

<?php if (!isset($_GET['id']) || empty($_GET['id'])) Utility::redirect("index.php");  ?>
<?php     
try {
    $products = Product::findAllWhere([['cat_id', '=', $_GET['id']]], 2);
} catch (PDOException $e) {
    
}
?>
    <div class="master-wrapper">
    <!--  ==========  -->
    <!--  = Header =  -->
    <!--  ==========  -->
    <?php include('tmp-inc/header-body.php'); ?>
    <!--  ==========  -->
    <!--  = Main Menu / navbar =  -->
    <!--  ==========  -->
    <?php include('tmp-inc/navigation.php'); ?>

    <!--  ==========  -->
    <!--  = Breadcrumbs =  -->
    <!--  ==========  -->
    <div class="darker-stripe">
        <div class="container">
        	<div class="row">
        		<div class="span12">
        		    <ul class="breadcrumb">
	                    <li>
	                        <a href="index.html">وبمارکت</a>
	                    </li>
	                    <li><span class="icon-chevron-right"></span></li>
	                    <li>
	                        <a href="shop.html">فروشگاه</a>
	                    </li>
	                    <li><span class="icon-chevron-right"></span></li>
	                    <li>
	                        <a href="shop-no-sidebar.html">همه محصولات (بدون سایدبار)</a>
	                    </li>
	                </ul>
        		</div>
        	</div>
        </div>
    </div>
    <div class="container">
        <div class="push-up blocks-spacer">
            <div class="row">
                <section class="span12">
                    
                    <!--  ==========  -->
                    <!--  = Title =  -->
                    <!--  ==========  -->
                    <div class="underlined push-down-20">
                        <div class="row">
                            <div class="span6">
                                <h3><span class="light">همه</span> محصولات</h3>
                            </div>
                            <div class="span6">
                                <div class="form-inline sorting-by">
                                    <label for="isotopeSorting" class="black-clr">چینش:</label>
                                    <select id="isotopeSorting" class="span3">
                                        <option value='{"sortBy":"price", "sortAscending":"true"}'>بر اساس قیمت (کم به زیاد) &uarr;</option>
                                        <option value='{"sortBy":"price", "sortAscending":"false"}'>بر اساس قیمت (زیاد به کم) &darr;</option>
                                        
                                        <!-- 
                                        <option value='{"sortBy":"name", "sortAscending":"true"}'>بر اساس نام (صعودی) &uarr;</option>
                                        <option value='{"sortBy":"name", "sortAscending":"false"}'>بر اساس نام (نزولی) &darr;</option>
                                        -->
                                    </select>
                                    
                                    <label for="numberShown" class="black-clr">نمایش:</label>
                                    <select id="numberShown" class="span1">
                                        <option value="9">9</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div> <!-- /sorting and number shown -->
                        </div>
                    </div> <!-- /title -->
                    
                    <!--  ==========  -->
                    <!--  = Products =  -->
                    <!--  ==========  -->
                    <div class="row popup-products">
                        <div id="isotopeContainer" class="isotope-container">
                            <?php if($products): ?>
                                <?php foreach ($products as $product): ?>
                                <!--  ==========  -->
                                <!--  = Single Product =  -->
                                <!--  ==========  -->
                                <div class="span3 filter--hats" data-price="<?= $product->price; ?>" data-size="s|l">
                                    <div class="product">
                                        
                                        <div class="product-img">
                                            <div class="picture">
                                                <img width="540" height="374" alt="" src="<?= $product->getPhotoPath(); ?>" />
                                                <div class="img-overlay">
                                                    <a class="btn more btn-primary" href="product.php?id=<?= $product->id;?>">توضیحات بیشتر</a>
                                                    <a class="btn buy btn-danger" href="product.php?id=<?= $product->id;?>">اضافه به سبد خرید</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-titles no-margin">
                                            
                                            <h4 class="title"><?= $product->price; ?> تومان</h4>
                                            
                                            <h5 class="no-margin isotope--title"><?= $product->title; ?></h5>
                                        </div>
                                        
                                    </div> 
                                </div> <!-- /single product -->
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="span3" style="text-align: center;">
                                    <div class="product">
                                        
                                        <div class="" style="text-align:center; z-index: 9999;">هیچ محصولی در دسته بندی مورد نظر پیدا نشد</div>
        
                                    </div> 
                                </div>
                            <?php endif; ?>
                	       
                    
                    	</div> <!-- /isotope-container -->
                	</div> <!-- /popup-products -->
                	<hr />
        	
                	<!--  ==========  -->
					<!--  = Pagination =  -->
					<!--  ==========  -->
            	    <div class="pagination pagination-centered">
                        <ul>
                            <li><a href="#" class="btn btn-primary"><span class="icon-chevron-left"></span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#" class="btn btn-primary"><span class="icon-chevron-right"></span></a></li>
                        </ul>
                    </div> <!-- /pagination -->
                </section> <!-- /span12 -->
            </div>
        </div>
    </div> <!-- /container -->
    
    <!--  ==========  -->
    <!--  = Footer =  -->
    <!--  ==========  -->
        <?php include('tmp-inc/footer-body.php'); ?>

    </div> <!-- end of master-wrapper -->
    
    <!--  ==========  -->
    <!--  = JavaScript =  -->
    <!--  ==========  -->
    <!--  = FB =  -->
<!-- Body End -> in main-footer -->
<?php include('tmp-inc/footer-main.php'); ?>