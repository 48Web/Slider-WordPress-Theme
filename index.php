<?php /* Template Name: Index*/ ?>

<?php get_header(); ?>

<div id="full-slider-wrapper">
    <div id="full-slider">
   
<?php
	$mypages = get_pages('sort_column=post_date&sort_order=desc');
	$count = 0;
	foreach($mypages as $page)
	{		
		$content = $page->post_content;
		if(!$content)
			continue;
		
			
		$content = apply_filters('the_content', $content);
?>
	<div class="slide-panel <?php if ($count == 0) { echo 'active'; } ?>">
		<h2><a href="<?php echo get_page_link($page->ID) ?>"><?php echo $page->post_title ?></a></h2>
		<div class="entry"><?php echo $content ?></div>
  </div>
	<?php
	$count++;
	}	
?>
    </div>
  </div>
	
