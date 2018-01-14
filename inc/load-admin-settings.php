<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('admin_head', 'pedido_minimo_admin_css');
function pedido_minimo_admin_css() {
      echo '
        <style>
          input#wc-pedido-minimo-valor {
                max-width: 100px;
                text-align: center;
            }
        </style>';
}


class WC_Settings_Pedido_Minimo_Tab {


    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_pedido_minimo_tab', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_pedido_minimo_tab', __CLASS__ . '::update_settings' );
    }

    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_pedido_minimo_tab'] = __( 'WC Pedido Mínimo', 'wc-pedido-minimo' );
        return $settings_tabs;
    }

    public static function update_settings() {
        woocommerce_update_options( self::get_option() );
    }

    public static function settings_tab() {
        woocommerce_admin_fields( self::get_option() );
    }

	function get_option() {
            global $woocommerce;
            $simbolo_moeda = get_woocommerce_currency_symbol();
        $settings = array(
            'section_title' => array(
                'name'     => __( 'Woocommerce Pedido Mínimo', 'wc-pedido-minimo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc-pedido-minimo-section-title'
            ),
            'valor' => array(
                'name' => __( 'Valor mínimo do pedido em '.$simbolo_moeda, 'wc-pedido-minimo' ),
                'type' => 'text',
                'desc' => __( 'Pedidos com valor inferior não serão finalizados.', 'wc-pedido-minimo' ),
                'id'   => 'wc-pedido-minimo-valor',
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc-pedido-minimo'
            )
        );

	    return apply_filters( 'wc_settings_pedido_minimo_tab_settings', $settings );
	}


}
WC_Settings_Pedido_Minimo_Tab::init();
?>
