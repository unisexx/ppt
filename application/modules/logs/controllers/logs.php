<?php
class Logs extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model', 'log');
    }
    
    public function index()
    {
        $sql = "SELECT USERS.USERNAME, LOGS.*
        FROM LOGS
        JOIN USERS ON USERS.ID = LOGS.USER_ID
        ORDER BY TO_DATE(LOGS.CREATED, 'YYYY-MM-DD HH24:MI:SS') DESC";
        $data['result'] = $this->log->limit(100)->get($sql);
        $data['pagination'] = $this->log->pagination;
        $this->template->build('index', $data);
    }
}