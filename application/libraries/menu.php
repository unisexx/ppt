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
            $sql = "SELECT * FROM MENUS 
            WHERE MENUS.PARENT_ID = ?
            AND MENUS.ID IN ( 
                SELECT
                    (CASE PERMISSION.MODULE 
                        WHEN 'target1' THEN 1 
                        WHEN 'target2' THEN 2 
                        WHEN 'basic' THEN 3 
                        ELSE NULL END)
                FROM PERMISSION
                WHERE PERMISSION.MODULE IN ('basic', 'target1', 'target2')
                AND PERMISSION.USER_TYPE_ID = ?
                AND PERMISSION.\"VIEW\" = 1
            ) 
            AND MENUS.PUBLISH = 1
            ORDER BY MENUS.POSITION";
            $result = get_instance()->db->getarray($sql, array($parent_id, $user_type_id));
            dbConvert($result);
        }else{
            $result = get_instance()->db->getarray('select * from menus where parent_id = ? and publish = 1 order by position', array($parent_id));
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
    
    static public function source($menu_id)
    {
        $sql = 'select form_template.source 
        from form_template 
        join menus on menus.template_id = form_template.id
        where menus.id = '.$menu_id;
        $result = get_instance()->db->getone($sql);
        dbConvert($result);
        return '<h5><span class="gray">แหล่งข้อมูล: '.$result.'</span></h5>';
    }
    
    /**
     * Check permission for show button
     *
     * @access  public
     * @param   number (menu_id) or string module 
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
                'delete' => ' <input type="button" title="ลบรายการนี้" class="btn_delete vtip" onclick="if(confirm(\'ยืนยันการลบ\')){window.location=\''.site_url($url).'\';}" />'
            );
            
            // check group menu form menu_id
            $group = get_instance()->db->getone("SELECT (CASE PARENT_ID
            WHEN 1 THEN 'target1'
            WHEN 2 THEN 'target2'
            WHEN 3 THEN 'basic'
            ELSE NULL END) GROUP_NAME
            FROM MENUS WHERE ID = (SELECT PARENT_ID FROM MENUS WHERE ID = ?)", array($menu_id));

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