$(function()
{

$("#content").focus(function()
{
$(this).animate({"height": "85px",}, "fast" );
$("#button_block").slideDown("fast");
return false;
});

$("#cancel").click(function()
{
$("#content").animate({"height": "30px",}, "fast" );
$("#button_block").slideUp("fast");
return false;
});


function dragDrop(drag,i,j){
$(drag+i).draggable({
	helper: 'clone',
	revert : function(event, ui) {
            // on older version of jQuery use "draggable"
            // $(this).data("draggable")
            // on 2.x versions of jQuery use "ui-draggable"
            // $(this).data("ui-draggable")
            $(this).data("uiDraggable").originalPosition = {
                top : 0,
                left : 0
            };
            // return boolean
            return !event;
            // that evaluate like this:
            // return event !== false ? false : true;
        }
});
if(j==0){
$('#dropzone'+j).droppable({
tolerance: 'touch',
activeClass: 'ui-state-default',
hoverClass: 'ui-state-hover',

drop: function(event, ui) {


		var id = ui.draggable.attr("id");
		var res = id.substr(9,9);
		var post = parseInt(res);
		text = $('div#contenttext'+post).text();
		//	alert(id);



	$('#text').val(text);

	$.ajax({
				type: "POST",
				url: "index.php",
				data: text,
				success:function(data){
					$( ".tw-posts" ).prepend("<div class='tw-update'> <div class='post-container2'>"+text+"</div></div>");
					$( "#button" ).trigger( "click" );


				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
console.log(text);


}
});
} else {
	$('#dropzone'+j).droppable({
	tolerance: 'touch',
	activeClass: 'ui-state-default',
	hoverClass: 'ui-state-hover'+j,

	drop: function(event, ui) {


			var id = ui.draggable.attr("id");
			var res = id.substr(9,9);
			var post = parseInt(res);
			text = $('div#contenttext'+post).text();
			//	alert(id);



		$('#text').val(text);

		$.ajax({
					type: "POST",
					url: "index.php",
					data: text,
					success:function(data){
						$( ".tw-posts" ).prepend("<div class='tw-update'> <div class='post-container2'>"+text+"</div></div>");
						$( "#button" ).trigger( "click" );


					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError); //throw any errors
					}
				});
	console.log(text);


	}
	});
}
}


for (i=0;i<10; i++)
{
	dragDrop("#draggable",i,0);
	dragDrop("#draggabletw",i,1);
}
$('#publish').click(
	function(){
		$.ajax({
           type: "POST",
           url: "index.php",
           data: $("#form2").serialize(), // serializes the form's elements.
					beforeSend: function(){

					},
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

	}

);
/*$("#form2").submit(function() {

    var url = "publish.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#form2").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    return false; // avoid to execute the actual submit of the form.
});*/
});
