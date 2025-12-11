<?php

use App\Models\User;
use function Pest\Laravel\{get, post};

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
    ]);
});

it('login berhasil dengan kredensial valid', function () {
    $response = post('/login', [
        'email' => 'user@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
});

it('login gagal karena password salah', function () {
    $response = post('/login', [
        'email' => 'user@example.com',
        'password' => 'password-salah',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();
});

it('login gagal karena email tidak terdaftar', function () {
    $response = post('/login', [
        'email' => 'tidakada@example.com',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();
});

it('login gagal karena form kosong', function () {
    $response = post('/login', []);

    $response->assertSessionHasErrors(['email', 'password']);
    $this->assertGuest();
});

it('login berhasil dengan remember me', function () {
    $response = post('/login', [
        'email' => 'user@example.com',
        'password' => 'password',
        'remember' => 'on',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
});
