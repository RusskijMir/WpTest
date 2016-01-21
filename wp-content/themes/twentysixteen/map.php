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

        if(!empty($categories)) {
            //Вывод карты
            ?>
            <script src="../wp-content/themes/twentysixteen/js/jquery-jvectormap-2.0.3.min.js"></script>
            <script src="../wp-content/themes/twentysixteen/js/jquery-jvectormap-world-mill-en.js"></script>
            
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
                <input type="text" id="categoryId" name="categoryId">
            </form>
            <script>
                $(function(){
                    var map = new $('#map').vectorMap();
                    $('path').click(function(event) {
                        var catID = $(this).attr('data-code');
//                        document.getElementById('form').submit();

                        var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); //must echo it ?>';
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {"action": "load-filter", cat: catID },
                            success: function(response) {
                                jQuery("#category-post-content").html(response);
                                return false;
                            }
                        });
                    })
                });
            </script>
            <div id="category-post-content">

            </div>
        <?php
        } else {
            //Сообщение об отсутствии карты
        }

        ?>

    </main><!-- .site-main -->

    <?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
 