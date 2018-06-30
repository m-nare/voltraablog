@extends('layouts.app')

@section('content')

    <a href="/posts" class="btn btn-primary"><i class="fa fa-arrow-left"></i>  Go back</a>

    <br><br>
    <div class="card">
        <div class="card-body">
            <h2 class="text-center"><u>{{$post->title}}</u></h2>
            <br>

            @if($post->post_image != 'noimage.png')
                <div class="row">
                    <div class="col-md-4 col-sm-4  offset-md-4 offset-sm-4">
                        <img style="width:100%" src="/storage/post_images/{{$post->post_image}}">
                    </div>
                </div>
                <br><br>
            @endif
            

            <div class="text-justify">
                {!!$post->body!!}
            </div>
            
            
            <small class="post-tag">Created on: {{$post->created_at}} by <strong>{{$post->user->name}}</strong> on <strong>{{$post->category->name}}</strong> category</small>

            <br>
            <table class="table text-center category-table" data-toggle="dataTable" data-form="deleteForm">
                <tr>
                    @if(!Auth::guest())
                        @if(Auth::user()->id == $post->user_id)
                            <td>
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit post</a>
                            </td>
                            <td>
                                {!! Form::model($post, ['method' => 'delete', 'route' => ['posts.destroy', $post->id], 'class' =>'form-delete']) !!}
                                {!! Form::hidden('id', $post->id) !!}
                                {!! Form::submit(trans('Delete'), ['class' => 'btn btn-danger delete', 'name' => 'delete_modal']) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                    @endif
                </tr>
            </table>
        </div>
    </div>        
    <br>

    <div class="card">
        <div class="card-body">
            
            <h5><strong>Comments</strong></h5>
            @if(count($post->comments) > 0)
                @foreach($post->comments as $comment)
                    <div class="list-group">
                        <li class="list-group-item">
                            <p>{{$comment->body}}</p>
                            <small class="post-tag">by <em>{{$comment->name}}</em> on {{$comment->created_at}}</small>
                        </li>    
                    </div>
                @endforeach
            @else
                 <div class="list-group">
                    <li class="list-group-item">
                        <em>No comments to display.</em>
                    </li>    
                </div>
                
            @endif
                
            <hr>
            <h5><strong>Add comment</strong></h5>
            <br>
            {!!Form::open(['action' => 'CommentsController@store', 'method' => 'POST' ])!!}
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'enter comment...'  ])}}
                </div>
                <div class="form-group">
                        {{Form::label('email', 'Email')}}
                        {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'enter email...'  ])}}
                    </div>
                <div class="form-group">
                    {{Form::label('body', 'Comment')}}
                    {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'enter comment...', 'size' => '2x2' ])}}
                </div>
                {{Form::hidden('post_id', $post->id)}}
                <br>
                {{Form::submit('Submit post', ['class' => 'btn btn-primary'])}}
            {!!Form::close()!!}
        </div>
    </div>

@endsection

