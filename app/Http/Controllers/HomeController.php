<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class HomeController extends Controller
{
    public function index() {
        $employees = Employees::all();
        return view('home', ['employees' => $employees ]);
    }
}
