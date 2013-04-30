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
	
	var user_id = $('input[name=id]').val();
	
	$("form.validate").validate({
    rules: 
    {
    	// setting
    	province_id:{required: true},
    	province_name:{required: true},
    	amphor_id:{required: true},
    	amphor_name:{required: true},
    	tumbon_name:{required: true},
    	
    	// form user **setting/user_form**
    	user_type_id:{required: true},
    	status:{required: true},
    	username:{required: true, minlength: 4, remote: "setting/check_username/"+user_id},
    	fullname:{required: true},
    	name:{required: true},
    	surname:{required: true},
    	department_id:{required: true},
    	division_id:{required: true},
    	group_id:{required: true},
    	person_type_id:{required: true},
    	id_card:{required: true},
    	email:{required: true, email: true, remote: "setting/check_email/"+user_id},
    	password:{required: true, minlength: 4},
    	_password:{equalTo: "#password"}
    },
    messages:
    {
    	// setting
    	province_id:{required: "กรุณาเลือกจังหวัด"},
    	province_name:{required: "กรุณากรอกชื่อจังหวัด"},
    	amphor_id:{required: "กรุณาเลือกอำเภอ"},
    	amphor_name:{required: "กรุณากรอกชื่ออำเภอ"},
    	tumbon_name:{required: "กรุณากรอกชื่อตำบล"},
    	
    	// form user **setting/user_form**
    	user_type_id:{required: "กรุณาเลือกสิทธิ์การใช้งาน"},
    	status:{required: "กรุณาเลือกสถานะ"},
    	username:{required: "กรุณากรอกชื่อล็อกอิน", minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 4 ตัวอักษร", remote: "ยูสเซอร์เนมนี้ไม่สามารถใช้งานได้"},
    	fullname:{required: "กรุณากรอกชื่อ - นามสกุล"},
    	name:{required: "กรุณากรอก Name"},
    	surname:{required: "กรุณากรอก Surname"},
    	department_id:{required: "กรุณาเลือก กรม"},
    	division_id:{required: "กรุณาเลือกกอง / สำนักงาน"},
    	group_id:{required: "กรุณาเลือกกลุ่ม / ฝ่าย"},
    	person_type_id:{required: "กรุณาเลือกประเภทบุคลากร"},
    	id_card:{required: "กรุณากรอกบัตรประชาชน"},
    	email:{required: "กรุณากรอกอีเมล์", email: "กรุณากรอกอีเมล์ให้ถูกต้อง", remote: "อีเมล์นี้ไม่สามารถใช้งานได้"},
    	password:{required: "กรุณากรอกรหัสผ่าน", minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 4 ตัวอักษร"},
    	_password:{equalTo: "กรุณากรอกรหัสผ่านให้ตรงกันทั้ง 2 ช่อง"}
    }
    });
    
});
