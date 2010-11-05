<?php
/* Homepage Template */
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<div id="full-slider-wrapper">
    <div id="full-slider">
   
<?php
    if ($sld_homepageShow == "pages") {
        // show pages in slider
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
    }
    else {
        $lastposts = get_posts('numberposts=3');
        $postCounter = 0;
         foreach($lastposts as $post) {
            setup_postdata($post);
         ?>
            <div class="slide-panel <?php if ($postCounter==0) { echo 'active';} ?> ">
                <div class="post">
                    <h1><a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
                    <div class="post-content"><?php the_content(); ?></div>
                </div>
            </div>


         <?php $postCounter++; } 
    }
?>
    </div>
  </div>