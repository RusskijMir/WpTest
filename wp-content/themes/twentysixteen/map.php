<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 *
 * Template Name: map
 */


get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <h1><?php the_title(); ?></h1>

        <?php

        $categories = get_region_categories();

        var_dump($categories);

        if(!empty($categories)) {
            //Вывод карты
            ?>
            <script src="..\wp-content\themes\twentysixteen\js\jquery-jvectormap-2.0.3.min.js"></script>
            <script src="..\wp-content\themes\twentysixteen\js\jquery-jvectormap-world-mill-en.js"></script>
            
            <div id="map" style="height: 550px"></div>
            
            <style>
                .jvectormap-container {
                    display: flex;
                    flex-direction: column;
                    height: 100%;
                }
                .jvectormap-container svg {
                    flex-grow: 1;
                }
            </style>
            <form action="" method="post" id="form">
                <input type="text" id="categoryId">
            </form>
            <script>
                $(function(){
                    var map = new $('#map').vectorMap({onRegionClick: function(event, code) {
                        var map = $('#map').vectorMap('get', 'mapObject');
                        document.getElementById('categoryId').value = code;
                        document.getElementById('form').submit();
                    }});
                });
            </script>
        <?php
        } else {
            //Сообщение об отсутствии карты
        }

        $query = new WP_Query($args);

        while ( $query->have_posts() ) {
            $query->the_post();

            get_template_part( 'template-parts/content', get_post_format() );

        }

        wp_reset_postdata();

        ?>

    </main><!-- .site-main -->

    <?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
 