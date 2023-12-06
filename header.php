<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="dns-prefetch" href="//google-analytics.com">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header" role="banner">
        <div class="container">
            <nav role="navigation">
                <div class="nav-wrapper">
                    <!-- <div class="col s12 m6 l8"> -->
                    <a href="<?php echo get_bloginfo('url'); ?>" class="header__logo brand-logo">
                        test
                        <!-- <?php echo is_front_page() ? '<h1>' : ''; ?> -->
                        <!-- <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/images/logo.svg" alt="<?php echo get_bloginfo('title'); ?>" /> -->
                        <!-- <?php echo is_front_page() ? '</h1>' : ''; ?> -->
                    </a>
                    <!-- </div> -->
                    <!-- <div class="col s12 m6 l4"> -->
                    <?php
                    //wp_nav_menu(['theme_location' => 'header','container_class' => 'menu-class'])
                    ?>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li class="page_item page-item-11"><a href="http://blog/">Blog</a></li>
                        <li class="page_item page-item-9 current_page_item"><a href="http://teacher.local/" aria-current="page">Free Teacher Worksheets</a></li>
                        <li class="page_item page-item-13"><a href="http://teacher.local/resources/">Resources</a></li>
                        <li class="page_item page-item-2"><a href="http://teacher.local/sample-page/">Sample Page</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        </div>
        <a class="material-symbols-outlined" href="#" id="theme_switcher">
                            clear_night
                        </a>
    </header>