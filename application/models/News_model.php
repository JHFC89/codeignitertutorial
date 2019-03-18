<?php 
    class News_model extends CI_Model {

        public function __construct(){

            //make the database class available through the $this->db object
            $this->load->database();
        }

        // method to get all posts from database
        public function get_news($slug = FALSE){

            //get all new records
            if($slug === FALSE){
                $query = $this->db->get('news');
                return $query->result_array();
            }

            //get post by it´s slug
            $query = $this->db->get_where('news', array('slug' => $slug));
            return $query->row_array();
        }

        //method to write the data to the database
        public function set_news(){

            $this->load->helper('url');

            $slug = url_title($this->input->post('title'),'dash', TRUE);

            $data = array(
                'title' => $this->input->post('title'), //post() method sanitize data for security
                'slug' => $slug,
                'text' => $this->input->post('text')
            );

            return $this->db->insert('news', $data);
        }
    }
?>