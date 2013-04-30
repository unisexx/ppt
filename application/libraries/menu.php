<?php
/**
 * Menu
 */
class Menu
{
       
    static public function ls($parent_id, $user_type_id = null)
    {
        if(is_login() and !empty($user_type_id))
        {
            $sql = "SELECT MENUS.*, FORM_TEMPLATE.NAME FROM MENUS 
            LEFT JOIN FORM_TEMPLATE ON FORM_TEMPLATE.ID = MENUS.TEMPLATE_ID 
            WHERE MENUS.PARENT_ID = ?
            AND MENUS.ID IN ( 
                SELECT SUBSTR(PERMISSION.MODULE, 6) AS ID
                FROM PERMISSION
                WHERE PERMISSION.MODULE LIKE 'menu_%'
                AND PERMISSION.MODULE <> 'menus'
                AND PERMISSION.USER_TYPE_ID = ?
                AND PERMISSION.\"VIEW\" = 1
            ) 
            AND MENUS.PUBLISH = 1
            ORDER BY MENUS.POSITION";
            $result = get_instance()->db->getarray($sql, array($parent_id, $user_type_id));
            dbConvert($result);
        }else{
            $result = get_instance()->db->getarray('select menus.*, form_template.name from menus LEFT JOIN FORM_TEMPLATE ON FORM_TEMPLATE.ID = MENUS.TEMPLATE_ID where menus.parent_id = ? and menus.publish = 1 order by menus.position', array($parent_id));
            dbConvert($result);
        }
        return $result;
    }
    
    static public function option()
    {
        $opt = array();
        foreach(self::ls(0) as $cat)
        {
            $opt[$cat['id']] = $cat['title'];
            foreach(self::ls($cat['id']) as $sub)
            {
                $opt[$sub['id']] = '--'.$sub['title'];
            }
        }
        return $opt;
    }
    
    static public function source($menu_id, $import_url = null)
    {
        $sql = 'SELECT CAT.CAT_TITLE, SUB.SUB_TITLE, MENUS.TITLE, FORM_TEMPLATE.SOURCE AS SOURCE_NAME
        FROM MENUS
        JOIN (SELECT MENUS.ID, MENUS.PARENT_ID, MENUS.TITLE AS SUB_TITLE FROM MENUS) SUB ON SUB.ID = MENUS.PARENT_ID
        JOIN (SELECT MENUS.ID, MENUS.PARENT_ID, MENUS.TITLE AS CAT_TITLE FROM MENUS) CAT ON CAT.ID = SUB.PARENT_ID
        LEFT JOIN FORM_TEMPLATE ON FORM_TEMPLATE."ID" = MENUS.TEMPLATE_ID
        WHERE MENUS.ID = '.$menu_id;
        $rs = get_instance()->db->getrow($sql);
        dbConvert($rs);
        if($menu_id == 17 and !empty($import_url))
        {
            $html = '<h2>อปท. (นำเข้าข้อมูล) '.anchor($import_url, img('media/images/btn_ex_data.png')).'</h2>';
            $html .= '<h5><span class="gray">แหล่งข้อมูล: '.$rs['source_name'].'</span></h5>';
        }
        else if(!empty($import_url)) 
        {
            $html = '<h2>'.$rs['cat_title'].' - '.$rs['sub_title'].' '.anchor($import_url, img('media/images/btn_ex_data.png')).'</h2>';
            $html .= '<h4>'.$rs['title'].'</h4>';
            $html .= '<h5><span class="gray">แหล่งข้อมูล: '.$rs['source_name'].'</span></h5>';
        }
        else 
        {
            $html = '<h2>'.$rs['cat_title'].' - '.$rs['sub_title'].'</h2>';
            $html .= '<h4>'.$rs['title'].'</h4>';
            $html .= '<h5><span class="gray">แหล่งข้อมูล: '.$rs['source_name'].'</span></h5>';
        }
        
        return $html;
    }
    
    /**
     * Check permission for show button
     *
     * @access  public
     * @param   number (menu_id) or string module name 
     * @param   string (Action)
     * @param   string (Url)
     * @return  string
     */
    static public function perm($menu_id, $action, $url = null)
    {
        if(is_login())
        {
            // button
            $btn = array(
                'add' => '<input type="button" title="เพิ่มรายการ" onclick="document.location=\''.site_url($url).'\'" class="btn_add">',
                'edit' => '<input type="button" title="แก้ไขรายการนี้" class="btn_edit vtip"  onclick="window.location=\''.site_url($url).'\'" />',
                'delete' => '<input type="button" title="ลบรายการนี้" class="btn_delete vtip" onclick="if(confirm(\'ยืนยันการลบ\')){window.location=\''.site_url($url).'\';}" />',
                'import' => '<input type="button" title="นำเข้าข้อมูล" onclick="document.location=\''.site_url($url).'\'" class="btn_import">'
            );
            
            // check group menu form menu_id
            if(is_numeric($menu_id))
            {
                $group = 'menu_'.get_instance()->db->getone("SELECT PARENT_ID
                FROM MENUS WHERE ID = (SELECT PARENT_ID FROM MENUS WHERE ID = ?)", array($menu_id));
            }
            else 
            {
                $group = $menu_id;
            }

            // check permission
            $result = get_instance()->db->getone("SELECT \"".strtoupper($action)."\" FROM PERMISSION WHERE USER_TYPE_ID = ".login_data('user_type_id')." AND MODULE = '".$group."'");
            
            // check show button or permission
            if(empty($url))
            {
                return ($result == 1) ? TRUE : FALSE;
            }
            else 
            {
                return ($result == 1) ? $btn[$action] : null;
            }
            
        }
    }

    
}