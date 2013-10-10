<?php
class Sql extends Public_Controller
{
    private $db2;
    private $account = array();
    
    public function __construct()
    {
        if(!empty($_SESSION['sql']))
        {
            $this->account = $_SESSION['sql'];
        }
        parent::__construct();
        $this->template->set_layout('sql_layout');
        require_once(APPPATH.'libraries/adodb/adodb.inc.php');
        $this->db2 =& NewADOConnection('oci8po');

        $this->db2->Connect(
            $this->account['host'],
            $this->account['username'],
            $this->account['password'],
            $this->account['database']
        );

        $this->db2->Execute('SET character_set_results=utf8');
        $this->db2->Execute('SET collation_connection=utf8_unicode_ci');
        $this->db2->Execute('SET NAMES UTF8');
        $this->db2->SetFetchMode(ADODB_FETCH_ASSOC);
    }
    
    public function index()
    {
        if(empty($_SESSION['sql']))
        {
            if($_POST)
            {
                $this->account = array(
                    'host' => $this->input->post('host'),
                    'database' => $this->input->post('database'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                );
                $_SESSION['sql'] = $this->account;
                redirect('sql/query');
            }
            $this->template->build('index');
        }
        else 
        {
            redirect('sql/query');
        }
    }
    
    public function query()
    {
        if(empty($_SESSION['sql']))
        {
            redirect('sql/index');
        }
        else 
        {
            $this->template->build('query');
        }
    }
    
    public function sql_query()
    {
        if(empty($_SESSION['sql']))
        {
            redirect('sql/index');
        }
        else 
        {
            if($_POST)
            {
                if(preg_match('/(^select|^SELECT)/', $_POST['sql']))
                {
                    $result = $this->db2->getarray($_POST['sql']);
                    if($result)
                    {
                        dbConvert($result);
                        echo '<table class="list">';
                        echo '<tr>';
                        foreach(array_keys($result[0]) as $col) echo '<th>'.$col.'</th>';
                            echo '</tr>';
                            foreach($result as $key => $item)
                            {
                                echo '<tr '.cycle($key).'>';
                                foreach(array_keys($item) as $val) echo '<td>'.$item[$val].'</td>';   
                                echo '</tr>';
                            }
                        echo '</table>';
                    }    
                }
                else 
                {
                    $result = $this->db2->execute($_POST['sql']);
                    echo '<pre>';
                    var_export($result);
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['sql']);
        redirect('sql');
    }
}