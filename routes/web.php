<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureFullContentAccess;
use App\Http\Middleware\EnsureSuperAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profile'])->name('profile');

// Services (Layanan Divisi)
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/layanan/{slug}', [HomeController::class, 'serviceDetail'])->name('services.detail');

// News & Announcements
Route::get('/berita', [HomeController::class, 'posts'])->name('posts');
Route::get('/berita/{slug}', [HomeController::class, 'postDetail'])->name('posts.detail');

// Events / Agenda
Route::get('/agenda', [HomeController::class, 'events'])->name('events');
Route::get('/agenda/{slug}', [HomeController::class, 'eventDetail'])->name('events.detail');

// Documents & Downloads
Route::get('/unduhan', [HomeController::class, 'documents'])->name('documents');
Route::get('/unduhan/download/{id}', [HomeController::class, 'downloadDocument'])->name('documents.download');

// Gallery
Route::get('/galeri', [HomeController::class, 'galleries'])->name('galleries');

// Custom Dynamic Pages
Route::get('/halaman/{slug}', [HomeController::class, 'page'])->name('page');

// Contact & Message
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak/kirim', [HomeController::class, 'sendMessage'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Secret Slug: /sugar only + Aliases)
|--------------------------------------------------------------------------
*/
Route::get('/sugar', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/sugar', [AuthController::class, 'login'])->name('admin.login.submit');
Route::get('/login', fn() => redirect()->route('admin.login'));
Route::get('/admin/login', fn() => redirect()->route('admin.login'));
Route::post('/admin/login', [AuthController::class, 'login']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | Protected Admin Routes
    |----------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile & Password (All authenticated users)
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

        /*
        |------------------------------------------------------------------
        | Super Admin Exclusive Routes (Settings, Preset Switcher & Kelola Admin)
        |------------------------------------------------------------------
        */
        Route::middleware(EnsureSuperAdmin::class)->group(function () {
            // Settings & Preset Switcher (Super Admin Only)
            Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
            Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
            Route::post('/settings/apply-preset', [SettingController::class, 'applyPreset'])->name('settings.preset');

            // User Management / Kelola Akun Admin (Super Admin Only)
            Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);
        });

        /*
        |------------------------------------------------------------------
        | Operational Division Content & Management (Super Admin & Admin)
        |------------------------------------------------------------------
        */
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
        Route::resource('carousels', \App\Http\Controllers\Admin\CarouselController::class);
        Route::post('menus/reset-defaults', [\App\Http\Controllers\Admin\MenuController::class, 'resetDefaults'])->name('menus.reset');
        Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class)->except(['create', 'show']);
        Route::post('services/toggle-module', [ServiceController::class, 'toggleModule'])->name('services.toggle-module');
        Route::resource('services', ServiceController::class);
        Route::post('team/chart', [TeamMemberController::class, 'updateChart'])->name('team.chart.update');
        Route::delete('team/chart', [TeamMemberController::class, 'removeChart'])->name('team.chart.remove');
        Route::resource('team', TeamMemberController::class)->parameters(['team' => 'team']);
        Route::resource('events', EventController::class);
        Route::resource('documents', DocumentController::class);
        Route::resource('galleries', GalleryController::class)->only(['index', 'store', 'destroy']);
        Route::post('pages/upload-asset', [PageController::class, 'uploadAsset'])->name('pages.uploadAsset');
        Route::get('pages/{page}/builder', [PageController::class, 'builder'])->name('pages.builder');
        Route::post('pages/{page}/builder', [PageController::class, 'saveBuilder'])->name('pages.builder.save');
        Route::resource('pages', PageController::class);
        Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    });
});

/*
|--------------------------------------------------------------------------
| Storage Asset Fallback Route (Khusus Shared Hosting / cPanel)
|--------------------------------------------------------------------------
| Jika symlink public/storage di hosting belum dibuat / bermasalah, route ini
| secara otomatis menyajikan file media dari storage/app/public dengan aman.
*/
Route::get('/storage/{path}', function ($path) {
    $basePath = realpath(storage_path('app/public'));
    $targetPath = realpath(storage_path('app/public/' . $path));

    if (!$basePath || !$targetPath || !str_starts_with($targetPath, $basePath) || !file_exists($targetPath)) {
        abort(404);
    }

    if (preg_match('/\.(php[0-9]?|phtml|phar|sh|cgi|pl|py|exe|env|git|sql)$/i', $targetPath)) {
        abort(403);
    }

    return response()->file($targetPath);
})->where('path', '.*');
