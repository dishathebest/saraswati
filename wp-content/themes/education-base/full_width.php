<?php
/**
 Template Name: Full Width
 */
get_header();
global $education_base_customizer_all_values;
$education_base_hide_front_page_header = $education_base_customizer_all_values['education-base-hide-front-page-header'];

if(
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
}
?>

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