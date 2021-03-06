<?php echo $message; ?>
<?= $printMessage; ?>

<div class="more">
    <img alt="more" src="<?php echo base_url(); ?>adds-on/icons/more.png" />
</div>

<div class="news-menu">
    <div class="title">News</div>
    <?php $this->function_model->print_news(); ?>
</div>

<div id="main">
    <div id="top-logo" class="logo">
        <a href="<?php echo base_url(); ?>">
            <img class="logo-img" alt="logo" src="<?php echo theme_url(); ?>images/logo.png" />
        </a>
        <div class="slogan">
            <?php echo site_slogan(); ?>
        </div>
    </div>
    
    <div id="image-desc" class="image-home">
        <img class="logo-img" alt="logo" src="<?php echo theme_url(); ?>images/slide.png" />
    </div>
    
    <div class="content">
        <div class="titolo">
            <?php echo $post->post_titolo; ?>
        </div>
        <div class="text">
            <?php echo $post->post_content; ?>
        </div>
    </div>
    
    <div class="script-post">
        <?php echo $post->post_script; ?>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
            var html = $("html").height();
            var hw = window.innerHeight;
            var pw = $(".hfeed").height()+$("#colored-line-footer").height()+100; //+125 per l'header
            if(hw > pw) {
                if (html > hw) {
                    $("footer").addClass("absolute-footer");
                    $("#colored-line-footer").addClass("absolute-line-footer");
                } else {
                    $("footer").removeClass("absolute-footer");
                    $("#colored-line-footer").removeClass("absolute-line-footer");
                }
            }else{
                $("footer").removeClass("absolute-footer");
                $("#colored-line-footer").removeClass("absolute-line-footer");
            }
        });
        $(window).resize(function(){
            var html = $("html").height();
            var hw = window.innerHeight;
            var pw = $(".hfeed").height()+$("#colored-line-footer").height(); //+125 per l'header
            if(hw > pw) {
                if (html < hw) {
                    $("footer").addClass("absolute-footer");
                    $("#colored-line-footer").addClass("absolute-line-footer");
                } else {
                    $("footer").removeClass("absolute-footer");
                    $("#colored-line-footer").removeClass("absolute-line-footer");
                }
            }else{
                $("footer").removeClass("absolute-footer");
                $("#colored-line-footer").removeClass("absolute-line-footer");
            }
        });
        
        $(".more").click(function() {
            if ($("html").css("margin-left") != "0px") {
                //Rimuovo le classi
                $(".news-menu").removeClass('show-menu');
                $("html, footer").removeClass('hide-html');
                $("header").removeClass('hide-header');
                $(".more").removeClass('move-more');
                
                //Nascondo
                $(".news-menu").addClass('hide-menu');
                $("html, footer").addClass('show-html');
                $("header").addClass('show-header');
                $(".more").addClass('show-more');
            } else {
                //Rimuovo le classi
                $(".news-menu").removeClass('hide-menu');
                $("html, footer").removeClass('show-html');
                $("header").removeClass('show-header');
                $(".more").removeClass('show-more');
                
                //Mostro
                $(".news-menu").addClass('show-menu');
                $("html, footer").addClass('hide-html');
                $("header").addClass('hide-header');
                $(".more").addClass('move-more');
            }
        });
    </script>