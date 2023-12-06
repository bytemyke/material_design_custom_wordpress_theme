<?php

/**
 * Template Name: Resources
 */

 //cpt single example
 
get_header();

?>
<div class='container'>
    <main class="main" role="main">
        <?php
        $args = array(
            'post_type' => 'resources',
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            ?>

            <?php
            echo '<select>';
            while ($query->have_posts()) : $query->the_post();
                echo '<option value="' . get_the_ID() . '">' . get_the_title() . '</option>';
            endwhile;
            echo '</select>';
            wp_reset_postdata();
        endif;

        ?>
    </main>
</div>

<?php get_footer(); ?>
