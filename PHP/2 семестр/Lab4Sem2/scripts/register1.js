jQuery(function($) {
	$('#register').on('submit', function(event) {
    if ( validateForm() ) { // если есть ошибки возвращает true
      event.preventDefault();
    }
  });
	 ;function validateAge(date) {
		curDate = new Date();
		var age = curDate.getFullYear() - date.getFullYear();
		return age;
	}
  function validateForm() {
    $(".text-error").remove();
    var v_name = false
	var v_date = false;
	var v_age = false;
	var name_err = $("#NameErr");
      
    var el_l = $("#Name");
    if ( el_l.val() == null || el_l.val() == "") {
      v_name = true;
	  el_l.css("border-color","red");
      name_err.text("Name is empty, name should not be empty!");
      //$(".for-login").css({top: el_l.position().top + el_l.outerHeight() + 2});
    }
	else
	{
		el_l.css("border-color","#20207E");
		name_err.text("");
	}
    
    var date_error = $("#text-error-for-date");
	var day = $("#Day").val();
	var month = $("#Month").val();
	var year = $("#Year").val();
	var date_el = $("#dateOf");
	var dob = new Date(year, month-1, day);
	var year_v = dob.getFullYear() == year;
	var month_v = dob.getMonth() == month-1;
	var day_v = dob.getDate() == day;
	console.log(dob.getMonth());
	console.log(month-1);
	console.log(year_v);
	console.log(month_v);
	console.log(day_v);
	if (year_v && month_v && day_v && year<2020 && year >1900) {
		v_date = false;
		date_error.text("");
		$("#Year").css("border-color","#20207E");
		$("#Month").css("border-color","#20207E");
		$("#Day").css("border-color","#20207E");
	} else {
		$("#Year").css("border-color","red");
		$("#Month").css("border-color","red");
		$("#Day").css("border-color","red");
		console.log("wtf");
		date_error.text("Wrong date, day<32; month<13; 1900<year<2020");
		v_date = true;
	}
	var age = validateAge(dob);
	console.log("Age is:"+age);
	
	var Male = $('#contactChoice1').prop("checked");
	if ((Male == true && age <21)||(Male == false && age<18))
	{
		if(v_date == false)
        date_error.text("You are too young");
        v_age = true;
		//css("border-color","red");
	}
	else 
		v_age = false;
	
    
    
    return ( v_name || v_date || v_age);
  }
   
});