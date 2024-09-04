<?php
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/projects',[ProjectController::class,'index'])->name('projects.index');
Route::get('add-projects',[ProjectController::class,'add_Project_Page'])->name('project-add');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::delete('/del-project/{id}',[ProjectController::class,'delete'])->name('project.destroy');
Route::get('edit-project/{id}',[ProjectController::class,'edit'])->name('project.edit');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::get('/view-project/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/project-assign-records', [ProjectController::class, 'empProjectRecords'])->name('Project.record');


