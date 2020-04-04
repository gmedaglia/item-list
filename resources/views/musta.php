<script id="tpl-item-list" type="text/x-handlebars-template">
	<div class="alert alert-warning mb-4">Showing {{ count }} items</div>
    <div id="items">
    {{#each items}}
        {{> item item=this }}
    {{/each}}
    </div>
</script>


<script id="tpl-item" type="text/x-handlebars-template">
    <div id="item-{{ item._id }}" class="item row mb-4">
        <div class="col-md-2 text-center"><img src="{{ item.image_url }}" class="img-fluid rounded" style="max-height: 100px;" /></div>
        <div class="col-md-7"><p>{{ item.description }}</p></div>
        <div class="col-md-3 text-center">
        	<ul class="list-inline">
        		<li class="list-inline-item"><a href="">Edit</a></li>
        		<li class="list-inline-item"><a href="">Delete</a></li>
    		</ul>
        </div>
    </div>
</script>