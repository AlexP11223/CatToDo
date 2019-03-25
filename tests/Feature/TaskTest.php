<?php

namespace Tests\Feature;

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
            ->actingAs($this->user2())
            ->get(route('category', ['categoryName' => 'Study']))
            ->assertOk()
            ->assertDontSeeText(self::studyTask1)
            ->assertDontSeeText(self::studyTask2);
    }
}
