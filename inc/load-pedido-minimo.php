<?php
	add_action( 'woocommerce_check_cart_items', 'wc_pedido_minimo_function' );
	function wc_pedido_minimo_function() {
	    if( is_cart() || is_checkout() ) {
	        global $woocommerce;
	 
	        $total_carrinho = WC()->cart->subtotal;

			$pedido_minimo_valor = get_option( 'wc-pedido-minimo-valor', false );

	        if( $total_carrinho < $pedido_minimo_valor ) {
				$saldo = wc_price($pedido_minimo_valor - $total_carrinho);
				$mensagem = '<p>'.esc_html__( 'Você precisa comprar %s para atingir o o valor mínimo da loja.', 'wc-pedido-minimo').'</p></div>';

		if ( $total_carrinho != 0 ) {
	            wc_add_notice( sprintf( '<div class="alerta_pedido_minimo">
	            	<p>'.esc_html__('O Pedido deve ter o valor mínimo de', 'wc-pedido-minimo').' <strong>'.$simbolo_moeda.' %s</strong>.</p>'
	                .'<p>'.esc_html__('O Valor total do seu pedido agora é de', 'wc-pedido-minimo').' <strong> %s</strong>.</p>'
					.$mensagem,
	                wc_price($pedido_minimo_valor),
	                wc_price($total_carrinho),
					$saldo ),
	            'error' );
		}
	        }
	    }
	}