<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->data['page_title'] = $this->lang->line('Website');
	}



	public function index($offset = 0){
            
            $this->load->view('website/index', $this->data);

        }


    public function about() {

        $this->load->view('website/about', $this->data);
    }   


    public function map() {

        $this->load->view('website/map', $this->data);
    }

    public function singlepost() {

        $this->load->view('website/singlepost', $this->data);
    }


    public function news($offset = 0) {

        $config['base_url'] = base_url() . 'website/news';
        $config['total_rows'] = $this->model_post->countTotalPost();            
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';



        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';


        $config['next_link'] = '<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';


    $this->pagination->initialize($config); 

        $config['attributes'] = array('class' => 'pagination-link');

        //Init pagination
        $this->pagination->initialize($config);

        $post_data = $this->model_post->get_posts(FALSE, $config['per_page'], $offset, 1);
        $this->data['post_data'] = $post_data;

        $this->load->view('website/news', $this->data);
    }


    public function view_news($post_id)
    {      
    
        $post_data = $this->model_post->getPostData($post_id);
        $this->data['post_data'] = $post_data;
        $this->load->view('website/singlepost', $this->data); 
  
    }    

    public function contact() {

        $this->load->view('website/contact', $this->data);
    }


    public function view_post($post_id)
    {      
   
        $post_data = $this->model_post->getPostData($post_id);
        $this->data['post_data'] = $post_data;
        $this->load->view('post/view_post', $this->data);
  
    }   


    public function view_document($id)
    {
        $result = array('data' => array());

        $data = $this->model_post->getPostDocument($id);   

        foreach ($data as $key => $value) {

            $link = base_url('upload/posts/'.$value['doc_name']);
            $doc_link = '<a href="'.$link.'" target="_blank" >'.($value['doc_name']).'</a>';
                     
            $result['data'][$key] = array(
                $doc_link
            );
        } // /foreach

        echo json_encode($result);
    }


}

