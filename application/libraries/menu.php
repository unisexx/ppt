<?php
/**
 * Menu
 */
class Menu
{   
    static public function ls($parent_id)
    {
        $result = get_instance()->db->getarray('select * from menus where parent_id = ? order by position', array($parent_id));
        dbConvert($result);
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
}