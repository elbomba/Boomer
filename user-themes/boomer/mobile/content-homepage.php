<?php echo $message; ?>
<?= $printMessage; ?>

<div id="main">
    <div id="homepage-top" class="homepage-header">
        <img alt="main back image" src="<?php echo theme_url(); ?>images/back.png" />
        
        <div class="slogan">
            <?php echo site_slogan(); ?>
        </div>
    </div>

    <div id="container" class="homepage-content">
        <div id="first-product" class="element">
            <img alt="desc" class="left" src="<?php echo theme_url(); ?>images/product.png" />
            <div class="description">
                <p class="title">Lorem Ipsum is simply</p>
                <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            </div>
        </div>
        <div id="second-product" class="element">
            <div class="description">
                <p class="title">Lorem Ipsum is simply</p>
                <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            </div>
            <img alt="desc" class="right" src="<?php echo theme_url(); ?>images/product.png" />
        </div>
        <div id="third-product" class="element">
            <img alt="desc" class="left" src="<?php echo theme_url(); ?>images/product.png" />
            <div class="description">
                <p class="title">Lorem Ipsum is simply</p>
                <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            </div>
        </div>
    </div>