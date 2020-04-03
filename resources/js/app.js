//require('./bootstrap');


function itemList(name) {

	Handlebars.registerPartial("item", $('#tpl-item').html());

	function addItem() {
		var item = {
        	image: 'EoLxZe3w1t7LgbAe1W33CLmGQiKR9ex3LFTESiHp.jpeg',
        	description: 'La cdtm All Boys!'			
		};
	    $.ajax({
	    	method: 'post',
	        url: "/api/items",
	        data: {
	        	image: item.image,
	        	description: item.description
	        }
	    }).done(function(response) {
	    	var item = response.data;
	        var template = $('#tpl-item').html();
	        var templateScript = Handlebars.compile(template);
	        var html = templateScript({"item": {image_url: item.image_url, _id: item.id, description: item.description}});
	        $(html).appendTo('#items');
	    });		
	};

	function retrieve() {
	    $.ajax({
	        url: "/api/items",
	    }).done(function(response) {
	        var template = $('#tpl-item-list').html();
	        var templateScript = Handlebars.compile(template);
	        var html = templateScript({"items": response.data, "count": response.metadata.count});
	        $('#item-list').append(html);
	        $('#items').sortable({
	        	items: '.item',
	        	stop: function(event, ui) {
	        		console.log(ui, ui.helper);
	        		a = $(this).sortable("serialize", {key: "sort"});
	        		alert(a);
	        	}
	        });

	    });
    }
  
  	return {
	    retrieve: retrieve,
	    addItem: addItem
  	}

}