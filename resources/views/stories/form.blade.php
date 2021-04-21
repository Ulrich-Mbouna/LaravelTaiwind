<div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title',$story->title) }}" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control">{{ old('body',$story->body) }} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="">--Select--</option>
                            <option value="short" {{ 'short' == old('type',$story->type)?'selected':'' }}>Short</option>
                            <option value="long" {{ 'long' == old('type',$story->type)?'selected':'' }}>Long</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <legend><h6>Status</h6></legend>
                        <div class="form-check">
                            <input type="radio" {{ '1' == old('status',$story->status)?'checked':'' }} class="form-check-input" name="status" value="1">
                            <label for="status" class="form-check-label">Yes</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" {{ '0' == old('status',$story->status)?'checked':'' }} class="form-check-input" name="status" value="0">
                            <label for="status" class="form-check-label">No</label>
                        </div>
                        
                    </div>