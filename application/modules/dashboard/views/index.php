<h2>สถานการณ์ทางสังคม</h2>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/data.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<!-- Additional files for the Highslide popup effect -->
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide-full.min.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide.css" />

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

<script>
$(document).ready(function() {
    var url =  "<?php echo empty($_GET['test']) ? site_url('dashboard/chart_2') : site_url('dashboard/chart_2/?test=true'); ?>";
    $.getJSON(url,function(data) {var chart = new Highcharts.Chart(data);});
});
</script>