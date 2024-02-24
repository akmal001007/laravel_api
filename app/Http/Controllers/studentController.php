<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class studentController extends Controller
{
    public function index()
    {
        $student = student::all();

        $data = [
            'status' => 200,
            'student' => $student
        ];

        return response()->json($data, 200);
    }
}
