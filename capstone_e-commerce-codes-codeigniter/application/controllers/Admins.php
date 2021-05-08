<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {
	/*	DOCU: This is an autoload function for every functions in this controller  
	Owner: Cesar Francisco
	*/
	public function __construct() {
        parent::__construct();
		// $this->output->enable_profiler();
		$this->load->helper('security');
    }
	/*	DOCU: This function is responsible for showing the login form
	Owner: Cesar Francisco
	*/
	public function login_form(){
		$this->load->view('admins/login.php');
	}
	/*	DOCU: This function is responsible to validate and sign-in an admin account that is registered from the database
	Owner: Cesar Francisco
	*/
	public function login() {
		$this->load->model("Admin");
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', "<span class='errors'>".validation_errors()."</span>");
			redirect(base_url()."admin");
		} else {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('Admin'); // or you can autoload 
			$admin = $this->Admin->get_users($email);
			if($admin && $admin['password'] == $password){
				$user = array(
				'admin_id' => $admin['id'],
				'first_name' => $admin['first_name'],
				'last_name' => $admin['last_name'],
				'admin_email' => $admin['email'],
				'admin_name' => $admin['first_name'].' '.$admin['last_name'],
				'is_logged_in' => true
				);
				$this->session->set_userdata($user);
				redirect(base_url()."dashboard/orders");
			}
        }
        $this->session->set_flashdata('errors', '<p class="errors">Invalid email or password. Please try again.</p>');
        redirect(base_url()."admin");
	}
	/*	DOCU: This function is responsible for showing the change password form
	Owner: Cesar Francisco
	*/
	public function changepassword_form() {
		$this->load->view('admins/changepassword.php');
	}
	/*	DOCU: This function is responsible to validate and change the password of the current logged in admin account
	Owner: Cesar Francisco
	*/
	public function changepassword($id) {
		$this->load->model('Admin');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
			redirect(base_url().'changepassword');
		} else {
		$password = md5($this->input->post('password'));
			$values = array('password' => $password);
			$values = $this->security->xss_clean($values);
			$result = $this->Admin->changepassword_admin($id, $values);
			$this->session->set_flashdata('success', '<p class="success">Your password has been updated.</p>');
		}
		redirect(base_url().'changepassword');
	}
	/*	DOCU: This function is responsible for logging-out the current user
	Owner: Cesar Francisco
	*/
	public function logout() {
		$this->session->sess_destroy();
        redirect(base_url().'admin');
	}
	/*	DOCU: This function is responsible for showing all the orders made by customers to the view from the database
	Owner: Cesar Francisco
	*/
	public function orders() {
        if($this->session->userdata('is_logged_in') === TRUE){
            $this->load->view('admins/orders');
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for showing all the products and categories to the view from the database
	Owner: Cesar Francisco
	*/
	public function products() {
        if($this->session->userdata('is_logged_in') === TRUE){
			$this->load->model('Admin');
			$get_products = $this->Admin->get_all_products();
			$get_categories = $this->Admin->get_all_product_categories();
			$this->load->view('admins/products', array('products' => $get_products, 'categories' => $get_categories));
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for search filtering the products
	Owner: Cesar Francisco
	*/
	public function search_products($offset=0) {
        if($this->session->userdata('is_logged_in') === TRUE){
			$this->load->model('Admin');
			//pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('admins/products');
			$config['total_rows'] = $this->Admin->count_all_products();
			$config['per_page'] = 2;
			$this->pagination->initialize($config);
			//get from db
			$product_name = $this->input->post('product_name');
			$get_categories = $this->Admin->get_all_product_categories();
			$get_product = $this->Admin->get_products($product_name, $config['per_page'], $offset);
			$this->load->view("partials/table-products.php", array('products' => $get_product, 'categories' => $get_categories));
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for validation and adding a product to the database
	Owner: Cesar Francisco
	*/
	public function add_product() {
        if($this->session->userdata('is_logged_in') === TRUE){
			$product_name = $this->input->post('product_name');
			$description = $this->input->post('description');
			$price = $this->input->post('price');
			$quantity = $this->input->post('quantity');
			$category = $this->input->post('category');
			$admin = $this->session->userdata('admin_id');
			//multiple image upload
			$data = [];
			$count = count($_FILES['images']['name']);
			for($i=0;$i<$count;$i++){
				if(!empty($_FILES['images']['name'][$i])){
				$_FILES['image']['name'] = $_FILES['images']['name'][$i];
				$_FILES['image']['type'] = $_FILES['images']['type'][$i];
				$_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
				$_FILES['image']['error'] = $_FILES['images']['error'][$i];
				$_FILES['image']['size'] = $_FILES['images']['size'][$i];
				$config['upload_path'] = './user_guide/_images/products'; 
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '50000';
				$this->load->library('upload',$config); 
					if($this->upload->do_upload('image')){
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$data[] = $filename;
						$images = json_encode($data);
					}
				}
			}
			$this->load->model('Admin');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
				redirect(base_url().'dashboard/products');
			} else {
			$product_details = array('product_name' => $product_name, 'description' => $description, 'price' => $price, 'quantity' => $quantity, 'images' => $images, 'category_id' => $category, 'admin_id' => $admin);
			$product_details = $this->security->xss_clean($product_details);
			$add_product = $this->Admin->add_products($product_details);
			$this->session->set_flashdata('success', '<p class="success">Product has been added</p>');
			redirect(base_url().'dashboard/products');
			}
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for validation and adding a category to the database
	Owner: Cesar Francisco
	*/
	public function add_category() {
        if($this->session->userdata('is_logged_in') === TRUE){
			$category = $this->input->post('category_name');
			$this->load->model('Admin');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('category_name', 'Category', 'trim|required');
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
				redirect(base_url().'dashboard/products');
			} else {
			$category_details = array('category_name' => $category);
			$category_details = $this->security->xss_clean($category_details);
			$add_category= $this->Admin->add_categories($category_details);
			$this->session->set_flashdata('success', "<span class='success'>".$category." category added!</span>");
			redirect(base_url().'dashboard/products');
			}
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for validation and editing/updating a product from the database
	Owner: Cesar Francisco
	*/
	public function update($id) {
		if($this->session->userdata('is_logged_in') === TRUE){
			$product_name = $this->input->post('product_name');
			$description = $this->input->post('description');
			$price = $this->input->post('price');
			$quantity = $this->input->post('quantity');
			$category = $this->input->post('category_id');
			$images = json_encode($this->input->post('images'));
			$this->load->model('Admin');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
			$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
				redirect(base_url().'dashboard/products');
			} else {
			$values = array('product_name' => $product_name, 'description' => $description, 'price' => $price, 'quantity' => $quantity, 'category_id' => $category, 'images' => $images);
			$values = $this->security->xss_clean($values);
			$result = $this->Admin->update_product($id, $values);
			$this->session->set_flashdata('success', '<p class="success">Product has been updated.</p>');
			redirect(base_url().'dashboard/products');
			}
		} else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for deletion of a product from the database
	Owner: Cesar Francisco
	*/
	public function delete($id) {
		if($this->session->userdata('is_logged_in') === TRUE){
			$this->load->model('Admin');
			$this->Admin->delete_product($id);
			$this->session->set_flashdata('success', '<p class="errors">Product has been removed.</p>');
			redirect(base_url().'dashboard/products');
		} else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for search filtering the orders made by customers from the database
	Owner: Cesar Francisco
	*/
	public function search_customers($offset=0) {
        if($this->session->userdata('is_logged_in') === TRUE){
			$this->load->model('Admin');
			$customer_name = $this->input->post('customer_name');
			$order_status = $this->input->post('order_status');
			//pagination
			$this->load->library('pagination');
			$config['base_url'] = site_url('admins/products');
			$config['total_rows'] = $this->Admin->count_all_products();
			$config['per_page'] = 2;
			$this->pagination->initialize($config);
			//getting from db
			$get_customer = $this->Admin->get_customers($customer_name, $order_status);
			$get_order_status = $this->Admin->get_all_order_status();
			$this->load->view("partials/table-customers.php", array('customers' => $get_customer, 'orders_status' => $get_order_status));
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for updating the status of an order from the database
	Owner: Cesar Francisco
	*/
	public function update_status($id) {
		if($this->session->userdata('is_logged_in') === TRUE){
			$this->load->model('Admin');
			$order_status = $this->input->post('order_status_id');
			$values = array('order_status_id' => $order_status);
			$values = $this->security->xss_clean($values);
			$result = $this->Admin->update_order_status($id, $values);
			$this->session->set_flashdata('success', '<p class="success">Order status has been updated.</p>');
			redirect(base_url().'dashboard/orders');
        } else {
			redirect(base_url()."admin");
        }
	}
	/*	DOCU: This function is responsible for showing all information of orders made by customer by their id from the database
	Owner: Cesar Francisco
	*/
	public function orders_show($id) {
		if($this->session->userdata('is_logged_in') === TRUE){
			$this->load->model('Admin');
			$get_orders_by_id = $this->Admin->get_orders_by_id($id);
			$get_all_orders = $this->Admin->get_all_orders($id);
			$this->load->view('/admins/show-orders.php', array('customers' => $get_orders_by_id, 'orders' => $get_all_orders));
        } else {
			redirect(base_url()."admin");
        }
	}
}