@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row h-100">
            <aside class="col-md-3 p-0">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler categories-list-toggler" type="button" data-toggle="collapse"
                            data-target="#categoriesList" aria-controls="categoriesList" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span> <span>{{ $selectedCategory->name }}</span>
                    </button>
                    <div class="collapse navbar-collapse" id="categoriesList">
                        <div class="categories-list list-group">
                            @foreach($categories as $category)
                                <a href="{{ route('category', ['categoryName' => $category->name]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $category->name }}
                                    @if ($category->tasks->count())
                                        <span class="badge badge-pill">{{ $category->tasks->count() }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </nav>
            </aside>
            <main class="col-md-9 py-3">
                <h2 class="d-none d-md-block">{{ $selectedCategory->name }}</h2>
                <form action="{{action('TaskController@store')}}" method="post">
                    @csrf
                    <div class="form-group ">
                        <div>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="row d-flex pt-2">
                            <div class="col-md-3 ml-auto">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Add Task') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    </div>
                </form>
                <div class="todo-list list-group">
                    @foreach ($tasks as $task)
                        <a href="#" class="todo-item list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="todo-checkbox align-self-stretch d-flex align-items-center">
                                    <div class="custom-control-lg custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="taskCheckbox{{ $loop->iteration }}">
                                        <label class="custom-control-label" for="taskCheckbox{{ $loop->iteration }}"></label>
                                    </div>
                                </div>
                                <span class="todo-item-text">{{ $task->description }}</span>
                                @if ($task->category && $selectedCategory->name === 'All')
                                    <span class="badge ml-auto">{{ $task->category->name }}</span>
                                @endif
                            </div>
                            <div class="todo-item-form" style="display: none">
                                <form action="{{action('TaskController@update', ['task' => $task->id])}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control" name="description" value="{{ $task->description }}" required>
                                        </div>
                                        <div class="row d-flex pt-2">
                                            <div class="col-md-3 ml-auto">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form class="pt-4" action="{{action('TaskController@destroy', ['task' => $task->id])}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="form-group row d-flex">
                                        <div class="col-md-3 ml-auto">
                                            <button type="submit" class="btn btn-danger btn-block">
                                                {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            </main>
        </div>
    </div>

    <script>
    </script>
@endsection
