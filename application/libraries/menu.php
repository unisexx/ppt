<?php
/**
 * Menu
 */
class Menu
{   
    static public function ls($parent_id)
    {
        $result = get_instance()->db->getarray('select * from menus where parent_id = ?', array($parent_id));
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
}