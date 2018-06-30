@extends('layouts.app')

@section('content')

  <div class="jumbotron text-center">
    <h4 class="display-4"><h4>{{$title}}</h4></h4>
    <p class="lead"><a href="/posts">View latest posts.</a></p>
    <hr class="my-4">
    @guest
      <p>Login to create a new post or Register if not already a member.</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
        <a class="btn btn-info btn-lg" href="/register" role="button">Register</a>
      </p>
    @else
    <p>View latest posts or create a new post.</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="/posts" role="button"><i class="fa fa-file-text-o"></i>Blog</a>
      <a class="btn btn-info btn-lg" href="/posts/create" role="button">Create post</a>
    </p>
    @endguest

  </div>

@endsection