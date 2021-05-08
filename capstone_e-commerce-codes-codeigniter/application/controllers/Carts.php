<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
	/*	DOCU: This is an autoload function for every functions in this controller  
	Owner: Cesar Francisco
	*/
	public function __construct() {
        parent::__construct();
		// $this->output->enable_profiler();
		$this->load->helper('security');
    }
	/*	DOCU: This function is responsible for validation and adding the billing information of a customer to the database
	Owner: Cesar Francisco
	*/
	public function pay() {
		//billing address
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $address = $this->input->post('address');
        $address2 = $this->input->post('address2');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $zipcode = $this->input->post('zipcode');
        //billing insert to db
		$this->load->model('Cart');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
			redirect(base_url().'carts');
		} else {
        $customer_details = array('first_name' => $first_name, 'last_name' => $last_name, 'address' => $address, 'address2' => $address2, 'city' => $city, 'state' => $state, 'zipcode' => $zipcode);
		$customer_details = $this->security->xss_clean($customer_details);
        $add_customer = $this->Cart->billing_address($customer_details);
		$this->add_to_order();
		}
	}
	/*	DOCU: This function is responsible for validations, adding the shipping information of a customer, computation of total_amount/total_price, implementation of stripe API for orders made, and adding all information to orders table from the database
	Owner: Cesar Francisco
	*/
	public function add_to_order() {
		//billing/customer last id
		$last_customer_id = $this->db->insert_id();
		//shipping address
		$shipping_first_name = $this->input->post('shipping_first_name');
        $shipping_last_name = $this->input->post('shipping_last_name');
        $shipping_address = $this->input->post('shipping_address');
        $shipping_address2 = $this->input->post('shipping_address2');
        $shipping_city = $this->input->post('shipping_city');
        $shipping_state = $this->input->post('shipping_state');
        $shipping_zipcode = $this->input->post('shipping_zipcode');
		//shipping insert to db
		$this->load->model('Cart');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('shipping_first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('shipping_last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('shipping_address', 'Address', 'trim|required');
		$this->form_validation->set_rules('shipping_city', 'City', 'trim|required');
		$this->form_validation->set_rules('shipping_state', 'State', 'trim|required');
		$this->form_validation->set_rules('shipping_zipcode', 'Zipcode', 'trim|required');
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
			redirect(base_url().'carts');
		} else {
        $shipping_details = array('shipping_first_name' => $shipping_first_name, 'shipping_last_name' => $shipping_last_name, 'shipping_address' => $shipping_address, 'shipping_address2' => $shipping_address2, 'shipping_city' => $shipping_city, 'shipping_state' => $shipping_state, 'shipping_zipcode' => $shipping_zipcode);
		$shipping_details = $this->security->xss_clean($shipping_details);
        $add_shipping = $this->Cart->shipping_address($shipping_details);
		//shipping last id
		$last_shipping_id = $this->db->insert_id();
		}
		//for the total price of each product
		$get_all_products = $this->Cart->get_all_products();
		$product_id_as_index = array();
		foreach($get_all_products as $key => $value){
			$product_id_as_index[$value['id']] = $value;
		}
		//getting customer id
		$get_all_customers = $this->Cart->get_all_customers();
		$customer_id_as_index = array();
		foreach($get_all_customers as $key => $value){
			$customer_id_as_index[$value['id']] = $value;
		}
		//get the last total amount
		foreach($this->session->userdata('cart') as $id => $quantity) {
			$price = $quantity*$product_id_as_index[$id]['price'];
			$final_total_price += $price;
		}
		//stripe payment gateway
		require_once('application/libraries/stripe-php/init.php');
		$stripe = new \Stripe\StripeClient(
			'sk_test_51InQ4wHY4bgJZaAv2SsodcqirXlPrMc1jwOSQz4YFcIh8DTS8fhwt2B6FqSKV4GJU0enQn9vrCEkhmqLQBJeiBRl00yzaRUoK8'
		);
		$charged = $stripe->charges->create([
			'amount' => $final_total_price*100,
			'currency' => 'php',
			'source' => 'tok_amex',
			'description' => 'eCommerce',
		]);
		$this->session->set_flashdata('charged_id', $charged['id']);
		//insert all to db
		foreach($this->session->userdata('cart') as $id => $quantity) {
			$product_id = $id;
			$ordered_quantity = $quantity;
			$total_price = $ordered_quantity*$product_id_as_index[$id]['price'];
			$customer_id = $last_customer_id;
			$order_status_id = 1;
			$shipping_id = $last_shipping_id;
			$stripe_charged_id = $charged['id'];
			$order_details = array('product_id' => $product_id, 'customer_id' => $customer_id, 'ordered_quantity' => $ordered_quantity, 'total_price' => $total_price, 'order_status_id' => $order_status_id, 'shipping_id' => $shipping_id, 'stripe_charged_id' => $stripe_charged_id);
			$order_details = $this->security->xss_clean($order_details);
			$add_orders = $this->Cart->orders($order_details);
		}
        $this->session->set_flashdata('success_payment', 'Your payment has been successfully processed!');
		$this->session->unset_userdata('cart');
        redirect(base_url());
		$this->db->insert('orders', $order_details);
	}
	/*	DOCU: This function is responsible for validation and updating the new quantity of a product that had been ordered
	Owner: Cesar Francisco
	*/
	public function update_quantity() {
		$cart = $this->session->userdata('cart');
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$new_qty = $quantity + $this->session->userdata('quantity');
		$this->load->library("form_validation");
		$this->form_validation->set_rules("quantity", "Quantity", "required|greater_than[0]");
			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('errors', validation_errors());
			} else {
			$cart[$product_id] = $quantity;
				if(isset($cart[$product_id])){
					$cart[$product_id] = $new_qty;
				} else {
					$cart[$product_id] = $quantity;
				}
			$this->session->set_userdata('cart', $cart);
		}
		$this->session->set_flashdata('success', "<span class='success'>Your order has been updated</span>");
		redirect(base_url().'carts');
	}
}