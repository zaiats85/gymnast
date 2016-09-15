<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package MDLWP
 */

get_header(); ?>

		
	<div id="primary" class="content-area">
		<main id="main" class="site-main mdl-grid mdlwp-900" role="main">

			<?php do_action( 'mdlwp_before_content' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

			<?php do_action( 'mdlwp_after_content' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->


	<?php
	/**
	 * Display related portfolio posts for single-porfolio.php
	 */
	if(get_theme_mod('display_related', '1')) {
		$terms = wp_get_post_terms( get_the_ID(), 'portfolio_category');
		if ( isset ( $terms[0] ) ) {
			$mdlwp_tax_query = array (
				array (
					'taxonomy' => 'portfolio_category',
					'field' 	=> 'id',
					'terms' 	=> $terms[0]->term_id,
				)
			);
		} else {
			$mdlwp_tax_query = NULL;
		}

		$related_number = get_theme_mod('related_items', '3');

		$mdlwp_query = new WP_Query(
			array(
				'post_type'			=> 'portfolio',
				'posts_per_page'	=> $related_number,
				'post__not_in'		=> array( get_the_ID() ),
				'no_found_rows'		=> true,
				'orderby'			=> 'rand',
				'tax_query'			=> $mdlwp_tax_query,
			)
		);
		if( $mdlwp_query->posts ) { ?>
		<div class="portfolio related-posts">
			<div class="mdlwp-900 heading">
				<h3><?php echo get_theme_mod( 'related_title', 'Related Projects');?></h3>
			</div>
			<div class="mdl-grid mdlwp-900">

				<?php $columns = get_theme_mod( 'related_layout', 'three-column');
			     if($columns == 'three-column') {
			     	$col = '4';
			     } elseif ($columns == 'four-column') {
			     	$col = '3';
			     } else {
			     	$col = '6';
			     }

			     ?>

					<?php
					$mdlwp_count=0;
					while( $mdlwp_query->have_posts() ) : $mdlwp_query->the_post();
					$mdlwp_count++; ?>


					<div class="mdl-cell mdl-cell--<?php echo $col; ?>-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--2dp"> 
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
							<div class="mdl-card__media">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); ?>
									</a>
								<?php endif; ?>
							</div>

							<div class="entry-content mdl-color-text--grey-600 mdl-card__supporting-text">
								<h2>
									
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>	
								</h2><!-- .entry-header -->
							</div><!-- .entry-content -->
						</article><!-- #post-## -->
					</div>

					<?php endwhile; ?>
					<?php
					// Reset postdata
					wp_reset_postdata(); ?>
				</div>
			</div>

		<?php }  
	 }  ?>
	

<?php get_footer(); ?>


