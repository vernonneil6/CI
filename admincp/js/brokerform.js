
              $(document).ready(function() {
                  $("#submitbroker").click(function() {
				 			  
				     if($('#usercheck').val()==0)
					 {
						 return false;
					 }
					 
					 if($('#mainbrokerid').val()==0){
					   
					   $('#selecterror').show();
					   return false;
					}
					 if($('#subbrokerid').val()==0){
					   
					   $('#selecterror').show();
					   return false;
					}
					 if($('#marketerid').val()==0){
					   
					   $('#selecterror').show();
					   return false;
					}
				 		  
					  $("#frmbrokeradd").submit();
                  });
              });
 
