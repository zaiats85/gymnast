<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package MDLWP
 */

get_header(); ?>

		
	<div id="primary" class="mdl-grid content-area">
		<main id="main" class="site-main mdl-grid mdlwp-900" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'mdlwp' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<div id="fb-root"></div>

					<script>
						(function(d, s, id){
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) {return;}
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
					</script>

<!--					<script>(function(d, s, id) {-->
<!--							var js, fjs = d.getElementsByTagName(s)[0];-->
<!--							if (d.getElementById(id)) return;-->
<!--							js = d.createElement(s); js.id = id;-->
<!--							js.src = "//connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v2.8";-->
<!--							fjs.parentNode.insertBefore(js, fjs);-->
<!--						}(document, 'script', 'facebook-jssdk'));-->
<!--					</script>-->

					<div class="fb-like"
						 data-href="https://www.facebook.com/TheSybariteLife/?ref=ts&amp;fref=ts"
						 data-layout="button_count"
						 data-action="like"
						 data-size="small"
						 data-show-faces="false"
						 data-share="true">
					</div>

					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'mdlwp' ); ?></p>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
