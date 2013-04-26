<?php
class Menus extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        /*
        $sql = "SELECT MENUS.ID, CAT.CAT_TITLE, SUB.SUB_TITLE, MENUS.TITLE, MENUS.POSITION
        FROM MENUS
        JOIN (SELECT MENUS.ID, MENUS.PARENT_ID, MENUS.TITLE AS SUB_TITLE FROM MENUS) SUB ON SUB.ID = MENUS.PARENT_ID
        JOIN (SELECT MENUS.ID, MENUS.TITLE AS CAT_TITLE FROM MENUS) CAT ON CAT.ID = SUB.PARENT_ID
        WHERE MENUS.ID > 12
        ORDER BY MENUS.PARENT_ID, MENUS.POSITION";
        $data['result'] = $this->list_menu->limit(50)->get($sql);
        $data['pagination'] = $this->list_menu->pagination();
        */
        $this->template->build('menus/index');
    }
    
    public function form($id = null)
    {
        $data['rs'] = $this->list_menu->get_row($id);
        $this->template->build('menus/form', $data);
    }
    
    public function save()
    {
        if($_POST)
        {
            $this->list_menu->save($_POST);
            set_notify('success', lang('save_data_complete'));
        }
        redirect('setting/menus');
    }
    
    public function delete($id)
    {
        if(!empty($id))
        {
            $this->list_menu->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('setting/menus');
    }
}
