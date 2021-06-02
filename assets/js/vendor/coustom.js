        function add_to_cart(id)
           function add_to_cart(id,type){
	var qty=jQuery('#qty'+id).val();
	var attr=jQuery('input[name="radio_'+id+'"]:checked').val();
	var is_attr_checked='';
	if(typeof attr=== 'undefined'){
		is_attr_checked='no';
	}
	if(qty>0 && is_attr_checked!='no'){
		jQuery.ajax({
			url:'http://localhost/phpbasic/' + 'manage_cart',
			type:'post',
			data:'qty='+qty+'&attt='+attr+'&type='+type,
			success:function(result){
				swal("Congratulation!", "Dish added successfully", "success");
				jQuery('#shop_added_msg_'+attr).html('(Added -'+qty+')');
			}
		});
	}else{
		swal("Error", "Please select qty and dish item", "error");
    }
}
         
           
    