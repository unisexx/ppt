<?php
class Permission_model extends MY_Model{
	
	public $table = 'PERMISSION';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function permission_row($user_type_id)
	{
		if($user_type_id)
		{
			$perms = $this->where('user_type_id = '.$user_type_id)->get();
			if(is_array($perms))
			{
				foreach($perms as $item)
				{
					$perm[$item['module']] = array(
						'view' => $item['view'],
						'add' => $item['add'],
						'edit' => $item['edit'],
						'delete' => $item['delete'],
						'import' => $item['import'],
						'export' => $item['export']
					);
				}
				return @$perm;
			}else return NULL;	
		}
		else return NULL;
	}
}
?>