@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5 class="text-center">Dashboard</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">Categories created by <strong>{{auth()->user()->name}}</strong>:</div>
                        <div class="card-body">  

                            @if(count($categories) > 0)
                                <div class="table-responsive">                    
                                <table class="table table-hover" data-toggle="dataTable" data-form="deleteForm">
                                    <tr>
                                        <th>Category title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td><a href="/categories/{{$category->id}}/edit" class="btn btn-primary">Edit</a></td>
                                            <td>
                                                {!! Form::model($categories, ['method' => 'delete', 'route' => ['categories.destroy', $category->id], 'class' =>'form-delete']) !!}
                                                {!! Form::hidden('id', $category->id) !!}
                                                {!! Form::submit(trans('Delete'), ['class' => 'btn btn-danger delete', 'name' => 'delete_modal']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @else
                                <p>You have no categories.</p>
                            @endif
                        </div>    
                    </div>
                    <br>

                    <div class="card">
                        <div class="card-header">Posts created by <strong>{{auth()->user()->name}}</strong>:</div>
                        <div class="card-body">
                            
                            @if(count($posts) > 0)
                                <div class="table-responsive">
                                <table class="table table-hover" data-toggle="dataTable" data-form="deleteForm">
                                    <tr>
                                        <th>Post title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->title}}</td>
                                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                            <td>
                                                {!! Form::model($posts, ['method' => 'delete', 'route' => ['posts.destroy', $post->id], 'class' =>'form-delete']) !!}
                                                {!! Form::hidden('id', $post->id) !!}
                                                {!! Form::submit(trans('Delete'), ['class' => 'btn btn-danger delete', 'name' => 'delete_modal']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div>
                            @else
                                <p>You have no posts.</p>
                            @endif
                        
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
