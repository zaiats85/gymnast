<?php
/**
 * The template used for displaying page content in templates/page-ribbon.php
 *
 * @package MDLWP
 */

?>

<?php
    // Gets the stored background color value
    $color_value = get_post_meta( get_the_ID(), 'mdlwp-ribbon-bg-color', true );
    // Checks and returns the color value
  	$color = (!empty( $color_value ) ? 'background-color:' . $color_value . ';' : '');

  	// Gets the stored height value
    $height_value = get_post_meta( get_the_ID(), 'mdlwp-ribbon-height', true );
    // Checks and returns the height value
  	$height = (!empty( $height_value ) ? 'height:' . $height_value . ';' : '');

  	 // Gets the uploaded featured image
  	$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
  	// Checks and returns the featured image
  	$bg = (!empty( $featured_img ) ? "background-image: url('". $featured_img[0] ."');" : '');
?>

<div class="ribbon" style="<?php echo $color . $bg . $height; ?> "></div>

<div class="mdlwp-page-ribbon">
	<div class="mdl-grid mdlwp-1600">
		<div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
		<div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp ribbon-content">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header>
					<?php the_title( sprintf( '<h3>','</h3>' )); ?>
				</header><!-- .entry-header -->

				<div class="entry-content mdl-color-text--grey-600">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mdlwp' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
		</div> <!-- .mdl-cell -->
	</div>
</div>

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet contact-page-address">
		<div class="mdl-textfield mdl-js-textfield">
			<input class="mdl-textfield__input" type="text" id="sample1">
			<label class="mdl-textfield__label" for="sample1">Text...</label>
		</div>
		<div class="mdl-textfield mdl-js-textfield">
			<input class="mdl-textfield__input" type="text" id="sample1">
			<label class="mdl-textfield__label" for="sample1">Text...</label>
		</div>
		<button class="mdl-button mdl-js-button mdl-button--primary">
			asdfsadf asd
		</button>
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			Button
		</button>
		<strong>Адреса:</strong>
		<span>м. Івано-Франківськ</span><br>
		<span>вул. Лепкого 19б</span>
		<hr />

		<strong>Телефони:</strong>
		<span>+ 38 066 79 77 533</span><br>
		<span>+ 38 067 53 77 533</span>
		<hr />

		<strong>E-mail:</strong>
		<a href="mailto:info@myskipass.com.ua">info@myskipass.com.ua</a>
		<div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone mdl-cell--8-col-tablet contact-page-social-icons">
			<a href="https://vk.com/club71072873" target="_blank">
				<img src="/wp-content/themes/MDLWP-master/images/Vk.png" alt="vkontakte" />
			</a>
			<a target="_blank">
				<img src="/wp-content/themes/MDLWP-master/images/Facebook.png" alt="facebook" />
			</a>
		</div>
	</div>

	<div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet contact-page-details">

		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label contact-email">
			[email* your-email class:mdl-textfield__input id:skipass_contact_email]
			<label class="mdl-textfield__label" for="sample2">E-mail</label>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label contact-name">
			[text* your-name class:mdl-textfield__input id:skipass_contact_name]
			<label class="mdl-textfield__label" for="sample1">Ім'я та прізвище</label>
		</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label phone-number">
			[tel* tel-36 id:skipass_contact_phone class:mdl-textfield__input]
			<label class="mdl-textfield__label" for="sample3">Контактний телефон</label>
		</div>

	</div>

	<div class="mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label contact-text-message">
			[textarea your-message textarea-820 id:skipass_contact_message class:mdl-textfield__input rows:7]
			<label class="mdl-textfield__label" for="skipass_contact_message">Ваше повідомлення...</label>
		</div>
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
			Надіслати
		</button>
	</div>

</div>
