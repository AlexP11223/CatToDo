<div class="todo-list list-group">
    @foreach ($tasks as $task)
        <a href="#" class="todo-item list-group-item list-group-item-action" data-id="{{ $task->id }}">
            <div class="d-flex align-items-center">
                <div class="todo-checkbox align-self-stretch d-flex align-items-center">
                    <div class="custom-control-lg custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="{{ $name }}taskCheckbox{{ $loop->iteration }}"@if ($task->completed) checked @endif>
                        <label class="custom-control-label" for="{{ $name }}taskCheckbox{{ $loop->iteration }}"></label>
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
