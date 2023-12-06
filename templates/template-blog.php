<?php

/**
 * Template Name: Blog
 */
get_header();
?>
<main class="main" role="main">
  <div class="container">
    <div class="row">
      <?php
      $myposts = get_posts();
      foreach ($myposts as $post) :
        setup_postdata($post);
      ?>
        <div class="col s12 m6 l4">
          <div class="card">
            <div class='cardOverlayContainer'>
              <div class='card-overlay'>
              <div class="card-content">
                <span class="card-title">
                  <?php echo get_the_title(); ?>
                </span>
                <p>
                  <?php echo get_the_excerpt(); 
                  ?>
                </p>
              </div>
              </div>
              <div class="card-image">
                <img alt="<?php echo get_post_meta(get_the_ID(), '_wp_attachment_image_alt', TRUE); ?>" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
              </div>
              <div class="card-content">
                <span class="card-title static">
                  <?php echo get_the_title(); ?>
                </span>
              </div>
            </div>
            <div class="card-action">
              <!-- min-height: 600px; -->
              <div class='tags'>
                <?php $tags = get_tags();
                foreach ($tags as $tag) {
                ?>
                  <button class='tag btn-small waves-effect waves-light'>
                    <?php echo $tag->name; ?>
                  </button>
                <?php
                }
                ?>
              </div>
              <!-- <a href="#">This is a link <span class="material-symbols-outlined">
                  arrow_right_alt
                </span></a> -->
            </div>
          </div>
        </div>

      <?php endforeach;
      wp_reset_postdata();
      ?>
    </div>

  </div>

</main>

<?php get_footer(); ?>