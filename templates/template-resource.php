<?php

/**
 * Template Name: Resources
 */

//cpt example
get_header();

?>
<main class="main" role="main">
    <div class="section hero">
            <div class="container">
                <div class="row">
                    <div class="one-half column">
                        <h2 class="hero-heading"><?php the_title()?></h2>
                       <p class = 'section-description'><?php the_content()?></p>
                        <a class="button button-primary" href="http://getskeleton.com">Built with Skeleton</a>
                    </div>
                    <div class="one-half column">
                    </div>
                </div>
            </div>
        </div>
</main>

<?php get_footer(); ?>
