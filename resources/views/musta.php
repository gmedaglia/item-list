<script id="tpl-item-list" type="text/x-handlebars-template">
	<div class="alert alert-secondary mb-4">Showing {{ count }} items</div>
    <div id="items">
    {{#each items}}
        {{> item item=this }}
    {{/each}}
    </div>
</script>


<script id="tpl-item" type="text/x-handlebars-template">
    <div id="item-{{ item._id }}" class="item row mb-4">
        <div class="col-md-2"><img src="{{ item.image_url }}" class="img-fluid" style="max-height: 100px;" /></div>
        <div class="col-md-7"><p>{{ item.description }}</p></div>
        <div class="col-md-3">
        	<ul class="list-inline">
        		<li><a href="">Edit</a></li>
        		<li><a href="">Delete</a></li>
    		</ul>
        </div>
    </div>
</script>