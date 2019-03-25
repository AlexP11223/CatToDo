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
        $user = User::whereName('user')->first();
        $categories = $user->taskCategories()->get();
        $categoryNameIdMap = $categories->mapWithKeys(function (Category $category) {
            return [$category->name => $category->id];
        });

        Task::firstOrCreate([
            'description' => 'Learn how to code',
            'user_id' => $user->id,
            'category_id' => $categoryNameIdMap['Study']]);
        Task::firstOrCreate([
            'description' => 'Install Linux',
            'user_id' => $user->id,
            'category_id' => $categoryNameIdMap['Study']]);
        Task::firstOrCreate([
            'description' => 'Buy milk',
            'user_id' => $user->id,
            'category_id' => $categoryNameIdMap['Home']]);
        Task::firstOrCreate([
            'description' => 'Ask for a pay rise',
            'user_id' => $user->id,
            'category_id' => $categoryNameIdMap['Work']]);
    }
}
