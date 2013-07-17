<link rel="stylesheet" type="text/css" href="css/template.css"/>
<script type="text/javascript" src="js/SWFSupport.js"></script>

<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>

<script type="text/javascript" src="js/cufon/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon/supermarket_400.font.js"></script>
<script type="text/javascript">
	Cufon.replace('h1, h3, h4, h5, .report p, #tabs li a');

</script>

<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcmegamenu.1.3.3.js'></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-menu-1').dcMegaMenu({
		rowItems: '3',
		speed: 0,
		effect: 'slide',
		event: 'click',
		fullWidth: true
	});
	$('#mega-menu-2').dcMegaMenu({
		rowItems: '1',
		speed: 'fast',
		effect: 'fade',
		event: 'click'
	});
	$('#mega-menu-3').dcMegaMenu({
		rowItems: '2',
		speed: 'fast',
		effect: 'fade'
	});
	$('#mega-menu-4').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
	$('#mega-menu-5').dcMegaMenu({
		rowItems: '4',
		speed: 'fast',
		effect: 'fade'
	});
	$('#mega-menu-6').dcMegaMenu({
		rowItems: '3',
		speed: 'slow',
		effect: 'slide',
		event: 'click',
		fullWidth: true
	});
	$('#mega-menu-7').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide'
	});
	$('#mega-menu-8').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade'
	});
});
</script>
<link href="css/skins/red.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/vtip.js"></script>
<link rel="stylesheet" type="text/css" href="css/vtip.css" />

<link rel="stylesheet" href="css/jquery.treeview.css" />
<link rel="stylesheet" href="css/red-treeview.css" />
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
		$(function() {
			$("#browser").treeview();
		});
</script>

<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	$("#tabs li").click(function() {
		//	First remove class "active" from currently active tab
		$("#tabs li").removeClass('active');

		//	Now add class "active" to the selected/clicked tab
		$(this).addClass("active");

		//	Hide all tab content
		$(".tab_content").hide();

		//	Here we get the href value of the selected tab
		var selected_tab = $(this).find("a").attr("href");

		//	Show the selected tab content
		$(selected_tab).fadeIn();

		//	At the end, we add return false so that the click on the link is not executed
		return false;
	});
});
/* ]]> */
</script>




