(function($){ // no-conflict wrapper
  $(document).ready(function(){
	  drop_sub();
	  
		tooltipcall("#productname");  
		tooltipcall("#targetprice");
		tooltipcall("#expirationdate");
	  	
	  	$.validator.addMethod("MustSelectOpt", function(value, element) {
			if (value != "") return true;
			else return false;
	    }, "Please select an option.");

		 
		function checkInputVal()
		{
			if ( ($("#targetprice").valid()) && ($("#productname").valid()) ) return true;
			else return false;
		};

		$("#category").change(drop_sub);

		$("#nhForm").submit(function() {
			(checkInputVal()); 
		});
		
		$("#nhForm").validate({
			errorPlacement: function(error, element) {
			error.insertAfter(element);
			error.appendTo( element.parent("p").next("p") );
			}
		});	
		
		$("#nhForm").bind("keypress", function(e) {
		    var c = e.which ? e.which : e.keyCode;
		    if (c == 13) 
			{
		        return false;
		    }
		});
		
  }); // end of (document).ready

  
	  function tooltipcall(selector)
	  {
		  $(selector).tooltip({
				position: "center right",
				offset: [-2, 10],
				effect: "fade",
				opacity: 0.8
			}); 
	  }
	  
	  function drop_sub()
	  {
			var category_val = $('#category').val();

			if(category_val == '000' || category_val == '')
			{
				$('#subcat_drop_down').hide();
				$('#no_subcat_drop_down').show();
			}
			else
			{	
				// hide the drop down...
				$('#subcat_drop_down').hide();
				$('#no_subcat_drop_down').hide();

				$.getJSON('subcat.php',{category:category_val},function(result){
					
					// result is json encoded $data array from subcat.php 
					// {"0":"subcat_data","subcat_data":{"code":["004","005","006"],"name":["Wheels","Tires","Engines"]}}
					if (typeof result.subcat_data  != "undefined") 
					{
					 	var optionsValues = "<span id='subcat_drop_down'><select id='subcategory' name='subcategory'>";
						for (var i =0; i<result.subcat_data.code.length; i++)
						{
							optionsValues += '<option value="' +result.subcat_data.code[i]+ '">' + result.subcat_data.name[i]+ '</option>';
						}
				        optionsValues += '</select></span>';
						$('#subcat_drop_down').replaceWith(optionsValues);
					}
					else $('#no_subcat_drop_down').show();

				});
			}
	  }
	 
			
})(jQuery);    // end of no-conflict wrapper