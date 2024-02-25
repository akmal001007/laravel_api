<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
// use Dotenv\Validator;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Validator;

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

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email'

        ]);

        if ($validator->fails()) {

            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];

            return response()->json($data, 422);
        } else {
            $student = new Student;

            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            $data = [
                'status' => 200,
                'message' => 'data uploaded successfully'
            ];

            return response()->json($data, 200);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email'

        ]);

        if ($validator->fails()) {

            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];

            return response()->json($data, 422);
        } else {
            $student = Student::find($id);

            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            $data = [
                'status' => 200,
                'message' => 'data updated successfully'
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id)
    {
        $student = Student::find($id);

        $student->delete();

        $data = [
            'status' => 200, 
            'message' => "data deleted successfully"
        ];
        return response()->json($data, 200);
    }
}
