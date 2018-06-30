@extends('layouts.app')

@section('content')

    <div class="card bg-light mb-3">
        <div class="card-header text-center"><h5>{{$title}}</h5></div>
        <div class="card-body">
            <p>This is blog web application version {{$version}}</p>
            <br>
            <p>Functionality : </p>
            <br>   
            <div class="row">
                    <div class="col-md-4 col-sm-4">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action" id="list-view-list" data-toggle="list" href="#list-view" role="tab" aria-controls="view">View posts</a>
                        <a class="list-group-item list-group-item-action" id="list-post-list" data-toggle="list" href="#list-post" role="tab" aria-controls="post">Create/Manage Posts</a>
                        <a class="list-group-item list-group-item-action" id="list-categories-list" data-toggle="list" href="#list-categories" role="tab" aria-controls="categories">Create/Manage Categories</a>
                        <a class="list-group-item list-group-item-action" id="list-access-list" data-toggle="list" href="#list-access" role="tab" aria-controls="access">Access control</a>
                      </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" id="list-view" role="tabpanel" aria-labelledby="list-view-list">View all posts created by all users</div>
                        <div class="tab-pane fade" id="list-post" role="tabpanel" aria-labelledby="list-post-list"><p>Create new posts, edit and delete existing posts. User should be registered and logged in.</p></div>
                        <div class="tab-pane fade" id="list-categories" role="tabpanel" aria-labelledby="list-categories-list">Create new categories, edit and delete existing categories. User should be registered and logged in.</div>
                        <div class="tab-pane fade" id="list-access" role="tabpanel" aria-labelledby="list-access-list">Posts/Categories can be edited or deleted by the post/category owner only.</div>
                      </div>
                    </div>
            </div>    

        </div>
    </div>

@endsection
		