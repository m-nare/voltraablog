@extends('layouts.app')

@section('content')

    <h2 ><strong>Latest Posts</strong></h2>
	<hr><br><br>
	
    @if(count($posts)>0)
		@foreach($posts as $post)
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
						<a class="btn btn-primary" href="/posts/{{$post->id}}">Read More</a>
					</div>
				</div>
			</div>
			</div>
			<br><br>
		@endforeach
		{{$posts->links()}}
	@else
		<p>No posts found</p>
	@endif
@endsection