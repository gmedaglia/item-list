<div id="add-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
            </div>                            
            <div class="modal-body">
                <form id="form-item-create" method="{{ $method }}" action="{{ $action }}">
                    <input id="item-image-filename" type="hidden" name="image" />
                    <div class="form-group">
                        <label for="item-image">Image</label>
                        <input id="item-image" class="form-control-file" type="file" name="image" />
                    </div> 
                    <div id="uploaded-img" class="text-center mb-4"></div>                                   
                    <div class="form-group">
                        <label for="item-description">Description</label>
                        <textarea id="item-description" class="form-control" name="description" rows="10"></textarea>
                    </div>
                    <div class="text-right">
                        <button id="cta-store" type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>