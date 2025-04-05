<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\ExpensePage;
use App\Livewire\CreateExpense;
use App\Livewire\EditExpense;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    // routes/web.php
    Route::prefix('expenses')->group(function () {
        Route::get('/', ExpensePage::class)->name('expenses.index');
        Route::get('/create', CreateExpense::class)->name('expenses.create');
        Route::delete('/{id}', ExpensePage::class)->name('expenses.delete');


        Route::get('/{id}/edit', EditExpense::class)->name('expenses.edit');
        
    });
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
