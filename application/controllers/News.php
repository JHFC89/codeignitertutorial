<?php 
    class News extends CI_Controller {

        public function __construct(){

            parent:: __construct();
            //loading the model
            $this->load->model('news_model');
            $this->load->helper('url_helper');
        }

        //method to view all news items
        public function index(){

            //gets all news records from the model and assigns it to a variable ($news)
            $data['news'] = $this->news_model->get_news();
            $data['title'] = "News archive";

            //send all data to the views
            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer', $data);
        }

        //method to view a specific news item
        public function view($slug = NULL){

            $data['news_item'] = $this->news_model->get_news($slug);

            if(empty($data['news_item'])){

                show_404();
            }

            $data['title'] = $data['news_item']['title'];
            
            $this->load->view('templates/header', $data);
            $this->load->view('news/view', $data);
            $this->load->view('templates/footer', $data);

        }
    }

?>