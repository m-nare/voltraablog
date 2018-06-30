@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <h3>Update post</h3>
                    <hr><br>

                    {!!Form::open(['action' => ['PostsController@update', $post->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data' ])!!}
                        <div class="form-group">
                            {{Form::label('title', 'Title:')}}
                            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'post title...'  ])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('body', 'Body:')}}
                            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'post body...'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('post_image', 'Post image:')}}
                            <br>    
                            {{Form::file('post_image')}}
                        </div>
                        <div class="form-group">
                                {{Form::label('category_id', 'Category:')}}
                                {{Form::select('category_id', $categories->pluck('name', 'id'), $post->category_id, ['class' => 'form-control'])}}
                        </div>
                        <!-- spoof put request -->
                        {{Form::hidden('_method', 'PUT')}}
                        <br>
                        {{Form::submit('Submit post', ['class' => 'btn btn-primary'])}}
                    {!!Form::close()!!}

                </div>
            </div>
        </div>
    </div>                

@endsection