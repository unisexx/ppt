<!doctype html>
<html lang="en">
<head>
    <base href="<?php echo site_url(); ?>" target=""/>
	<meta charset="UTF-8" />
	<title>CSV</title>
	<style type="text/css" media="screen">
		#data {
		    margin: 0 auto; 
		    width: 800px;
		    height: 1000px;
		    border: 1px solid #000;
		    overflow: auto;
		}
	</style>
	<script src="media/js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		$(function(){
		    var line;
            
		});
		function read_csv(line)
            {
                $.get('dla/read_csv/'+line, function(data){
                    $('#data').prepend(data);
                    if(data != "empty")
                    {
                        line++;
                        read_csv(line);
                    }
                });
            }
	</script>
</head>
<body style="text-align: center;">
	<div id="data"></div>
	<button type="button" onclick="read_csv(1)" style="margin: 0 auto;">Import</button>
</body>
</html>