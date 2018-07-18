<?php
/**
 * Template Name: Film list
 *
 * Show a list of all films
 *
 * @package unite
 */

get_header(); ?>

    <div id="primary" class="content-area col-sm-12 col-md-8">
        <main id="main" class="site-main" role="main">

            <?php
                query_posts( array( 'post_type' => array('films')));
                if ( have_posts() ) :

                    while ( have_posts() ) : the_post();

                        get_template_part( 'content', get_post_format() );

                    endwhile;

                    unite_paging_nav();

                else :

                    get_template_part( 'content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>