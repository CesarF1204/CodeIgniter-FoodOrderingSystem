<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	/*	DOCU: This is an autoload function for every functions  
	Owner: Cesar Francisco
	*/
	public function __construct() {
        parent::__construct();
		// $this->output->enable_profiler();
		$this->load->helper('security');
    }
	/*	DOCU: This function is responsible for showing the main page, products, categories, and handling the payment successful and get receipt feature after it has been paid by a customer
	Owner: Cesar Francisco
	*/
	public function index() {
		$cart = $this->session->userdata('cart');
		if(!empty($cart)){
			$total_order = count($cart);
		}else{
			$total_order = 0;
		}
		$this->session->set_userdata('total_order', $total_order);
		$this->load->model('Product');
		$get_all_products = $this->Product->get_all_products();
		$get_categories = $this->Product->get_all_product_categories();
		//payment successful, get receipt
		require_once('application/libraries/stripe-php/init.php');
		$stripe = new \Stripe\StripeClient(
			'sk_test_51InQ4wHY4bgJZaAv2SsodcqirXlPrMc1jwOSQz4YFcIh8DTS8fhwt2B6FqSKV4GJU0enQn9vrCEkhmqLQBJeiBRl00yzaRUoK8'
		);
		$charged_id = $this->session->flashdata('charged_id');
		if(isset($charged_id)) {
			$payment_confirmation = $stripe->charges->retrieve($charged_id, []);
			$this->load->view('products/index.php', array('products' => $get_all_products, 'categories' => $get_categories, 'charged_details' => $payment_confirmation));
		}else {
			$this->load->view('products/index.php', array('products' => $get_all_products, 'categories' => $get_categories));
		}	
	}
	/*	DOCU: This function is responsible for search filtering the products on the main page
	Owner: Cesar Francisco
	*/
	public function search_products() {
		$this->load->model('Product');
		$product_name = $this->input->post('product_name');
		$category_name = $this->input->post('category_name');
		$get_product = $this->Product->get_products($product_name, $category_name);
		$this->load->view("partials/default-search-products.php", array('products' => $get_product));
	}
	/*	DOCU: This function is responsible for showing the selected product for buying/ordering
	Owner: Cesar Francisco
	*/
	public function show($id) {
		$this->load->model('Product');
		$get_product = $this->Product->get_product_by_id($id);
		$this->load->view("products/show.php", array('product'=> $get_product));
	}
	/*	DOCU: This function is responsible for validation and adding a quantity of the selected product to the cart
	Owner: Cesar Francisco
	*/
	public function add_to_cart() {
		$cart = $this->session->userdata('cart');
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$new_qty = $quantity + $this->session->userdata('quantity');
		$this->load->library("form_validation");
		$this->form_validation->set_rules("quantity", "Quantity", "trim|required|greater_than[0]");
			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('errors', "<span class='errors'>".validation_errors()."</span>");
				redirect(base_url().'products/show/'.$product_id);
			} else {
			$cart[$product_id] = $quantity;
				if(isset($cart[$product_id])){
					$cart[$product_id] = $new_qty;
				} else {
					$cart[$product_id] = $quantity;
				}
			$this->session->set_flashdata('success', "<span class='success'>Item added to cart!</span>");
			$this->session->set_userdata('cart', $cart);
		}
		$data = $this->security->xss_clean($data);
		redirect(base_url());
	}
	/*	DOCU: This function is responsible for showing the orders and updating the number of items on the cart page
	Owner: Cesar Francisco
	*/
	public function cart() {
		$cart = $this->session->userdata('cart');
		if(!empty($cart)){
			$total_order = count($cart);
		}else{
			$total_order = 0;
		}
		$this->session->set_userdata('total_order', $total_order);
		$this->load->model('Product');
		$get_all_products = $this->Product->get_all_products();
		$product_id_as_index = array();
		$cart = $this->session->userdata('cart');
		$product = $this->session->userdata('product');
		if(empty($cart)){
			redirect(base_url());
		}
		foreach($get_all_products as $key => $value){
			$product_id_as_index[$value['id']] = $value;
		}
		$this->load->view('products/cart.php', array('ordered_items' => $product_id_as_index));
	}
	/*	DOCU: This function is responsible for the deletion of a selected order in the cart page
	Owner: Cesar Francisco
	*/
	public function delete_item_in_cart(){
		$product_id = $this->input->post('product_id');
		if(isset($product_id)){
			$cart = $this->session->userdata('cart');
			unset($cart[$product_id]);
			$this->session->set_userdata('cart', $cart);
		}
		$this->session->set_flashdata('success', "<span class='errors'>Your order has been deleted</span>");
		redirect(base_url().'carts');
	}
}