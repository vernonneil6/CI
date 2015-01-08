function trim(stringToTrim) {
      return stringToTrim.replace(/^\s+|\s+$/g,"");
}

        
function getstates(id,state,where) {	//alert(id);
	if(id !='') {

		$.ajax({
			type 				: "POST",
			url 				: "index.php/elite/getallstates",
			data				:	{ 'cid' : id , 'state':state},
			dataType 			: "html",
			cache				: false,
			success				: function(data){
									//console.log(data);
											//alert(data);
										$(where).empty();
										$(where).append(data);
									}
		});
	}
}
