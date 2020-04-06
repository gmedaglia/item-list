<div id="modal-{{ $type }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
            </div>                            
            <div class="modal-body">
                <form id="form-{{ $type }}" method="{{ $method }}" action="">
                    <input id="field-image-filename-{{ $type }}" type="hidden" name="image-filename" />
                    <div class="form-row mb-4">
                        <div class="col">
                            <div class="form-group">
                                <label for="field-image-{{ $type }}">Image</label>
                                <input id="field-image-{{ $type }}" class="form-control-file" type="file" name="image" />
                                <small class="form-text text-muted">JPG, GIF or PNG - 320x320.</small>
                            </div>
                        </div>
                        <div class="col">
                            <div id="{{ $type }}-uploaded-img" class="text-right uploaded-img">
                                <img class="img-fluid d-none" style="max-width: 80px;" src="" />
                                <span class="badge badge-danger d-none">Invalid file! Check the requirements.</span> 
                            </div>
                        </div>
                    </div>                                   
                    <div class="form-group">
                        <label for="field-description-{{ $type }}">Description</label>
                        <textarea id="field-description-{{ $type }}" class="form-control" name="description" rows="7"></textarea>
                        <small class="form-text text-muted">Max. 300 chars.</small>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" data-alt-label="Submitting...">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>