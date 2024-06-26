<?php

use App\Http\Controllers\Attachmetns\ImageAttachmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Clans\ClanController;
use App\Http\Controllers\Hero\HeroController;
use App\Http\Controllers\Items\ItemController;
use App\Http\Controllers\Maps\MapController;
use App\Http\Controllers\NPC\NpcController;
use App\Http\Controllers\Quests\QuestController;
use App\Http\Controllers\Resources\ResourceController;
use App\Http\Controllers\Resources\ResourceTypeController;
use App\Http\Controllers\Skills\SkillController;
use App\Http\Controllers\Tiles\TileController;
use App\Http\Controllers\Upload\ExcelController;
use App\Http\Controllers\Upload\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
dispatch(new \App\Jobs\BanJob());
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'exception']], function(){

    //users
    Route::post('/user/banned', [UserController::class, 'banned']);
    Route::post('/user/unbanned', [UserController::class, 'unbanned']);
    Route::resource('/user', UserController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/excel/upload', [ExcelController::class, 'upload']);

    //images
    Route::post('/image/upload', [UploadController::class, 'upload']);
    Route::get('/images', [UploadController::class, 'index']);
    Route::delete('/images', [UploadController::class, 'destroy']);

    //heroes
    Route::delete('/hero', [HeroController::class, 'destroy']);
    Route::resource('/hero', HeroController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    //maps
    Route::delete('/maps', [MapController::class, 'destroy']);
    Route::resource('/maps', MapController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    //tiles
    Route::delete('/tile', [TileController::class, 'destroy']);
    Route::resource('/tile', TileController::class)
        ->only([
            'store',
            'index',
            'update',
            'show',
        ]);

    //image attachment detachable
    Route::post('/{entity}/{entityId}/attachment/{imageId}', [ImageAttachmentController::class, 'attachment']);
    Route::post('/{entity}/{entityId}/detachable', [ImageAttachmentController::class, 'detachable']);

    //resources
    Route::resource('/resource-type', ResourceTypeController::class)
    ->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    //resources-types
    Route::delete('/resource', [ResourceController::class, 'destroy']);
    Route::resource('/resource', ResourceController::class)->only([
        'store',
        'index',
        'update',
        'show',
    ]);

    //items
    Route::delete('/item', [ItemController::class, 'destroy']);
    Route::resource('/item', ItemController::class)->only([
        'store',
        'index',
        'update',
        'show'
    ]);
    //skills
    Route::delete('/skill', [SkillController::class, 'destroy']);
    Route::resource('/skill', SkillController::class)->only([
       'store',
       'index',
       'update',
       'show'
    ]);

    //npc-s
    Route::delete('/npc', [NpcController::class, 'destroy']);
    Route::resource('/npc', NpcController::class)
        ->only([
            'store',
            'index',
            'show',
            'update',
        ]);

    //quests
    Route::delete('/quest', [QuestController::class, 'destroy']);
    Route::resource('/quest', QuestController::class)
    ->only([
        'store',
        'index',
        'show',
        'update',
    ]);


    //clans
    Route::delete('/clans', [ClanController::class, 'destroy']);
    Route::resource('/clans', ClanController::class)
        ->only([
            'store',
            'index',
            'show',
            'update',
        ]);

});


