<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\OrderController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Course; 

// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::redirect('/', '/admin/courses')->name('admin.dashboard');
//     Route::resource('courses', AdminCourseController::class)->names('admin.courses');
//     Route::resource('categories', AdminCategoryController::class)->names('admin.categories')->except('destroy');
// });

// Route::prefix('admin')->group(function () {
//     Route::redirect('/', '/admin/courses')->name('admin.dashboard');
//     Route::resource('courses', AdminCourseController::class)->names('admin.courses');
//     Route::resource('categories', AdminCategoryController::class)->names('admin.categories')->except('destroy');
// });

Route::prefix('admin')->group(function () {
    Route::get('users/export', [AdminUserController::class, 'exportCsv'])->name('admin.users.export');

    Route::redirect('/', '/admin/users')->name('admin.index');
    Route::resource('users', AdminUserController::class)->names('admin.users')->except('show');
    Route::resource('courses', AdminCourseController::class)->names('admin.courses')->except('show');
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories')->except(['show', 'destroy']);
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::view('/teams', 'teams')->name('teams');

// Public VNPAY return endpoint (gateway redirect may land here without auth)
Route::get('/return-vnpay', [VNPayController::class, 'return'])->name('vnpay.return.public');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/filter', [CategoryController::class, 'filter'])->name('category.filter');

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{course}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/buy/{course}', [CartController::class, 'buy'])->name('cart.buy');
    Route::delete('/cart/{course}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.create-payment');
    Route::get('/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
    Route::get('/course/{id}/learn', [CourseController::class, 'startLearning'])->name('course.learn');
    Route::get('/profile/course', [CourseController::class, 'index'])->name('course.index');

    Route::post('paypal/payment', [PayPalController::class, 'createPayment'])->name('paypal.create');
    Route::get('paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
    Route::get('paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');
});

// Newsletter subscription route removed

// Route::post('/vnpay/ipn', [VNPayController::class, 'ipn'])->name('vnpay.ipn');
//GET ERROR WHEN PLACING THESE ROUTE
// Route::middleware(['auth'])->group(function () {
//     Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.create-payment');
//     Route::get('/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
// });

// Route::get('/course/{course_id}', [CourseController::class, 'show'])->name('course.show');
Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
require __DIR__ . '/auth.php';
Route::get('/courses/search', [CourseController::class, 'search'])->name('course.search');

Route::get('/sitemap.xml', function () {
    // 1. Khởi tạo sitemap
    $sitemap = Sitemap::create();

    // 2. Thêm các trang tĩnh
    $sitemap->add(Url::create('/'));
    $sitemap->add(Url::create('/about'));
    $sitemap->add(Url::create('/contact'));

    // 3. Thêm các trang động (Khóa học/Sản phẩm) từ Database
    $courses = Course::all();
    foreach ($courses as $course) {
        // Lưu ý: url phải là đường dẫn đầy đủ
        $sitemap->add(Url::create("/course/{$course->slug}"));
    }

    // 4. Trả về file xml
    return $sitemap->toResponse(request());
});