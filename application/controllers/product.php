<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('mproduct');
        $this->load->model('mproductmaterial');
        $this->load->model('mmateriall');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }
    public function index()
    {
        $data['products'] = $this->maddress->getAddresses();
        $this->load->view('products', $data);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->mproduct->addProduct($post_data));
        }
        else
        {
            $data['productmaterial'] = $this->mproductmaterial->getProductMaterial($id);
            $data['product'] = $this->mproduct->getProduct($id);
            $data['material'] = $this->mmaterial->getMaterial($id);
            $this->load->view('product_edit', $data);
        }
    }
    public function edit($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $post_data["id"] = $id;
            echo json_encode($this->maddress->editProduct($post_data));
        }
        else
        {
            $data['productmaterial'] = $this->mproduct->getProductMaterial($id);
            $data['product'] = $this->mproduct->getProduct($id);
            $this->load->view('product_edit', $data);
        }
    }
    public function set()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->morder->updateProduct($post_data, $id, array('vybavene')));
        }
        else
            echo json_encode(FALSE);
    }
}
