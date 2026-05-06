<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes AKWABA
|--------------------------------------------------------------------------
| Les routes sont dissociées par domaine pour une meilleure clarté.
*/

Route::prefix('v1')->group(function () {

    // Routes Joueurs
    require __DIR__ . '/v1/player.php';

    // Routes Administration
    require __DIR__ . '/v1/admin.php';

});
