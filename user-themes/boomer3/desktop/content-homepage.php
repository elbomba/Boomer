<?php echo $message; ?>
<?= $printMessage; ?>

<div id="main">
    
    <div id="homepage-colored-line"></div>
    <!-- SlideShow -->
    <div id="slideshow-events">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
	    <img src="<?php echo theme_url(); ?>/images/slide.png" />
	    <img src="<?php echo theme_url(); ?>/images/slide.png" />
	    <img src="<?php echo theme_url(); ?>/images/slide.png" />
	    <img src="<?php echo theme_url(); ?>/images/slide.png" />
	</div>
    </div>
    
    <div id="homepage-top" class="homepage-header">
        <div class="slogan">
            <?php echo site_slogan(); ?>
        </div>
    </div>
    
    <div id="container" class="homepage-content">
        <div class="prod-line">
            <div id="first-prod" class="prod">
                <div class="title">Product</div>
                <div class="sub-title">Product Description</div>
                <img alt="desc" src="<?php echo theme_url(); ?>images/prod.png" />
                <div class="desc">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
                <a href="#">
                    <div class="button">Di Pi&ugrave &#8594;</div>
                </a>
            </div>
            <div id="second-prod" class="prod">
                <div class="title">Product</div>
                <div class="sub-title">Product Description</div>
                <img alt="desc" src="<?php echo theme_url(); ?>images/prod.png" />
                <div class="desc">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
                <a href="#">
                    <div class="button">Di Pi&ugrave &#8594;</div>
                </a>
            </div>
            <div id="third-prod" class="prod">
                <div class="title">Product</div>
                <div class="sub-title">Product Description</div>
                <img alt="desc" src="<?php echo theme_url(); ?>images/prod.png" />
                <div class="desc">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
                <a href="#">
                    <div class="button">Di Pi&ugrave &#8594;</div>
                </a>
            </div>
        </div>
        
        <div class="bottom-line">
            <div id="contact" class="element">
                <div class="title">Contattaci</div>
                <?php echo form_open(''); ?>
                    <fieldset>
                        <input type="email" name="c-email" class="email text ui-widget-content ui-corner-all" placeholder="La tua E-mail" value="<?php echo set_value('email'); ?>" />
                        <input type="text" name="c-oggetto" class="oggetto text ui-widget-content ui-corner-all" placeholder="Oggetto della mail" value="<?php echo set_value('oggetto'); ?>" />
                        <textarea name="c-content" class="content text ui-widget-content ui-corner-all"></textarea>
                        <input type="submit" class="button" />
                    </fieldset>
                </form>
            </div>
            <div id="newsletter" class="element">
                <div class="title">Subscribe Newsletter </div>
                <?php echo form_open(''); ?>
                    <fieldset>
                        <input type="email" name="n-email" class="email text ui-widget-content ui-corner-all" placeholder="La tua E-mail" value="<?php echo set_value('email'); ?>" />
                        
                        <input type="submit" class="button" style="margin-top: 0px;" />
                    </fieldset>
                </form>
            </div>
            <div id="news" class="element">
                <div class="title">News</div>
                <?php $this->function_model->print_news(5); ?>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="<?php echo theme_url(); ?>adds-on/nivo-slider/jquery.nivo.slider.js" ></script>

    <script type="text/javascript">
        $(document).ready(function() {
		$("#slider").nivoSlider({
                effect: 'fade',
                pauseTime:7000, /*7000*/
                directionNav: false,
                pauseOnHover: false
            });
        });
    </script>