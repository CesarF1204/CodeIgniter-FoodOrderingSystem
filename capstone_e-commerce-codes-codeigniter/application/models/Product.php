<?php
    class Product extends CI_Model {
        /*	DOCU: This function is responsible for getting all the products information from the database
        Owner: Cesar Francisco
        */
        public function get_all_products() {
            $query = "SELECT * FROM products";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for getting the products and categories from the database for search functionality
        Owner: Cesar Francisco
        */
        public function get_products($data, $category_name) {
            $query = "SELECT *, products.id as product_id FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE (products.product_name LIKE '%$data%') AND category_name LIKE '%$category_name%' ORDER BY products.id ASC";
			return $this->db->query($query)->result_array();
		}
        /*	DOCU: This function is responsible for getting all the products by categories from the database for filtering functionality
        Owner: Cesar Francisco
        */
        public function get_all_product_categories() {
            $query = "SELECT category_name, count(*) as category_quantity FROM products LEFT JOIN categories ON products.category_id = categories.id GROUP BY category_name ORDER BY categories.id";
            return $this->db->query($query)->result_array();
        }
        /*	DOCU: This function is responsible for getting the products by id from the database for buying/ordering functionality
        Owner: Cesar Francisco
        */
        public function get_product_by_id($product_id){
            return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id))->row_array();
        }

    }
?>