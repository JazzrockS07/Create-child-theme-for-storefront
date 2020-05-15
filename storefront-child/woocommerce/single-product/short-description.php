<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$product_id = (int)$post->ID;
$post_views = (int)get_post_meta($product_id,'views', true);

if ($_SESSION['user'] != 'old_session') {
    if( !update_post_meta($product_id,'views', ($post_views+1)) ) {
        add_post_meta($product_id, 'views', 1, true);
    }
    $_SESSION['user'] = 'old_session';
}

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
<?php
	if (get_post_meta ($product_id,'views',true)) {
		?>
			<div class="woocommerce-product-details__views">
			Количество просмотров: <?php echo (int)get_post_meta ($product_id,'views',true); ?>
			</div>
		<?php
	}
?>
<?php
	if (get_post_meta ($product_id,'sale-date',true)) {
		?>
			<div class="woocommerce-product-details__sale-date">
				Дата последней покупки: <?php echo get_post_meta ($product_id,'sale-date',true); ?>
			</div>
		<?php
	}
?>