
              $(document).ready(function() {
                  $("#submitbroker").click(function() {
				 			  
				     if($('#usercheck').val()==0)
					 {
						 return false;
					 }
				 		  
					  $("#frmbrokeradd").submit();
                  });
              });
 
