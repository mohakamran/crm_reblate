<?php
use App\Http\Controllers\TaskController;
    // tasks
    Route::get('/create-new-task',[TaskController::class,'index'])->middleware('TasksCheck');
    Route::get('/view-tasks',[TaskController::class,'viewTasks'])->middleware('TasksCheck');
    Route::post('/add-new-task',[TaskController::class,'addNewTask'])->middleware('TasksCheck');
    Route::post('/search-emp-tasks',[TaskController::class,'searchEmpAttendenceAdmin'])->middleware('TasksCheck');
    Route::get('/view-tasks-employees/{id}', [TaskController::class, 'viewTaskEachEmployee'])->middleware('TasksCheck');
    Route::get('/update-tasks/{id}', [TaskController::class, 'updateTaskEachEmployee'])->middleware('TasksCheck');
    Route::post('/update-each-task', [TaskController::class, 'updateEachTask'])->middleware('TasksCheck');
    Route::post('/update-each-task-emp', [TaskController::class, 'updateEachTaskEmp']);
    Route::get('/view-emp-tasks-each', [TaskController::class, 'employeeCanSeeTask']);
    // task side of employee/ manager
    Route::get('/task-update/{id}',[TaskController::class, 'taskUpdateForm']);
    Route::post('/task-save-update/{id}',[TaskController::class, 'taskUpdateDatabase']);
    Route::post('/save_task_database',[TaskController::class, 'taskSaveDatabase']);
    Route::post('/search-emp-tasks-date',[TaskController::class, 'searchTaskMonth']);
    Route::get('/del-task/{id}',[TaskController::class, 'deleteTask']);
    Route::any('/update-task', [TaskController::class, 'updateTask']);
    Route::any('/update-task-status', [TaskController::class, 'updateTaskEmp']);
    Route::any('/create-task-by-emp', [TaskController::class, 'createTaskByEmp']);
    Route::any('/update-task-to-do', [TaskController::class, 'updateToDoTaskEmp']);

