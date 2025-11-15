<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
use App\Http\Controllers\LeverancierController;

Route::get('/leveranciers', [LeverancierController::class, 'index'])
    ->name('leveranciers.index');

Route::get('/leveranciers/{leverancier}', [LeverancierController::class, 'showProducts'])
    ->name('leveranciers.producten');

    Route::get('/leveranciers/{leverancier}/producten', 
    [LeverancierController::class, 'showProducts'])
    ->name('leveranciers.producten');

Route::get('/leveringen/nieuw', [LeverancierController::class, 'createLevering'])
    ->name('leveringen.create');

Route::post('/leveringen/opslaan', [LeverancierController::class, 'storeLevering'])
    ->name('leveringen.store');
Route::get('/leveringen/nieuw', [LeverancierController::class, 'createLevering'])
    ->name('leveringen.create');
