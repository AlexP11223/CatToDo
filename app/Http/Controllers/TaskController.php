<?php

namespace App\Http\Controllers;

use App\Category;
use App\Task;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param string|null $categoryName
     * @return \Illuminate\Http\Response
     */
    public function index($categoryName = null)
    {
        if (!$categoryName) {
            $categoryName = 'All';
        }

        $user = Auth::user();

        // TODO: can be optimized

        $categories = collect([(object) ['name' => 'All', 'tasks' => $user->tasks()]])
            ->concat($user->taskCategories()->get());

        $selectedCategory = $categories->firstWhere('name', $categoryName);
        if (!$selectedCategory) {
            abort(404);
        }

        // quick ugly hack
        $tasks = $selectedCategory instanceof Category ? $selectedCategory->tasks()->get() : $selectedCategory->tasks->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->description = $request['description'];
        $task->user_id = Auth::user()->id;

        $categoryId = $request['categoryId'];
        if ($categoryId) {
            /** @var Category $category */
            $category = Auth::user()->taskCategories()->find($categoryId);
            if (!$category) {
                abort(404);
            }
            $task->category_id = $category->id;
        }

        $task->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            abort(404);
        }

        $task->update([
            'description' => $request['description']
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            abort(404);
        }

        $task->delete();

        return redirect()->back();
    }
}
