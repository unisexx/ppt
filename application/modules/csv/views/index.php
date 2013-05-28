<script>
    $(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "<?php echo site_url($file); ?>",
        dataType: "text",
        success: function(data) {processData(data);}
     });
});

function processData(allText) {
    var allTextLines = allText.split(/\r\n|\n/);
    var headers = allTextLines[1].split(',');
    var lines = [];
    
    for (var h=0; h<headers.length; h++) {
        $('#data').append(headers[h]+'<br />');
    }
    
    /*
    for (var i=1; i<allTextLines.length; i++) {
        var data = allTextLines[i].split(',');
        if (data.length == headers.length) {

            var tarr = [];
            for (var j=0; j<headers.length; j++) {
                $('#data').append(headers[j]);
                tarr.push(headers[j]+":"+data[j]);
            }
            lines.push(tarr);
        }
    }
    */
     //alert(lines);
}
</script>
<div id="data"></div>