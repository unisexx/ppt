<ul id="breadcrumb">
	<li><a href="debug/fund">Database: <?php echo $_SESSION['sql']['database']; ?></a></li>	
</ul>
<div id="content">
	<form id="frm_query"  method="post">
	    <textarea name="sql" style="width: 95%; height: 200px;">select * from INSP_GROUP</textarea>
	    <br /><input type="submit" value="Submit" class="button" />
	</form>
    <div id="result_query" style="margin-top: 10px;"></div>
</div>
<?php echo anchor('sql/logout', 'Logout', 'class="btn"'); ?>
<script>
    $(function(){
        $('#frm_query').submit(function(){
            $('#result_query').html('<img src="images/ajax-loading.gif" style="vertical-align:middle;" /> กำลังโหลด...');
            $.post('<?php echo site_url().'sql/sql_query'; ?>', $('#frm_query').serialize(), function(data){
                $('#result_query').html(data);
            });
            return false; 
        });
    })
</script>