<?php get_header(); ?>
<main class="main" role="main">
    <div class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                //
                // Post Content here
                //
            } // end while
        } // end if
        ?>
    </div>
</main>
<?php get_footer(); ?>