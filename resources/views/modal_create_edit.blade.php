<div id="{{ $id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
            </div>                            
            <div class="modal-body">
                <form id="form-item-create" method="{{ $method }}" action="">
                    <input id="item-image-filename" type="hidden" name="image" />
                    <div class="form-row mb-4">
                        <div class="col">
                            <div class="form-group">
                                <label for="item-image">Image</label>
                                <input id="item-image" class="form-control-file" type="file" name="image" />
                                <small class="form-text text-muted">JPG, GIF or PNG - 320x320.</small>
                            </div>
                        </div>
                        <div class="col">
                            <div id="uploaded-img" class="text-right"></div>
                        </div>
                    </div>                                   
                    <div class="form-group">
                        <label for="item-description">Description</label>
                        <textarea id="item-description" class="form-control" name="description" rows="10"></textarea>
                        <small class="form-text text-muted">Max. 300 chars.</small>
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