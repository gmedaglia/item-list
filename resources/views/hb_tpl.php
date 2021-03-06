<script id="tpl-item-list" type="text/x-handlebars-template">
	<div class="alert alert-warning mb-4">Item count: <strong><span id="item-count">{{count}}</span></strong>. Drag and drop to adjust order.</div>
	<div id="items" class="row">
	    {{#each items}}
	        {{> item item=this}}
	    {{/each}}
	</div>
</script>

<script id="tpl-item" type="text/x-handlebars-template">
	<div class="col-lg-3 col-md-4 col-sm-6 item" id="item-{{item._id}}">
		<div class="card mb-4">
	  		<img src="{{item.image_url}}" class="card-img-top" alt="...">
		  	<div class="card-body">
		    	<p class="card-text"><small>{{item.description}}</small></p>
	        	<ul class="list-inline text-right">
	        		<li class="list-inline-item">
	        			<a href="" data-item-id="{{item._id}}" data-toggle="modal" data-target="#modal-edit">
	        				<span class="fas fa-edit"></span>
	        			</a>
	        		</li>
	        		<li class="list-inline-item">
	        			<a href="" data-item-id="{{item._id}}" data-toggle="modal" data-target="#modal-confirm-delete">
	        				<span class="fas fa-trash"></span>
	        			</a>
	        		</li>
	    		</ul>
		  	</div>
		</div>
	</div>
</script>


<script id="tpl-errors" type="text/x-handlebars-template">
	<div class="alert alert-danger mb-4">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
		<h6>Oops...</h6>
		<ul>
		    {{#each errors}}
		        <li>{{this}}</li>
		    {{/each}}
		</ul>
	</div>
</script>
