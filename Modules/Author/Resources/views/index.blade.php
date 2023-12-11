@extends('layout.admin-table')
@section('title','Admin Authors Page')

@section('content')
    <div class="col-md-12">
        <div class="content-panel">
            <div class="">
                <h4 class="pull-left"><i class="fa fa-angle-right"></i> Authors Table</h4>
                <a href="{{route('author.create')}}" class="pull-right btn btn-theme02">+ Create</a>
            </div>
            <div class="clearfix"></div>

            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$author->name}}</td>
                        <td>{{$author->description}}</td>
                        <td>{{$author->image}}</td>
                        <td class="text-right">
                            <a href="{{route('author.edit',$author->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <a  href="{{route('author.delete',$author->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
