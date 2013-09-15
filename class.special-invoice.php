<?php 
/*
 * Plugin Name: Woocommerce Special Inovice
 * Author: Mahibul Hasan
 * */

class WooSpecialInvoice{
	
	function __construct(){
		//add a metabox in order details page
		add_action( 'add_meta_boxes', array(&$this, 'woocommerce_meta_boxes' ));
		
		//save the order invoice
		add_action('woocommerce_process_shop_order_meta', array(&$this, 'save_invoice_meta_boxes'), 100, 2);
		
		
		//add invoice notes with email
		add_action('woocommerce_email_before_order_table', array(&$this, 'add_invoice_notes'), 0);
		
	}
	
	
	//meta boxes
	//metabox for order page
	function woocommerce_meta_boxes(){
		add_meta_box( 'woocommerce-special-invoice-options', __( 'Invoice Notes', 'woocommerce' ), array(&$this, 'woocommerce_special_invoice_metabox'), 'shop_order', 'side', 'low' );
	}
	
	
	//meta box 
	function woocommerce_special_invoice_metabox($post){
		include $this->get_base_directory() . 'metabox/special-invoice.php';	
	}
	
	//get the base directory of this plugin including forward slash at end
	function get_base_directory(){
		return dirname(__FILE__) . '/';
	}
	
	
	//save the inovice meta boxes when the order is saved
	function save_invoice_meta_boxes($post_id, $post){
		if(isset($_POST['spcial_invoice_text'])){
			update_post_meta($post_id, '_spcial_invoice_text', $_POST['spcial_invoice_text']);
		}
	}
	
	
	//get the special invoice
	function get_special_infoice_text($post_id){
		return get_post_meta($post_id, '_spcial_invoice_text', true);
	}
	
	
	//add inovice notes with invoice email
	function add_invoice_notes($order){
		if(in_array($order->status, array('pending'))){
			$inovice_text = isset($_POST['spcial_invoice_text']) ? $_POST['spcial_invoice_text'] : '';
			if(!empty($inovice_text)){
				echo '<p>' . $inovice_text . '</p>';
			}
		}
	}
	
}

return new WooSpecialInvoice();

?>