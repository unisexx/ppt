<?php
Class Home extends  Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->build('index');
	}
    
    public function download()
    {
        if(!empty($_GET['url']))
        {
            $this->load->helper('download');
            $data = file_get_contents($_GET['url']);
            $name = basename($_GET['url']).'.'.pathinfo($_GET['url'], PATHINFO_EXTENSION);
            force_download('sample.csv', $data); 
        }
    }
}