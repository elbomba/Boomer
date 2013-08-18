<div id="main">
    
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
    </script>