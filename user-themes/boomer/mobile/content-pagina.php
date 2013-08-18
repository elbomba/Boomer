<?php echo $message; ?>
<?= $printMessage; ?>

<div id="main">
    
    <div class="content-image">
        <img alt="back-pagine" src="<?php echo theme_url(); ?>images/normal-back.jpg" />
    </div>
    
    <div class="position">
        <?php
            echo 'Home >> '.$percorso['0'];
        ?>
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
    </script>