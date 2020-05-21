<?php

add_filter( 'woocommerce_gateway_description', 'techiepress_payleo_description_fields', 20, 2 );
add_action( 'woocommerce_checkout_process', 'techiepress_payleo_description_fields_validation' );
add_action( 'woocommerce_checkout_update_order_meta', 'techiepress_checkout_update_order_meta', 10, 1 );
add_action( 'woocommerce_admin_order_data_after_billing_address', 'techiepress_order_data_after_billing_address', 10, 1 );
add_action( 'woocommerce_order_item_meta_end', 'techiepress_order_item_meta_end', 10, 3 );

function techiepress_payleo_description_fields( $description, $payment_id ) {

    if ( 'payleo' !== $payment_id ) {
        return $description;
    }
    
    ob_start();

    echo '<div style="display: block; width:300px; height:auto;">';
    echo '<img src="' . plugins_url('../assets/icon.png', __FILE__ ) . '">';
    

    woocommerce_form_field(
        'payment_number',
        array(
            'type' => 'text',
            'label' =>__( 'Payment Phone Number', 'payleo-payments-woo' ),
            'class' => array( 'form-row', 'form-row-wide' ),
            'required' => true,
        )
    );

    woocommerce_form_field(
        'paying_network',
        array(
            'type' => 'select',
            'label' => __( 'Payment Network', 'payleo-payments-woo' ),
            'class' => array( 'form-row', 'form-row-wide' ),
            'required' => true,
            'options' => array(
                'none' => __( 'Select Phone Network', 'payleo-payments-woo' ),
                'mtn_mobile' => __( 'MTN Mobile Money', 'payleo-payments-woo' ),
                'airtel_money' => __( 'Airtel Money', 'payleo-payments-woo' ),
            ),
        )
    );

    echo '</div>';

    $description .= ob_get_clean();

    return $description;
}
