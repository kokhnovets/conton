<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function successfulRegistrationRoute()
    {
        return route('home');
    }

    protected function registerGetRoute()
    {
        return route('register');
    }

    protected function registerPostRoute()
    {
        return route('register');
    }

    protected function guestMiddlewareRoute()
    {
        return route('home');
    }

    public function testUserCanViewARegistrationForm()
    {
        $response = $this->get($this->registerGetRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function testUserCannotViewARegistrationFormWhenAuthenticated()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get($this->registerGetRoute());

        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    public function testUserCanRegister()
    {
        Event::fake();

        $response = $this->post($this->registerPostRoute(), [
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'email' => 'ivanov@example.com',
            'password' => '123!Asdf1',
            'password_confirmation' => '123!Asdf1',
        ]);

        $response->assertRedirect($this->successfulRegistrationRoute());
        $this->assertCount(1, $users = User::all());
        $this->assertAuthenticatedAs($user = $users->first());
        $this->assertEquals('Иван', $user->first_name);
        $this->assertEquals('Иванов', $user->last_name);
        $this->assertEquals('ivanov@example.com', $user->email);
        $this->assertTrue(Hash::check('123!Asdf1', $user->password));
        Event::assertDispatched(Registered::class, function ($e) use ($user) {
            return $e->user->id === $user->id;
        });
    }

    public function testUserCannotRegisterWithoutName()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'first_name' => '',
            'last_name' => 'Иванов',
            'email' => 'ivanov@example.com',
            'password' => '123!Asdf1',
            'password_confirmation' => '123!Asdf1',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('first_name');
        $this->assertTrue(session()->hasOldInput('last_name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutEmail()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'email' => '',
            'password' => '123!Asdf1',
            'password_confirmation' => '123!Asdf1',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('first_name'));
        $this->assertTrue(session()->hasOldInput('last_name'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithInvalidEmail()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'email' => 'invalid-email',
            'password' => '123!Asdf1',
            'password_confirmation' => '123!Asdf1',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('first_name'));
        $this->assertTrue(session()->hasOldInput('last_name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPassword()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'email' => 'ivanov@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('first_name'));
        $this->assertTrue(session()->hasOldInput('last_name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPasswordConfirmation()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'email' => 'ivanov@example.com',
            'password' => '123!Asdf1',
            'password_confirmation' => '',
        ]);

        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('first_name'));
        $this->assertTrue(session()->hasOldInput('last_name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithPasswordsNotMatching()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'email' => 'ivanov@example.com',
            'password' => '123!Asdf1',
            'password_confirmation' => 'Asdfg123',
        ]);
        $users = User::all();

        $this->assertCount(0, $users);
        $response->assertRedirect($this->registerGetRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('first_name'));
        $this->assertTrue(session()->hasOldInput('last_name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
