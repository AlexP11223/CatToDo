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
                                    @if ($category->activeTasks->count())
                                        <span class="badge badge-pill">{{ $category->activeTasks->count() }}</span>
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
                    @if ($selectedCategory->name !== 'All')
                        <input type="hidden" name="categoryId" value="{{ $selectedCategory->id }}">
                    @endif
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

                @include('tasks.tasklist', ['tasks' => $activeTasks, 'name' => ''])

                @if ($completedTasks->count())
                    <button class="btn btn-block btn-success mt-4 mb-2 text-left" id="completedTasksToggler" type="button" data-toggle="collapse" data-target="#completedTasks" aria-expanded="false" aria-controls="completedTasks">
                        Show {{ $completedTasks->count() }} completed @if ($completedTasks->count() > 1)tasks  @else task @endif
                    </button>

                    <div class="collapse" id="completedTasks">
                        @include('tasks.tasklist', ['tasks' => $completedTasks, 'name' => 'completed'])
                    </div>
                @endif
            </main>
        </div>
    </div>

    <div class="modal fade" id="taskCompletedDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h2 class="modal-title">Good job!</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="https://cdn2.thecatapi.com/images/MTg4MDU1Ng.jpg" alt="cat image"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Continue (<span class="dialog-close-counter">15</span>)</button>
                </div>
            </div>
        </div>
    </div>
@endsection
