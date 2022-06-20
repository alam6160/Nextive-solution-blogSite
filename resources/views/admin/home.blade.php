@extends('admin.muster')
@section('content2')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Admin-Dashboard') }}</div>

                 <div class="row mt-2">
        <div class="col-lg-12 margin-tb ">
            <div class="pull-left">
                <h2>Blog management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success my-2" href="{{ route('blog.create')}}"> <i class="fa fa-add" ></i>Create New post</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Title</th>
            <th class="text-center">Description</th>
            <th class="text-center">pic</th>
            <th class="text-center" width="280px">Action</th>
        </tr>
         @foreach ( $blog as  $bloges)
        <tr>
            <td>{{ $bloges->id }}</td>
            <td>{{ $bloges->title }}</td>
            <td>{{ $bloges->description }}</td>


            <td><img src="{{asset('images/'.$bloges->pic)}}" alt="{{$bloges->pic}}" width="70px" height="70px"></td>

            <td>

                  <a class="btn btn-outline-success" href="{{url('/blog.edit',$bloges->id)}}">
                  <i class="fa fa-edit" style="font-size:35px;"></i>
                  </a>
                  <a class="btn btn-outline-danger" placeholder="delete" href="{{ route('blog.destroy',$bloges->id) }}">
                  <i class="fa fa-trash" style="font-size:35px;"></i>
                  </a>

         
            </td>
  
        </tr>
        @endforeach
    </table>
    
    {!!$post->links() !!}
     
             
           
    
    {!! Toastr::message() !!}
</div>
@endsection
@endsection