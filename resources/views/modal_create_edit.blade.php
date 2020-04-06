<div id="modal-{{ $type }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
            </div>                            
            <div class="modal-body">
                <form id="form-{{ $type }}" method="{{ $method }}" action="">
                    <input id="field-image-filename-{{ $type }}" class="field-image-filename" type="hidden" name="image" />
                    <div class="form-row mb-4">
                        <div class="col">
                            <div class="form-group">
                                <label for="field-image-{{ $type }}">Image</label>
                                <input id="field-image-{{ $type }}" class="form-control-file field-image" type="file" name="image" />
                                <small class="form-text text-muted">JPG, GIF or PNG - 320x320.</small>
                            </div>
                        </div>
                        <div class="col">
                            <div id="{{ $type }}-uploaded-img" class="text-right uploaded-img"></div>
                        </div>
                    </div>                                   
                    <div class="form-group">
                        <label for="field-description-{{ $type }}">Description</label>
                        <textarea id="field-description-{{ $type }}" class="form-control" name="description" rows="7"></textarea>
                        <small class="form-text text-muted">Max. 300 chars.</small>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>