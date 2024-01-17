<?php
// outer loading standard, PSR-4 (PHP Standard Recommendations) >> specific auto-loading classes from file paths
// #include >> namespace + use
namespace App\Http\Controllers; // declare in composer.json

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
