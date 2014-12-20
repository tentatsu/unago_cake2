$(function(){

	//------------------------------------------------------
	//要素コピー
	$(document).on('click' , '.addBtn', function(){
	  $(this).parent(".inputBox.copyArea").prepend($(this).clone(true).insertAfter(this));
	  $(this).prev().clone(true).insertAfter(this);
	   $(this).next().removeClass("copyArea")
	  $(this).attr("class","removeBtn ophv");
	  $(this).html("登録を削除");
	});
	
	$(document).on('click' , '.removeBtn', function(){
		  $(this).next().next().remove();
		  $(this).next().remove();
		  $(this).attr("class","addBtn ophv");
		  	  $(this).html("追加");
	});
	
	
});