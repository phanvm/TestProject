$(function(){
	
});
function deleteEmployee(emid , type){
	if(emid != null){
		if( confirm("Are you sure you want to delete the record!")){
			window.location.href = "/delete?emid="+emid+"&type="+type;
		}
	}
}
function redirect_js( links ){
	window.location.href = links;
}