<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class CareerController extends Controller
{
    public function index()
    {
        return view('hr.careers.index', ['page_title' => 'Careers']);
    }

    public function create(Request $request)
    {

        $data['title'] = 'Add Career';
        $data['departments'] = Department::pluck('name','id');
        $html = view('hr.careers.create', $data)->render();
        return response()->json($html);
    }
}
