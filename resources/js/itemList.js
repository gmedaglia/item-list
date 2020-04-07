function ItemList() {

	this.items = [];

    this.init = function() {
		Handlebars.registerPartial("item", $('#tpl-item').html());
		$('.toast').toast({delay: 2000});
		$('#modal-confirm-delete, #modal-create, #modal-edit').modal({show: false});
		this.setupEventListeners();
	};

	this.uploadImage = function(file) {
        let formData = new FormData();
        formData.append('image', file);

        let modal = $('.modal:visible');
        let uploadedImgContainer = modal.find('.uploaded-img');
        let filenameField = modal.find('[name=image]');
        filenameField.val('');
        uploadedImgContainer.find('img').addClass('d-none');
        uploadedImgContainer.find('.badge').addClass('d-none');

        $.ajax({
            method: "post",
            url: "/api/images",
            data: formData,
            contentType: false,
            cache: false,
            processData: false
        }).done(function(response, textStatus, request) {
            let imgUrl = request.getResponseHeader('Location');
            uploadedImgContainer.find('img').attr('src', imgUrl).removeClass('d-none');
            filenameField.val(imgUrl.split('/').pop());
        }).fail(function (jqXHR) {
        	let status = jqXHR.status;
        	if (status == 400 || status == 413) {
                uploadedImgContainer.find('.badge').removeClass('d-none');
            }
        });
	};

	this.storeItem = function(data) {
        let self = this;
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
			        $('#modal-create form').prepend(html);
		    	}
		  	},
		  	beforeSend: function() {
			    $('body').addClass('wait');
		  	}
	    }).done(function(response) {
	    	let item = response.data;
            self.items.push(item);
	        let template = $('#tpl-item').html();
	        let templateScript = Handlebars.compile(template);
	        let html = templateScript({
	        	"item": {
	        		image_url: item.image_url,
	        		_id: item._id,
	        		description: item.description
	        	}
	        });
	        $('#modal-create').modal('hide');
	        $(html).hide().appendTo('#items').fadeIn(300);
	        $('#item-count').html(parseInt($('#item-count').html()) + 1);
	    }).always(function() {
	    	$('body').removeClass('wait');
	    });
	};

	this.updateItem = function(id, data) {
		let self = this;
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
			        $('#modal-edit form').prepend(html);
		    	}
		  	},
		  	beforeSend: function() {
			    $('body').addClass('wait');
		  	}
	    }).done(function(response) {
	    	let item = response.data;
	    	let elem = $('#items').find('#item-' + id);
	        let template = $('#tpl-item').html();
	        let templateScript = Handlebars.compile(template);
	        let html = templateScript({
	        	"item": {
	        		image_url: item.image_url,
	        		_id: item._id,
	        		description: item.description
	        	}
	        });
	        elem.replaceWith(html);

			let index = _.findIndex(self.items, function (o) {
				return o._id == item._id;
			});
			self.items[index] = item;

	        $('#modal-edit').modal('hide');
	    }).always(function() {
	    	$('body').removeClass('wait');
	    });
	};

	this.destroyItem = function(itemId) {
	    $.ajax({
	    	method: 'delete',
	        url: "/api/items/" + itemId,
		  	beforeSend: function() {
			    $('body').addClass('wait');
		  	}
	    }).done(function(response) {
	    	$('body').removeClass('wait');
	    	let elem = $('#item-list').find('#item-' + itemId);
	    	elem.fadeOut(300, function() {
	    		$(this).remove();
	    	});
	    	let count = $('#item-count');
	        count.html(parseInt(count.html()) - 1);
	    });
	};

	this.getItems = function() {
		let self = this;
	    $.ajax({
	        url: "/api/items",
	    }).done(function(response) {
	    	self.items = response.data;
	        let template = $('#tpl-item-list').html();
	        let templateScript = Handlebars.compile(template);
	        let html = templateScript({"items": self.items, "count": response.metadata.count});
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
		var self = this;

		$('.modal form').on('submit', function(event) {
			event.preventDefault();
			let that = $(this);
			that.find('.alert').alert('close');
		});

        $('#form-create').on('submit', function(event) {
            let data = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            self.storeItem(data);
        });

        $('#form-edit').on('submit', function(event) {
            let itemId = $(this).data('item-id');
            let data = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            self.updateItem(itemId, data);
        });

        $('#cta-confirm-delete').on('click', function (event) {
            self.destroyItem($(this).data('item-id'));
        });

        $('input[name=image-file]').on('change', function() {
            let file = $(this).get(0).files[0];
            self.uploadImage(file);
        });

		$('#modal-confirm-delete').on('show.bs.modal', function (e) {
			let itemId = $(e.relatedTarget).data('item-id');
			$(e.target).find('#cta-confirm-delete').data('item-id', itemId);
		});

		$('#modal-edit').on('show.bs.modal', function (e) {
			let itemId = $(e.relatedTarget).data('item-id');
			console.log(self.items);
			let item = _.find(self.items, function (o) {
				return o._id == itemId;
			});
			let modal = $(e.target);
			modal.find('[name=image]').val(item.image_url.split('/').pop());
			modal.find('[name=description]').val(item.description);
			modal.find('#edit-uploaded-img').find('img').attr('src', item.image_url).removeClass('d-none');
			modal.find('form').data('item-id', itemId);
		});

		$('#modal-create, #modal-edit').on('hidden.bs.modal', function (e) {
			let modal = $(e.target);
	  		modal.find('form').trigger('reset');
	  		modal.find('input[type=hidden]').val('');
	  		modal.find('.uploaded-img *').addClass('d-none');
	  		modal.find('.alert').alert('close');
		});
	};

}
