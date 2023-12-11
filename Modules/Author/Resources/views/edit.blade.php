@extends('layout.admin-form')
@section('title','Admin Authors Page')

@section('content')
    <div class="col-md-12">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> New Author</h4>
                <form action="{{route('author.update',$author->id)}}" class="form-horizontal style-form" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Author Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{$author->name}}">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="description" class="control-label col-lg-2">Description</label>
                        <div class="col-lg-10">
                            <textarea class="form-control " id="description" name="description">{{$author->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Author Image</label>
                        <div class="controls col-md-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select file</span>
                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                    <input type="file" class="default" name="image"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;">{{$author->image}}</span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists"
                                   data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-theme" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
