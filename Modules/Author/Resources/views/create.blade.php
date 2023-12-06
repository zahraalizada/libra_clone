@extends('layout.admin-form')
@section('title','Admin Authors Page')

@section('content')
    <div class="col-md-12">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> New Author</h4>
                <form action="{{route('author.store')}}" class="form-horizontal style-form" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Author Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-theme" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
