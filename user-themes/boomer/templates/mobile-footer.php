</div> <!-- #main -->

<div id="colored-line-footer"></div>
<footer id="footer">
    <div class="footer-container">
        <div id="social" class="social">
            <a href="#"><img alt="Twitter" src="<?php echo theme_url(); ?>images/tw.png" /></a>
            <a href="#"><img alt="Facebook" src="<?php echo theme_url(); ?>images/fb.png" /></a>
            <a href="#"><img alt="LinkedIn" src="<?php echo theme_url(); ?>images/in.png" /></a>
            <a href="#"><img alt="YouTube" src="<?php echo theme_url(); ?>images/yt.png" /></a>
        </div>
        <div class="colophon">
            Copyright &#64 2013 Boomer <br>
            Powered whit Boomer.
        </div>
        
        <div class="mobile-desk">
        <?php
        if ($this->session->userdata('desktop_to_mobile')) {
            echo anchor('home/to_mobile', 'Mobile Versione');
        } else {
            echo anchor('home/to_desktop', 'Desktop Versione');
        }
        ?>
        </div>
    </div>
</footer>


</div> <!-- #page -->