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
		<div class="post">
      <h1><a href="<?php echo get_page_link($page->ID) ?>"><?php echo $page->post_title ?></a></h1>
		  <div class="post-content"><?php echo $content ?></div>
    </div><!--#end post-->
  </div>
	<?php
	 $count++;
	}	
?>
    </div>
  </div>
	