@extends('layouts.app')


@section('content')

    <h2><strong>Categories</strong></h2>
    <hr><br><br>

    @if(count($categories)>0)
        <div class="list-group">
        @foreach($categories as $category)
            <div class="list-group-item">    
                <h3><a href="/categories/{{$category->id}}">{{$category->name}}</a></h3>
                <small class="post-tag">Created on: <em>{{$category->created_at}}</em> by <strong>{{$category->user->name}}</strong></small>        
            </div>
            <br><br>
        @endforeach
        </div>
    @else
        <p>No posts found</p>
    @endif

@endsection