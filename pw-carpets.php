<?php
/*
 * Plugin Name: Pay Weekly Carpets
 */

if ( ! defined( 'ABSPATH' ) ) 
{
	exit;
}

add_action('wp_head', function() 
{
    ?>
        <style>
            li.menu-vip {
                display: none;
            }
            body.menu-vip li.menu-vip {
                display: inline;
            }
            body.menu-vip li.menu-no-vip {
                display: none;
            }
        </style>
    <?php
    if (is_product()) 
    {
        global $product;
        $terms = wc_get_product_terms($product->get_id(), 'product_cat');
        foreach ($terms as $term)
        {
            if($term->slug == 'vip')
            {
                pwc_vip_code('vip123');
                break;
            }
        }
    }
});

add_filter( 'body_class', function( $classes ) 
{
    if (isset($_COOKIE['VIP-Code']))
    {
    	return array_merge( $classes, array( 'menu-vip' ) );
    }
    else
    {
        return $classes;
    }
} );

