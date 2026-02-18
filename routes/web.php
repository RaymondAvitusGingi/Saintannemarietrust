<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductionMigrationController;

// Temporary Production Migration Route
Route::get('/migrate-data/{key}', [ProductionMigrationController::class, 'migrate']);
Route::get('/seed-data/{key}', [ProductionMigrationController::class, 'seedData']);

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/campuses', [PageController::class, 'campuses'])->name('campuses');
Route::get('/campuses/{id}', [PageController::class, 'campusDetail'])->name('campus.detail');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{slug}', [PageController::class, 'newsDetail'])->name('news.show');
Route::get('/academics', [PageController::class, 'academics'])->name('academics');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/gallery/{id}', [PageController::class, 'galleryDetail'])->name('gallery.show');
Route::get('/staff', [PageController::class, 'staff'])->name('staff');
Route::get('/events/json', [PageController::class, 'eventsJson'])->name('events.json');
Route::get('/administration', [PageController::class, 'administration'])->name('administration');
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);

// Admin Authentication Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // News Management
    Route::resource('news', NewsController::class)->except(['show']);
    
    // Event Calendar Management
    Route::get('events/calendar', [EventController::class, 'calendar'])->name('events.calendar');
    Route::get('events/json', [EventController::class, 'eventsJson'])->name('events.json.admin');
    Route::resource('events', EventController::class)->except(['show']);
    
    // Gallery Management
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::patch('gallery/{galleryImage}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/{galleryImage}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::post('gallery/bulk-delete', [GalleryController::class, 'bulkDelete'])->name('gallery.bulkDelete');
    Route::post('gallery/reorder', [GalleryController::class, 'reorder'])->name('gallery.reorder');

    // Campus Management
    Route::resource('campuses', CampusController::class)->only(['index', 'edit', 'update']);
    Route::post('campuses/reorder', [CampusController::class, 'reorder'])->name('campuses.reorder');

    // Staff Management
    Route::resource('staff', StaffController::class)->except(['show']);
    Route::post('staff/reorder', [StaffController::class, 'reorder'])->name('staff.reorder');

    // Site Settings (Contact, Academics)
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');
});
