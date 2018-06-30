@extends('layouts.app')

@section('content')

    <a href="/categories" class="btn btn-primary"><i class="fa fa-arrow-left"></i>  Go back</a>
    <br><br>

    <table class="table text-center category-table" data-toggle="dataTable" data-form="deleteForm">
        <tr>
            <td><h2>Category: {{$category->name}}</h2></td>

            @if(!Auth::guest())
                @if(Auth::user()->id == $category->user_id)
                    <td>
                        <a href="/categories/{{$category->id}}/edit" class="btn btn-primary">Edit category</a>
                    </td>
                    <td>
                        {!! Form::model($category, ['method' => 'delete', 'route' => ['categories.destroy', $category->id], 'class' =>'form-delete']) !!}
                        {!! Form::hidden('id', $category->id) !!}
                        {!! Form::submit(trans('Delete'), ['class' => 'btn btn-danger delete', 'name' => 'delete_modal']) !!}
                        {!! Form::close() !!}
                    </td>
                @endif
            @endif
        </tr>
    </table>
    
    <br>

    @foreach($category->posts->sortByDesc('created_at') as $post)
    <div class="card">
        <div class="card-body">
            <h3><u>{{$post->title}}</u></h3>
            <br>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <img style="width:100%" src="/storage/post_images/{{$post->post_image}}">
                </div>
                <div class="col-md-9 col-sm-9"> 
                    <small class="post-tag">Created on: <em>{{$post->created_at}}</em> by <strong>{{$post->user->name}}</strong> on <strong>{{$post->category->name}}</strong> category</small>
                    <p>{!! str_limit($post->body, 300, '...') !!}</p>
					<br>
                    <a href="/posts/{{$post->id}}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>
    </div>    
    <br><br>
    @endforeach

@endsection