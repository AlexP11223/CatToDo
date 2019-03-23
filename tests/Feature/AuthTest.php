<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    private static function defaultPassword() {
        return "pass123";
    }

    public static function logins()
    {
        return [
            ['user'],
            ['alex.pantec@gmail.com']
        ];
    }

    public static function incorrectLoginParameters()
    {
        return array(
            array([]),
            array(['name' => 'user', 'password' => 'incorrect']),
        );
    }

    /** @test
        @dataProvider logins
     */
    public function user_can_log_in($name)
    {
        $this->get('login')->assertOk();

        $this->post('login', ['name' => $name, 'password' => self::defaultPassword()])
            ->assertLocation('/')
            ->assertSessionHasNoErrors();
        $this
            ->get('/')
            ->assertOk()
            ->assertSeeText('Logout');
    }

    /** @test
     *  @dataProvider incorrectLoginParameters
     */
    public function cannot_log_in_without_valid_credentials($params)
    {
        $this->get('login')->assertOk();

        $this->post('login', $params)
            ->assertRedirect('login')
            ->assertSessionHasErrors();
    }
}
