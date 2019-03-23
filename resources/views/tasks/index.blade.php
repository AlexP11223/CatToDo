@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row h-100">
            <aside class="col-md-3 p-0">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler categories-list-toggler" type="button" data-toggle="collapse"
                            data-target="#categoriesList" aria-controls="categoriesList" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> <span>Main</span>
                    </button>
                    <div class="categories-list list-group collapse navbar-collapse" id="categoriesList">
                        @foreach($categories as $category)
                            <a href="#" class="list-group-item list-group-item-action">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </aside>
            <main class="col-md-9 py-3">
                <h2 class="d-none d-md-block">Main</h2>
                <div class="todo-list list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <div class="todo-checkbox align-self-stretch d-flex align-items-center">
                                <div class="custom-control-lg custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"></label>
                                </div>
                            </div>
                            <span>Link</span>

                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <div class="todo-checkbox align-self-stretch d-flex align-items-center">
                                <div class="custom-control-lg custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2"></label>
                                </div>
                            </div>
                            <span>Link ssssssssssss      xxxxxxxxxxxxs    fc           s    89c9c      ssssssssss sssssssssssssssssssss s              rrrrrrrrr      sssss sssssssssss fsssssssss</span>

                        </div>
                    </a>
                </div>
            </main>
        </div>
    </div>

    <script>
    </script>
@endsection
