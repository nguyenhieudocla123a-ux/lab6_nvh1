<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Bài 2.1: Route /home
Route::get('/home', function () {
    return 'Chào mừng đến với Laravel';
});
// Bài 2.2: Route /about
Route::get('/about', function () {
    return 'Họ tên: Nguyễn Văn Quang<br>Lớp: 23810310108<br>MSSV: 2024001';
});
Route::get('/contact', function () {
    return view('contact');
});
// Bài 3.1: Route tính tổng
Route::get('/tong/{a}/{b}', function ($a, $b) {
    $tong = $a + $b;
    return "Tổng của $a và $b là: $tong";
});
// Bài 3.2: Route thông tin sinh viên
Route::get('/sinh-vien/{name}/{age?}', function ($name, $age = 20) {
    return "Tên: $name<br>Tuổi: $age";
});
// Bài 4.1: Route group admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Chào mừng Admin';
    });
    
    Route::get('/users', function () {
        return 'Danh sách người dùng';
    });
});
// Bài 4.2: Route kiểm tra ngày tháng
Route::get('/check-date/{day}/{month}/{year}', function ($day, $month, $year) {
    // Kiểm tra định dạng
    if ($day < 1 || $day > 31) {
        return "Ngày không hợp lệ (1-31)";
    }
    
    if ($month < 1 || $month > 12) {
        return "Tháng không hợp lệ (1-12)";
    }
    
    if (!preg_match('/^\d{4}$/', $year)) {
        return "Năm phải có 4 chữ số";
    }
    
    // Kiểm tra ngày tháng hợp lệ
    if (!checkdate($month, $day, $year)) {
        return "Ngày tháng không hợp lệ (VD: 31/2 không tồn tại)";
    }
    
    return "Ngày $day/$month/$year hợp lệ!";
})->where([
    'day' => '[0-9]+',
    'month' => '[0-9]+', 
    'year' => '[0-9]{4}'
]);