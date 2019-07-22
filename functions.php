<?php
defined('ABSPATH') || die('do not access this file directly');

function theme_enqueue_styles() {
	$theme = wp_get_theme();
	$theme_version = $theme->get('Version');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('avada-stylesheet'), $theme_version);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );



add_action('wp_head', 'wp_head_custom',50);
add_action('login_head', 'wp_head_custom');
function wp_head_custom() { ?>
<!-- for jquery dialog -->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<?php
	$warning_text = isset($_GET['the_msg']) ? $_GET['the_msg'] : null;
	$warning_bg_color = isset($_GET['is_error']) && $_GET['is_error']==1 ? '#cf0c4e' : '#57df7b';
	$warn_extra_css_class='';
	if($warning_text) { ?>
	<style>
		.elifelibero-warn-wrapper {
			color:#ffffff;background-color:<?=$warning_bg_color?>;padding:10px;font-size:120%;
		}
		.elifelibero-warn-wrapper a.close-button {
			cursor:pointer;float: right;font-weight: bold;
		}
	</style>
	<script type="text/javascript">
		jQuery(function ($) {
//				var elifelibero_do_not_show_warning = elifelibero_getCookie('elifelibero_do_not_show_warning');
//				if (!elifelibero_do_not_show_warning) {
				$('#wrapper #sliders-container').before('<div class="elifelibero-warn-wrapper<?=$warn_extra_css_class?>" style="display:none;"><i class="icon-flag"></i><div class="notification-content"><?=$warning_text?> <a class="close-button" title="Dismiss">×</a></div><div class="clear"></div></div>');
				$('.elifelibero-warn-wrapper').slideDown(1000);
//				}
			$('.elifelibero-warn-wrapper .notification-content .close-button').click(function () {
				$('.elifelibero-warn-wrapper').slideUp(800);
//				elifelibero_setCookie('elifelibero_do_not_show_warning',1,1);
			});
		});
	</script><?php
	}
}


add_action('after_setup_theme', function() {
	$dirname = dirname(__FILE__);
	require_once $dirname.'/custom_classes/cf7_hooks.php';
	cf7_hooks::get_instance();
});