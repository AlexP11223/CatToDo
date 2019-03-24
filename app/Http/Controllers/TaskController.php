<?php

namespace App\Http\Controllers;

use App\Category;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
