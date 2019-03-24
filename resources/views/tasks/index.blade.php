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
                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                @if ($category->tasks->count())
                                    <span class="badge badge-pill">{{ $category->tasks->count() }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </nav>
            </aside>
            <main class="col-md-9 py-3">
                <h2 class="d-none d-md-block">Main</h2>
                <div class="todo-list list-group">
                    @foreach ($tasks as $task)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div class="todo-checkbox align-self-stretch d-flex align-items-center">
                                    <div class="custom-control-lg custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="taskCheckbox{{ $loop->iteration }}">
                                        <label class="custom-control-label" for="taskCheckbox{{ $loop->iteration }}"></label>
                                    </div>
                                </div>
                                <span>{{ $task->description }}</span>
                                <span class="badge ml-auto">{{ $task->category->name }}</span>
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
