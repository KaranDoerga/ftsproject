<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'Gebruiker',
        'email' => 'test@example.com',
        'password' => 'password',
        'adress' => 'Straat 1',
        'postal_code' => '1234 AB',
        'city' => 'Zwolle',
        'role' => 'customer',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
