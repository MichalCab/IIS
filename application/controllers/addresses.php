<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addresses extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('maddress');
        $this->load->model('marea');
        if (! $this->auth->isAdmin())
            redirect('/user', 'refresh');
    }
    public function index()
    {
        $data['data']['addresses'] = $this->maddress->getManagementAddresses(); #TODO use vOblastRozvozuAdresa?
        $data['data']['areas'] = $this->marea->getAreas();
        $data['view'] = 'mAddresses';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function assignarea()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $id = $post_data['id'];
            unset($post_data['id']);
            echo json_encode($this->maddress->editAddress($id, $post_data));
        }
        else
            echo json_encode(FALSE);
       
    }
}
