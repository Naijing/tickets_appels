

$(function () {



$('#btn1').click(function(){



		   $.post('process.php',{isbn:$('#isbn').val()},function(response){

				$('#box').html(response);

				var obj=eval('('+response+')');
				
				$('#title').val(obj.title);
				$('#auteur').val(obj.author);
				$('#lang').val(obj.language);

				$('#cover-preview').attr('src', obj.image);


        });


});




});
