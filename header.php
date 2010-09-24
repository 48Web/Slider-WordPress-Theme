<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> <?php the_title(); ?> &raquo; <?php bloginfo('name'); ?></title>
	
	<meta name="description" content="<?php if (have_posts()): while (have_posts()): the_post(); echo strip_tags(get_the_excerpt()); endwhile; endif; ?>" />
	
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed (<?php bloginfo('language'); ?>)" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!--Stylesheets-->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/base.css" type="text/css" media="screen" charset="utf-8" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/theme.css" type="text/css" media="screen" charset="utf-8" />
	
	<!--Mobile-->
	<?php if (ereg('iPhone', $_SERVER['HTTP_USER_AGENT']) || ereg('iPod', $_SERVER['HTTP_USER_AGENT']) || ereg('iPad',$_SERVER['HTTP_USER_AGENT'])): ?>
		
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="apple-touch-fullscreen" content="yes" />
		<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/img/apple-touch-icon.png" />
		
		<?php if (ereg('iPad', $_SERVER['HTTP_USER_AGENT'])): ?>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ipad.css" />
		<?php else: ?>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/iphone.css" />	
		<?php endif; ?>
		
	<?php else: ?>
		<meta name="viewport" content="width=960" />

		<?php // Top Up Image Gallery (.top_up) ?>
		<!--<script type="text/javascript" src="http://gettopup.com/releases/latest/top_up-min.js"></script>-->
		
	<?php endif ?>

	<?php wp_head(); ?>
	
	<!--Scripts--> 
	<!-- If we failed to load Google's CDN jQUery, load our local version -->
	<script>!window.jQuery && document.write('<script src="js/jquery-1.4.2.min.js"><\/script>')</script>
	<script type="text/javascript">
		jQuery(document).ready(function init() { 
			// jQuery init function
		});
	</script>
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery.browser.addEnvClass.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/init.js"></script>
	 
	<script type="text/javascript">
    jQuery(function() {
        function slidePanel( newPanel, direction ) {
            // define the offset of the slider obj, vis a vis the document
            var offsetLeft = $slider.offset().left;
    
            // offset required to hide the content off to the left / right
            var hideLeft = -1 * ( offsetLeft + $slider.width() );
            var hideRight = jQuery(window).width() - offsetLeft;
    
            // change the current / next positions based on the direction of the animation
            if ( direction == 'left' ) {
                currPos = hideLeft;
                nextPos = hideRight;
            }
            else {
                currPos = hideRight;
                nextPos = hideLeft;
            }
    
            // slide out the current panel, then remove the active class
            $slider.children('.slide-panel.active').animate({
                left: currPos
            }, 500, function() {
                jQuery(this).removeClass('active');
            });
    
            // slide in the next panel after adding the active class
            jQuery( $sliderPanels[newPanel] ).css('left', nextPos).addClass('active').animate({
                left: 0
            }, 500 );
        }
    
        var $slider = jQuery('#full-slider');
        var $sliderPanels = $slider.children('.slide-panel');
    
        var $navWrap = jQuery('<div id="full-slider-nav"></div>').appendTo( $slider );
        var $navLeft = jQuery('<div id="full-slider-nav-left"></div>').appendTo( $navWrap );
        var $navRight = jQuery('<div id="full-slider-nav-right"></div>').appendTo( $navWrap );
    
        var currPanel = 0;
    
        $navLeft.click(function() {
            currPanel--;
    
            // check if the new panel value is too small
            if ( currPanel < 0 ) currPanel = $sliderPanels.length - 1;
    
            slidePanel(currPanel, 'right');
        });
    
        $navRight.click(function() {
            currPanel++;
    
            // check if the new panel value is too big
            if ( currPanel >= $sliderPanels.length ) currPanel = 0;
    
            slidePanel(currPanel, 'left');
        });
    });
  </script>
</head>
<body <?php body_class(); ?>>
	<div class="container">
		<div id="header">
			<div id="nav">
				<ul>
					<li> <a href="/">Home</a> </li>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</div>
		</div><!--#end header-->
		