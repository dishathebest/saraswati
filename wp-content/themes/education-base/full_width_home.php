<?php
/**
 Template Name: Full Width Home
 */
get_header();
global $education_base_customizer_all_values;
$education_base_hide_front_page_header = $education_base_customizer_all_values['education-base-hide-front-page-header'];

/*if(
	( is_front_page() && 1 != $education_base_hide_front_page_header )
	|| !is_front_page()
){
	?>
	<div class="wrapper inner-main-title">
		<div class="container">
			<header class="entry-header init-animate slideInUp1">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php
				if( 1 == $education_base_customizer_all_values['education-base-show-breadcrumb'] ){
					education_base_breadcrumbs();
				}
				?>
			</header><!-- .entry-header -->
		</div>
	</div>
	<?php
}*/
        global $education_base_customizer_all_values;

        $education_base_enable_feature = $education_base_customizer_all_values['education-base-enable-feature'];
        if(1 == $education_base_enable_feature ) :
            do_action( 'education_base_action_feature_slider' );
        endif;
    

if ( ! function_exists( 'education_base_front_page' ) ) :

    function education_base_front_page() {
        global $education_base_customizer_all_values;

        $education_base_hide_front_page_content = $education_base_customizer_all_values['education-base-hide-front-page-content'];

        /*show widget in front page, now user are not force to use front page*/
        if( is_active_sidebar( 'education-base-home' ) && !is_home() ){
            dynamic_sidebar( 'education-base-home' );
        }
        if ( 'posts' == get_option( 'show_on_front' ) ) {
            //include( get_home_template() );
        }
        else {
            if( 1 != $education_base_hide_front_page_content ){
                include( get_page_template() );
            }
        }
    }
endif;
add_action( 'education_base_action_front_page', 'education_base_front_page', 20 ); ?>
<div id="content" class="site-content container-fluid clearfix">
	<!--<div id="primary" class="content-area">-->
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	<!--</div>--><!-- #primary -->
<?php 
//get_sidebar( 'left' );
//get_sidebar(); 
?>
</div><!-- #content -->
<?php get_footer();