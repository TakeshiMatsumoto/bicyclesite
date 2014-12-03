$(function(){
	
	var eventName='江田島サイクリング';
	
	$('#eventName')
		.addClass('watermark')
		.val(eventName)
		.focus(function(){
			$(this).removeClass('watermark');
			if($(this).val()===eventName){
				
				$(this).val('')=="";
			}
			
		})
	
	.blur(function(){
			$(this).removeClass('watermark');
			if($(this).val()===''){
				
				$(this).val(eventName);
				$(this).addClass('watermark');
			}
	
	})
	

	
	
	});

$(function(){
	
	var distance='100km';
	
	$('#distance')
		.addClass('watermark')
		.val(eventName)
		.focus(function(){
			$(this).removeClass('watermark');
			if($(this).val()===distance){
				
				$(this).val('')=="";
			}
		})
	
	.blur(function(){
			$(this).removeClass('watermark');
			if($(this).val()===''){
				
				$(this).val(distance);
				$(this).addClass('watermark');
			}
	
	})
	

	
	
	});

$(function(){
	
	var datail='江田島をのんびり一周しようと思います。雨天決行ですのでよろしくお願いします。クロス、ロード、どなたでもどうぞ。';
	
	$('#details')
		.addClass('watermark')
		.val(eventName)
		.focus(function(){
			$(this).removeClass('watermark');
			if($(this).val()===datail){
				
				$(this).val('')=="";
			}
		})
	
	.blur(function(){
			$(this).removeClass('watermark');
			if($(this).val()===''){
				
				$(this).val(datail);
				$(this).addClass('watermark');
			}
	
	})
	

	
	
	});





