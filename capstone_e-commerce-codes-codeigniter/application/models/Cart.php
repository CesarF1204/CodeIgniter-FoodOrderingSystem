<?php
    class Cart extends CI_Model {
        /*	DOCU: This function is responsible for adding the customers billing information from the database
        Owner: Cesar Francisco
        */
        public function billing_address($customer) {
            $query = "INSERT INTO customers_billing_address (first_name, last_name, address, address2, city, state, zipcode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $values = array($customer['first_name'], $customer['last_name'], $customer['address'], $customer['address2'], $customer['city'], $customer['state'], $customer['zipcode']);
            return $this->db->query($query, $values);
        }
        /*	DOCU: This function is responsible for adding the customers shipping information from the database
        Owner: Cesar Francisco
        */
        public function shipping_address($shipping) {
            $query = "INSERT INTO shippings (shipping_first_name, shipping_last_name, shipping_address, shipping_address2, shipping_city, shipping_state, shipping_zipcode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $values = array($shipping['shipping_first_name'], $shipping['shipping_last_name'], $shipping['shipping_address'], $shipping['shipping_address2'], $shipping['shipping_city'], $shipping['shipping_state'], $shipping['shipping_zipcode']);
            return $this->db->query($query, $values);
        }
        /*	DOCU: This function is responsible for getting the customers billing information from the database
        Owner: Cesar Francisco
        */
        public function get_all_customers() {
            $query = "SELECT * FROM customers_billing_address";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for getting all the products information from the database
        Owner: Cesar Francisco
        */
        public function get_all_products() {
            $query = "SELECT * FROM products";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for adding an order made by customer to the orders table from the database
        Owner: Cesar Francisco
        */
        public function orders($order) {
            $query = "INSERT INTO orders (product_id, customer_id, ordered_quantity, total_price, order_status_id, shipping_id, stripe_charged_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $values = array($order['product_id'], $order['customer_id'], $order['ordered_quantity'], $order['total_price'], $order['order_status_id'], $order['shipping_id'], $order['stripe_charged_id']);
            return $this->db->query($query, $values);
        }
    }
?>