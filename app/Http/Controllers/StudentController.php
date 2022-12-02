<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;

class StudentController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = "<button class='btn btn-sm btn-danger deleteStudent' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('students');
    }

    public function deleteStudent(Request $request){

        ## Read POST data
        $id = $request->post('id');

        $empdata = Student::find($id);

        if($empdata->delete()){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully'; 
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response); 
    }
}
