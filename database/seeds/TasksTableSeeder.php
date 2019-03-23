<?php

use App\Category;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $categories = $user->taskCategories()->get();
        $categoryNameIdMap = $categories->mapWithKeys(function (Category $category) {
            return [$category->name => $category->id];
        });

        Task::firstOrCreate([
            'description' => 'Learn how to code',
            'category_id' => $categoryNameIdMap['Study']]);
        Task::firstOrCreate([
            'description' => 'Install Linux',
            'category_id' => $categoryNameIdMap['Study']]);
        Task::firstOrCreate([
            'description' => 'Buy milk',
            'category_id' => $categoryNameIdMap['Home']]);
        Task::firstOrCreate([
            'description' => 'Ask for a pay rise',
            'category_id' => $categoryNameIdMap['Work']]);
    }
}
