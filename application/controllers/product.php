<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around management section with products (Pecivo)
*/
class Product extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('mproduct');
        $this->load->model('mmaterial');
        if (! $this->auth->isAdmin())
            redirect('/user', 'refresh');
    }

    /*
    Get all products (Pecivo)
    */
    public function index()
    {
        $data['data']['products'] = $this->mproduct->getProducts();
        $data['view'] = 'mProduct';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Add new kind of product (Pecivo) to system
    */
    public function add()
    {
        $data = array('view' => 'mProductAdd');
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
                $data['data']['materials'] = $this->mmaterial->getMaterials();
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }
        else
        {
            $data['data']['materials'] = $this->mmaterial->getMaterials();
            $this->load->view('_container', $this->statman->setActualStatus($data));
        }
    }

    /*
    Edit info about existing product (Pecivo)
    */
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
                $data['data']['product_materials'] = $this->mproduct->getProductMaterials($id);
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
    /*
    Get detail of selected product (Pecivo)
    */
    public function get($id)
    {
        $data['data']['product'] = (object)$this->mproduct->getProduct($id);
        $data['data']['product_material'] = $this->mproduct->getProductMaterials($id);
        $data['view'] = 'mProductDetail';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
}
