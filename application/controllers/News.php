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

        //form validation
        public function create(){

            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Create a news item';

            $this->form_validation->set_rules('title', 'Title', 'required'); //arguments set_rules(input field name, name for error messages, rule)
            $this->form_validation->set_rules('text', 'Text', 'required');

            //checks whether the form validation ran successfully
            if($this->form_validation->run() === FALSE){

                //failed, form is displayed again
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');
            } else{

                // success, send to model and load a view to display success message
                $this->news_model->set_news();
                $this->load->view('news/success');
            }
        }
    }

?>