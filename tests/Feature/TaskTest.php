<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    const homeTask = 'Buy milk';
    const studyTask1 = 'Learn how to code';
    const studyTask2 = 'Install Linux';

    /** @test
     */
    public function user_sees_all_tasks()
    {
        $this
            ->actingAs($this->user())
            ->get('/')
            ->assertOk()
            ->assertSeeText(self::homeTask)
            ->assertSeeText(self::studyTask1)
            ->assertSeeText(self::studyTask2);
    }

    /** @test
     */
    public function user_sees_category_tasks()
    {
        $this
            ->actingAs($this->user())
            ->get(route('category', ['categoryName' => 'Study']))
            ->assertOk()
            ->assertDontSeeText(self::homeTask)
            ->assertSeeText(self::studyTask1)
            ->assertSeeText(self::studyTask2);
    }

    /** @test
     */
    public function user_cannot_see_other_user_tasks()
    {
        $this
            ->actingAs($this->user2())
            ->get('/')
            ->assertOk()
            ->assertDontSeeText(self::homeTask)
            ->assertDontSeeText(self::studyTask1)
            ->assertDontSeeText(self::studyTask2);
        $this
            ->get(route('category', ['categoryName' => 'Study']))
            ->assertOk()
            ->assertDontSeeText(self::studyTask1)
            ->assertDontSeeText(self::studyTask2);
    }

    /** @test
     */
    public function user_can_edit_task()
    {
        $this
            ->actingAs($this->user())
            ->get('/')
            ->assertOk()
            ->assertSeeText(self::studyTask1)
            ->assertSeeText(self::studyTask2);

        $taskId = Task::whereDescription(self::studyTask2)->first()->id;

        $this
            ->put("tasks/$taskId", ['description' => 'Install MacOS'])
            ->assertRedirect('/')
            ->assertSessionHasNoErrors();

        $this
            ->get('/')
            ->assertOk()
            ->assertDontSeeText(self::studyTask2)
            ->assertSeeText(self::studyTask1)
            ->assertSeeText('Install MacOS');
    }

    /** @test
     */
    public function user_cannot_edit_other_user_task()
    {
        $this
            ->actingAs($this->user2())
            ->get('/')
            ->assertOk();

        $taskId = Task::whereDescription(self::studyTask2)->first()->id;

        $this
            ->put("tasks/$taskId", ['description' => 'Install MacOS'])
            ->assertNotFound();
    }

    /** @test
     */
    public function user_can_delete_task()
    {
        $this
            ->actingAs($this->user())
            ->get('/')
            ->assertOk()
            ->assertSeeText(self::studyTask1)
            ->assertSeeText(self::studyTask2);

        $taskId = Task::whereDescription(self::studyTask2)->first()->id;

        $this
            ->delete("tasks/$taskId")
            ->assertRedirect('/')
            ->assertSessionHasNoErrors();

        $this
            ->get('/')
            ->assertOk()
            ->assertDontSeeText(self::studyTask2)
            ->assertSeeText(self::studyTask1);
    }

    /** @test
     */
    public function user_cannot_delete_other_user_task()
    {
        $this
            ->actingAs($this->user2())
            ->get('/')
            ->assertOk();

        $taskId = Task::whereDescription(self::studyTask2)->first()->id;

        $this
            ->delete("tasks/$taskId")
            ->assertNotFound();
    }
}
