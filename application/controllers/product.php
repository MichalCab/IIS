<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('mproduct');
        $this->load->model('mproductmaterial');
        $this->load->model('mmaterial');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user', 'refresh');
    }
    public function index()
    {
        $data['data']['products'] = $this->mproduct->getProducts();
        $data['view'] = 'mProduct';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function add()
    {
        $data = array('view' => 'cProductAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if($this->mproduct->addProduct($post_data))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali nový produkt");
                redirect('/product', 'refresh');
            }
            else
            {
                $data['data']['material'] = (object) $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }
        else
        {
            $data['productmaterial'] = $this->mproductmaterial->getProductProduct($id);
            $data['product'] = $this->mproduct->getProduct($id);
            $data['material'] = $this->mmaterial->getProduct($id);
            $this->load->view('product_edit', $data);
        }
    }
    public function edit($id)
    {
        $data = array('view' => 'mProductEdit');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if ($this->mproduct->editProduct($id, $post_data) )
            {
                $this->statman->setSuccessStatus("Úspěšně jste změnili pečivo");
                redirect('/products', 'refresh');
            }
            else
            {
                $data['data']['product'] = (object) $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }
        else
        {
            $data['data']['product_materials'] = $this->mproduct->getProductMaterials($id);
            $data['data']['product'] = $this->mproduct->getProduct($id);
            $this->load->view('_container', $this->statman->setActualStatus($data));
        }
    }
    public function set()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->mproduct->updateProduct($post_data, $id, array('vybavene')));
        }
        else
            echo json_encode(FALSE);
    }
}
