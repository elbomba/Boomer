<?php echo $message; ?>
<?= $printMessage; ?>

<div id="main">
    <div id="top-logo" class="logo">
        <div class="slogan">
            <?php echo site_slogan(); ?>
        </div>
    </div>

    <div id="container" class="homepage-content">
        <div class="circle-line">
            <a href="#">
                <div id="first-circle" class="circle">
                    <img alt="desc" src="<?php echo theme_url(); ?>images/round.png" />
                    <p class="desc">Soluzioni</p>
                </div>
            </a>
            <a href="#">
                <div id="second-circle" class="circle">
                    <img alt="desc" src="<?php echo theme_url(); ?>images/round.png" />
                    <p class="desc">Prodotti</p>
                </div>
            </a>
            <a href="#">
                <div id="third-circle" class="circle">
                    <img alt="desc" src="<?php echo theme_url(); ?>images/round.png" />
                    <p class="desc">Contatti</p>
                </div>
            </a>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function(){
            var html = $("html").height();
            var hw = window.innerHeight;
            var pw = $(".hfeed").height()+$("#colored-line-footer").height(); //+125 per l'header
            if(hw > pw) {
                if (html < hw) {
                    $("footer").addClass("absolute-footer");
                    $("#colored-line-footer").addClass("absolute-line-footer");
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
                }
            }else{
                $("footer").removeClass("absolute-footer");
                $("#colored-line-footer").removeClass("absolute-line-footer");
            }
        });
    </script>