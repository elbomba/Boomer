<div id="main">
    
    <div class="content-image">
        <img alt="back-pagine" src="<?php echo theme_url(); ?>images/normal-back.jpg" />
    </div>
    
    <div class="content-post">
        <div class="news-bar">
            <div class="title">News</div>
            <?php $this->function_model->print_news(); ?>
        </div>
        <div class="content">
            <div class="titolo">
                <?php echo $post->post_titolo; ?>
            </div>
            <div class="text">
                <?php echo $post->post_content; ?>
            </div>
        </div>
    </div>
    
    <div class="script-post">
        <?php echo $post->post_script; ?>
    </div>