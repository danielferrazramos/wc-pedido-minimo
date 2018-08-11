<?php
/*------------------------------------------------------------------------------------------------------------------
Plugin Name: WooCommerce Pedido Mínimo
Description: Plugin para configurar valor mínimo para finalização de pedidos no WooCommerce.
Version: 1.2.1
Author: Daniel Ferraz Ramos
Author URI: http://art2web.com.br/plugin-woocommerce-pedido-minimo/
Text Domain: wc-pedido-minimo
Domain Path: /inc/languages
---------------------------------------------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Sair se for acessado diretamente.
}

function wc_pedido_minimo_text_domain_init() {
    $pedido_minimo_rel_path = basename( dirname( __FILE__ ) ) . '/languages';
    load_plugin_textdomain( 'my-pedido-minimo', false, $pedido_minimo_rel_path );
}
add_action('plugins_loaded', 'wc_pedido_minimo_text_domain_init');


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	define('PEDIDOMINIMO_PLUGIN_URL', plugins_url('', __FILE__));
	define('PEDIDOMINIMO_PLUGIN_DIR', plugin_dir_path(__FILE__));

	require_once( PEDIDOMINIMO_PLUGIN_DIR . '/inc/load-assets.php');
	require_once( PEDIDOMINIMO_PLUGIN_DIR . '/inc/load-admin-settings.php');
	require_once( PEDIDOMINIMO_PLUGIN_DIR . '/inc/load-pedido-minimo.php');
} else {
	exit;
}
?>