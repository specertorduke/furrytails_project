<?php

use Illuminate\Support\Facades\Route;

it('registers the public guest routes', function () {
    expect(Route::has('home'))->toBeTrue()
        ->and(Route::has('login'))->toBeTrue()
        ->and(Route::has('signup'))->toBeTrue();
});

it('registers the main dashboard routes', function () {
    expect(Route::has('dashboard'))->toBeTrue()
        ->and(Route::has('admin.dashboard'))->toBeTrue()
        ->and(route('home', absolute: false))->toBe('/')
        ->and(route('login', absolute: false))->toBe('/login');
});
