<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {

    }
}

$tasks = [
    new Task (
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task (
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task (
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task (
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

/*
 MARK: http verbs
 GET >> fetching website from server
 POST >> store new data / to send form / create sth on the server
 PUT >> to modify an exist thing
 DELETE >> delete data
 HEAD
 OPTIONS
 PATCH
*/

Route::get('/', function () {
    return redirect('') -> route('tasks.index');
});

// access tasks
Route::get('/task', function () use($tasks) {
    return view('index', ['tasks' => $tasks]);
}) -> name('tasks.index');

Route::get('/task/{id}', function ($id) use($tasks) {
    // convert arr to laravel collection obj
    $task = collect($tasks)->firstWhere('id', $id);
    if (!$task) {
        abort(Response::HTTP_NOT_FOUND);
    }
    return view('show', ['task' => $task]);
}) -> name('tasks.show');

// MARK: fallback route = the route that will be called when no other route called is matched
Route::fallBack(function() {
    return 'Fallback route instead of 404';
});

// get URL then run function()
// 1st para = URL pattern
// using use() to access var outside anonymous func
// Route::get('/', function () {
//    return redirect() -> route('hello');
// });
// Route::get('/xxx', function () {
//     return 'Hello';
// // giving the name to route >> hello, changing URL doesn't effect to the route's name
// }) -> name('hello');
// Route::get('/great/{name}', function ($name) {
//     // . >> concat
//     return 'Hello ' . $name . '!';
// });
// // redirect ROUTE
// Route::get('/hallo', function () {
//     // return redirect('/hello');
//     // redirect to route's name instead URL
//     return redirect() -> route('hello');
// });