jQuery(document).ready(function($) {

	$('.carousel').carousel({
		interval:3500
	});

	$('ul.sf-menu').superfish();

	$('a.gallery-image').colorbox({ opacity:0.5 , rel:'group1' });

	$('span.delete-image').on('click', function(e){

		e.preventDefault();
		
		//find the order of the clicked image
		var order = $(this).siblings('span').text();
		
		//find all image Divs after the clicked image
		var nextImagesDivs = $(this).parent().nextAll();

		var nextImages = [];

		nextImagesDivs.each(function(i) {

			var spanImageOrder = $(this).find('.image-order');

			//update the order of images after clicked
			spanImageOrder.text(parseInt(order) + i);

			//array of image id's and new order in the database
			nextImages[i] = [ $(this).find('img').attr('alt'), spanImageOrder.text() ];
		});

		//console.log(nextImages);

		$(this).closest('div.image-in-list').fadeOut('300', function(){
			$(this).remove();	
		});

		var data = {
			'image_id' : $(this).prev().find('img').attr('alt'),
			'next_images' : nextImages
		};

		$.post(PUBLICPATH + '/images/delete/' + data['image_id'], data, function(response){
			console.log(response);
		});
	});

	$('.image-list').sortable({
		placeholder: 'placeholder',
		opacity: 0.7,
		update: function(event, ui){
			var i=0;
			var orderArray = [];
			$(this).find('.image-in-list').each(function(){
				var order = $(this).find('.image-order');
				order.text(++i);
				orderArray[i] = [$(this).find('img').attr('alt'), order.text() ];
			});

			//console.log(orderArray);

			var data = {
				'order_array' : orderArray
			}

			$.post(PUBLICPATH + '/images/sort', data, function(response){
				console.log(response);
			});
		} 
	});
	//$('.image-list').disableSelection();
});