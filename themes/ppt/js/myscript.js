$(document).ready(function(){
	$('.datepicker').datepick({showOn: 'both', buttonImageOnly: true, buttonImage: 'media/js/jquery.datepick/calendar.png'});
	
	$("input[type='button'][value='ย้อนกลับ']").click(function(event) {
	    event.preventDefault();
	    history.back(1);
	});

	$('.tblist tr:odd').addClass('odd');

	Cufon.replace('h1, h3, h4, h5');
	
	$("#browser").treeview();

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
	
	$("form.validate").validate({
    rules: 
    {
    	province_id:{required: true},
    	province_name:{required: true},
    	amphor_id:{required: true},
    	amphor_name:{required: true},
    	tumbon_name:{required: true}
    },
    messages:
    {
    	province_id:{required: "กรุณาเลือกจังหวัด"},
    	province_name:{required: "กรุณากรอกชื่อจังหวัด"},
    	amphor_id:{required: "กรุณาเลือกอำเภอ"},
    	amphor_name:{required: "กรุณากรอกชื่ออำเภอ"},
    	tumbon_name:{required: "กรุณากรอกชื่อตำบล"}
    }
    });
    
});
