<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TasksController;

Route::get('/', [TasksController::class, 'show'])->name('home');
Route::get('/addtask', [TasksController::class, 'add'])->name('addtask');
Route::post('/storetask', [TasksController::class, 'store'])->name('storetask');
Route::post('/task_priority_reorder', [TasksController::class, 'priority_reorder'])->name('task_priority_reorder');
Route::get('/task_edit/{id}', [TasksController::class, 'edit'])->name('task_edit');
Route::post('/update_task/{id}', [TasksController::class, 'update'])->name('update_task');


require __DIR__.'/auth.php';