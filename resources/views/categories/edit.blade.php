@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <h3>Update category</h3>
                    <hr><br>

                    {!!Form::open(['action' => ['CategoriesController@update', $category->id ], 'method' => 'POST' ])!!}
                        <div class="form-group">
                            {{Form::label('name', 'Category name:')}}
                            {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'category name...'  ])}}
                        </div>
                        <br>
                        
                        <!-- spoof put request -->
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Submit category', ['class' => 'btn btn-primary'])}}
                    {!!Form::close()!!}

                </div>
            </div>
        </div>
    </div>                

@endsection