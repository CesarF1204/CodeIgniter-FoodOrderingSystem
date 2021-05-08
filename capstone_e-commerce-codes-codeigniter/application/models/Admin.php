<?php
    class Admin extends CI_Model {
        /*	DOCU: This function is responsible for getting the email of a user from the admins table from the database
        Owner: Cesar Francisco
        */
        public function get_users($email) {
            $query = "SELECT * FROM admins WHERE email = ?";
            $values = array($email);
            return $this->db->query($query, $values)->row_array();
        }
        /*	DOCU: This function is responsible for getting all the product from the products table from the database
        Owner: Cesar Francisco
        */
        public function get_all_products() {
            $query = "SELECT * FROM products";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for getting all the product categories from the categories table from the database
        Owner: Cesar Francisco
        */
        public function get_all_product_categories() {
            $query = "SELECT * FROM categories";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for pagination and getting the products by orders table for the implementation of product search functionality
        Owner: Cesar Francisco
        */
        public function get_products($data, $limit, $offset) {
            $query = "SELECT *, products.id as id, sum(ordered_quantity) as quantity_sold FROM products LEFT JOIN orders ON products.id = orders.product_id WHERE product_name LIKE '%$data%' GROUP BY products.id ORDER BY products.id ASC";
            $this->db->limit($limit);
            $this->db->offset($offset);
			return $this->db->query($query)->result_array();
		}
        /*	DOCU: This function is responsible for adding a product to the products table from the database
        Owner: Cesar Francisco
        */
        public function add_products($product) {
            $query = "INSERT INTO products (product_name, description, price, quantity, images, admin_id, category_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $values= array($product['product_name'], $product['description'], $product['price'], $product['quantity'], $product['images'], $product['admin_id'], $product['category_id']);
            return $this->db->query($query, $values);
        }
        /*	DOCU: This function is responsible for adding a product category to the categories table from the database
        Owner: Cesar Francisco
        */
        public function add_categories($category) {
            $query = "INSERT INTO categories (category_name, created_at, updated_at) VALUES (?, NOW(), NOW())";
            $values= array($category['category_name']);
            return $this->db->query($query, $values);
        }
        /*	DOCU: This function is responsible for getting a product by the id from the database
        Owner: Cesar Francisco
        */
        public function get_product_by_id($product_id){
            return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id))->row_array();
        }
        /*	DOCU: This function is responsible for updating a product to the products table from the database
        Owner: Cesar Francisco
        */
        public function update_product($product_id, $product_updates){
            $where = "id = ". $product_id; 
            return $this->db->update('products', $product_updates, $where);
        }
        /*	DOCU: This function is responsible for deletion of a product to the products table from the database
        Owner: Cesar Francisco
        */
        public function delete_product($id){
            $query = "DELETE FROM products WHERE id = $id";
            return $this->db->query($query);
        }
        /*	DOCU: This function is responsible for getting the customers information from the database for search functionality 
        Owner: Cesar Francisco
        */
        public function get_customers($data, $order_status) {
            $query = "SELECT order_status_id, orders.id as ordered_id, concat(first_name,' ',last_name) as ordered_fullname, date_format(orders.created_at, '%m/%d/%Y') as ordered_date,
            concat(address, ', ', city, ', ', state, ', ', zipcode) as billing_address, sum(round(total_price,2)) as final_total_price, status_name, customer_id FROM orders
            LEFT JOIN customers_billing_address ON orders.customer_id = customers_billing_address.id
            LEFT JOIN orders_status ON orders.order_status_id = orders_status.id
            WHERE (first_name LIKE '%$data%' OR last_name LIKE '%$data%') AND order_status_id LIKE '%$order_status%'
            GROUP BY customers_billing_address.id ORDER BY customer_id DESC";
			return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for getting all the orders status from orders_status table from the database
        Owner: Cesar Francisco
        */
        public function get_all_order_status() {
            $query = "SELECT * FROM orders_status";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for updating order status of orders made by customer from the database
        Owner: Cesar Francisco
        */
        public function update_order_status($status_id, $status_updates){
            $where = "customer_id = ". $status_id; 
            return $this->db->update('orders', $status_updates, $where);
        }
        /*	DOCU: This function is responsible for getting customer and order information from the database
        Owner: Cesar Francisco
        */
        public function get_orders_by_id($customer_id){
            return $this->db->query("SELECT sum(round(total_price,2)) as total_price, customer_id, orders.id as ordered_id, concat(shipping_first_name,' ',shipping_last_name) as shipping_fullname,
            shipping_address, shipping_city, shipping_state, shipping_zipcode,
            concat(customers_billing_address.first_name,' ',customers_billing_address.last_name) as billings_fullname,
            address, city, state, zipcode, status_name
            from orders
            LEFT JOIN customers_billing_address ON orders.customer_id = customers_billing_address.id
            LEFT JOIN orders_status ON orders.order_status_id = orders_status.id
            LEFT JOIN shippings ON orders.shipping_id = shippings.id
            WHERE orders.customer_id = ?
            GROUP BY customer_id", array($customer_id))->row_array();
        }
        /*	DOCU: This function is responsible for getting the order information from the database
        Owner: Cesar Francisco
        */
        public function get_all_orders($customer_id) {
            $query = "SELECT orders.id as ordered_id, product_name, price, ordered_quantity, total_price FROM orders LEFT JOIN products ON orders.product_id = products.id WHERE orders.customer_id = '$customer_id'
            ORDER BY ordered_id ASC";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for the change password functionality of an admin account
        Owner: Cesar Francisco
        */
        public function changepassword_admin($admin_id, $changepassword){
            $where = "id = ". $admin_id; 
            return $this->db->update('admins', $changepassword, $where);
        }
        /*	DOCU: This function is responsible for counting the pages on the pagination feature
        Owner: Cesar Francisco
        */
        public function count_all_products() {
            return $this->db->get('products')->num_rows();
        }
    }
?>