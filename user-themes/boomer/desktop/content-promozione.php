<div id="main">
    
    <div class="content-image">
        <img alt="back-pagine" src="<?php echo theme_url(); ?>images/normal-back.jpg" />
    </div>
    
    <div class="content-post">
        <div class="promo-bar">
            <div class="title">Promozioni</div>
            <?php $this->function_model->print_promo(); ?>
        </div>
        <div class="content">
            <div class="titolo">
                <?php echo $post->post_titolo; ?>
            </div>
            <div class="promo-date">
                <strong>Dal:</strong> <?php echo $post->post_data_da; ?>
                <strong>Al:</strong> <?php echo $post->post_data_a; ?>
            </div>
            <div class="text">
                <?php echo $post->post_content; ?>
            </div>
        </div>
    </div>
    
    <div class="script-post">
        <?php echo $post->post_script; ?>
    </div>