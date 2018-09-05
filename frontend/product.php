<?php
if (!isset($_SESSION)){
    session_start();
}
require_once('../connection/connection.php');
$query = $db->query("SELECT *FROM products WHERE products_id=".$_GET['id']);
$product = $query->fetch(PDO::FETCH_ASSOC) ;
$query2 = $db->query("SELECT * FROM product_categories WHERE product_categories_id=".$product['product_categories_id']);
$pname = $query2->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Cake House : 帶給你最天然健康的幸福滋味
    </title>

    <meta name="keywords" content="">

    <?php require_once('template/head_files.php'); ?>



</head>

<body>
<?php require_once('template/navbar.php'); ?>

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="../index.php">首頁</a>
                        </li>
 
                        <li><?php echo $pname['category'] ; ?></li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
 <div class="panel panel-default sidebar-menu">

<div class="panel-heading">
    <h3 class="panel-title">產品分類</h3>
</div>

<div class="panel-body">
    <ul class="nav nav-pills nav-stacked category-menu">
    <?php foreach($categories as $side_categories){
        $query = $db->query("SELECT * FROM products WHERE product_categories_id=".$side_categories['product_categories_id']);
        $total_products = count($query->fetchALL(PDO::FETCH_ASSOC));
        ?>



        <li>
            <a href="product_list.php?category_id=<?php echo $side_categories['product_categories_id'];?>"><?php echo $side_categories['category']; ?> 
            <span class="badge pull-right"><?php echo $total_products;?></span></a>
            
        </li>
    <?php } ?>

    </ul>

</div>
</div>

                    
                    

                    <!-- *** MENUS AND FILTERS END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="../images/ad-banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="../uploads/products/<?php echo $product['picture'];?>"  alt="" class="img-responsive">
                            </div>



                        <?php if($product['type']==1) {?>
                            <div class="ribbon sale">
                                <div class="theribbon">SALE</div>
                                <div class="ribbon-background"></div>
                            </div>
                        <?php }else if($product['type']==2){ ?>
                            <!-- /.ribbon -->

                            <div class="ribbon new">
                                <div class="theribbon">NEW</div>
                                <div class="ribbon-background"></div>
                            </div>
                            <?php } ?>
                            <!-- /.ribbon -->

                        </div>
                        <div class="col-sm-6">

                        <form action="cart/add_cart.php" method='post'>
                            <div class="box">
                                
                                <h1 class="text-center"><?php echo $product['name'];?></h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">詳細介紹</a>
                                </p>
                                <p class="quantity"><input type="number" value='1' name='quantity' class='form-conteol'></p>
                                <p class="price">$<?php echo $product['price'];?></p>
                                <?php if(isset($_GET['Existed']) && $_GET['Existed'] != null){
                                            if($_GET['Existed'] == 'true'){ ?>
                                    <div class="alert alert-danger">
                                        <strong>此商品已存在購物車，請至「我的購物車」修改數量。</strong>
                                    </div>
                                    <?php }else{ ?>
                                     <div class="alert alert-danger">
                                        <strong>成功加入購物車!</strong>
                                    </div>   
                                    <?php  }//end $_GET['Existed'] == 'true'
                                        } ?>   

                                <p class="text-center buttons">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>加入購物車</button>
                                </p>

                                <input type="hidden" name="picture" value="<?php echo $product['picture'];?> ">
                                <input type="hidden" name="name" value="<?php echo $product['name'];?> ">
                                <input type="hidden" name="price" value="<?php echo $product['price'];?> ">
                                <input type="hidden" name="products_id" value="<?php echo $product['products_id'];?> ">

                            </div>
                        </form>
                            <div class="row" id="thumbs">

                            </div>
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h4>商品介紹</h4>
                            <p><?php echo $product['description'];?></p>


                            <blockquote>
                                <p><em>好吃好吃真好吃</em>
                                </p>
                            </blockquote>

                            <hr>
                            <div class="social">
                                <h4>Show it to your friends</h4>
                                <p>
                                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                </p>
                            </div>
                    </div>

                    

                    

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       <?php require_once('template/footer.php'); ?>





</body>

</html>