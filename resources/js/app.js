function ItemList() {

    this.init = function() {
		Handlebars.registerPartial("item", $('#tpl-item').html());
		$('.toast').toast({delay: 2000});
		$('#confirm-delete-modal').modal({show: false});
		$('#add-modal').modal({show: false});
		this.setupEventListeners();

		$('#add-modal, #edit-modal').on('hidden.bs.modal', function (e) {
			let self = $(this);
	  		self.find('form').trigger('reset');
	  		self.find('input[type=hidden]').val('');
	  		self.find('img').remove();
	  		self.find('.alert').alert('close');
		})
	};

	this.uploadImage = function(file) {        
        let formData = new FormData();
        formData.append('image', file);
        $.ajax({
            method: "post",
            url: "/api/images",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            statusCode: {
                400: function(response) {
                    $('#form-item-create').trigger('reset');
                    alert('Error!');
                }
            }                        
        }).done(function(response, textStatus, request) {
            let imgUrl = request.getResponseHeader('Location');
            $('#uploaded-img').html('<img class="img-fluid" style="max-width: 80px;" src=" ' + imgUrl + '" />');
            $('#item-image-filename').val(imgUrl.split('/').pop());
        });		
	};

	this.storeItem = function(data) {
	    $.ajax({
	    	method: 'post',
	        url: '/api/items',
	        data: data,
		  	statusCode: {
		    	400: function(response) {
		      		var errors = _.flatMap(response.responseJSON);
			        let template = $('#tpl-errors').html();
			        let templateScript = Handlebars.compile(template);
			        let html = templateScript({"errors": errors});
			        $('#add-modal form').prepend(html);
		    	}
		  	}	        
	    }).done(function(response) {
	    	let item = response.data;
	        let template = $('#tpl-item').html();
	        let templateScript = Handlebars.compile(template);
	        let html = templateScript({
	        	"item": {
	        		image_url: item.image_url, 
	        		_id: item._id, 
	        		description: item.description
	        	}
	        });
	        $('#add-modal').modal('hide');
	        $(html).hide().appendTo('#items').fadeIn(300);
	        //$('body').scrollTo()
	        $('#item-count').html(parseInt($('#item-count').html()) + 1);
	    });		
	};

	this.updateItem = function(id, data) {
	    $.ajax({
	    	method: 'put',
	        url: '/api/items/' + id,
	        data: data,
		  	statusCode: {
		    	400: function(response) {
		      		var errors = _.flatMap(response.responseJSON);
			        let template = $('#tpl-errors').html();
			        let templateScript = Handlebars.compile(template);
			        let html = templateScript({"errors": errors});
			        $('#add-modal form').prepend(html);
		    	}
		  	}	        
	    }).done(function(response) {
	    	let item = response.data;
	    	let elem = $('#items').find('item-' + id);

	        $('#add-modal').modal('hide');
	    });		
	};	

	this.askForItemDeletionConfirmation = function(itemId) {
		let modal = $('#confirm-delete-modal');
		modal.find('#cta-confirm-delete').data('item-id', itemId);
		modal.modal('show');	
	};

	this.removeItem = function(itemId) {
		$('#confirm-delete-modal').modal('hide');
	    $.ajax({
	    	method: 'delete',
	        url: "/api/items/" + itemId
	    }).done(function(response) {
	    	let elem = $('#item-list').find('#item-' + itemId);
	    	elem.fadeOut(300, function() { 
	    		$(this).remove(); 
	    	});
	    	let count = $('#item-count');
	        count.html(parseInt(count.html()) - 1);
	    });		
	};	

	this.retrieve = function() {
	    $.ajax({
	        url: "/api/items",
	    }).done(function(response) {
	        let template = $('#tpl-item-list').html();
	        let templateScript = Handlebars.compile(template);
	        let html = templateScript({"items": response.data, "count": response.metadata.count});
	        $('#item-list').append(html);
	       
	        $('#items').sortable({
	        	items: '.item',
	        	start: function(event, ui) {
	        		$('body').css('cursor', 'move');
	        	},   	
	        	stop: function(event, ui) {
	        		$('body').css('cursor', 'default');
	        		let rowIds = $(this).sortable("toArray");
	        		let requestBody = _.map(rowIds, function (item, index) {
	        			return {
	        				"id": item.replace('item-', ''), 
	        				"order": index
	        			};
	        		});
				    $.ajax({
				    	method: 'post',
				        url: "/api/items-order",
				        contentType: 'application/json',
				        data: JSON.stringify(requestBody)
				    }).done(function(response) {
				    	$('.toast').toast('show');
				    });
	        	}
	        });

	    })
    };

	this.setupEventListeners = function() {
		var that = this;

        $('#form-item-create').on('submit', function(event) {
            event.preventDefault();
            let data = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            that.storeItem(data);
        });

        $('#add-item').on('click', function(event) {
            event.preventDefault();
            $('#add-modal').modal('show');
        });

        $('#item-list').on('click', '.delete-item', function(event) {
            event.preventDefault();
            that.askForItemDeletionConfirmation($(this).data('item-id'));
        });

        $('#cta-confirm-delete').on('click', function (event) {
            that.removeItem($(this).data('item-id'));
        });	

        $('#item-image').on('change', function() {
            let file = $(this).get(0).files[0];
            that.uploadImage(file);
        });        	
	};    

}