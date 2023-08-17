<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    public function index()
    {
        $data = array("students" => DB::table('students')->orderBy('created_at', 'desc')->Paginate(10)); //or simplePaginate()
        return view('students.index', $data);

        //$data = Students::all();
        // $data = Students::where('id', 3)->get();
        // $data = Students::where('first_name', 'like',  '%ly%')->get();

        // $data = Students::where('age', '<=',  '19')->orderBy('first_name', 'asc')->
        // limit(5)->get();

        // $data = DB::table('students')
        //         ->select(DB::raw('count(*) as gender_count, gender
        //         '))->groupBy('gender')->get();

        // $data = Students::where('id', 50)->firstOrFail()->get();

        // return view('students.index', ['students' => $data]);
        
    }

    public function show($id){
        $data = Students::findorFail($id);
        // dd($data);
        return view('students.edit', ['student' => $data]);
    }


    public function create(){
        return view('students.create')->with('title', 'Add New');
    }

    public function store(Request $request){

          $validated = $request->validate([
            "first_name" => ['required'],
            "last_name" => ['required'],
            "gender" => ['required', 'min:4'],
            "age" => ['required'],
            "email" => ['required', 'email', Rule::unique('students', 'email')],
 
        ]);

        if($request->hasFile('student_image')){

            $request->validate([
                "student_image" => 'mimes:jpeg,jpg,png,bmp,tiff.webp |max:4096'
            ]);

            $filenameWithExtension = $request->file("student_image");
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("student_image")->getClientOriginalExtension();

            $filenameToStore = $filename .'_'.time().'.'.$extension;

            $smallThumbnail = $filename .'_'.time().'.'.$extension;

            $request->file('student_image')->storeAs('public/student', $filenameToStore);

            $request->file("student_image")->storeAs('public/student/thumbnail', $smallThumbnail);

            $thumbnail = 'storage/student/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbnail, 150, 93);

            $validated['student_image'] = $filenameToStore;

        }
        
        Students::create($validated);

        return redirect('/')->with('message', 'New Student was added successfully!');
    }

    public function update(Request $request, Students $student){
        //   dd($request);
        $validated = $request->validate([
            "first_name" => ['required'],
            "last_name" => ['required'],
            "gender" => ['required', 'min:4'],
            "age" => ['required'],
            "email" => ['required', 'email'],
 
        ]);

      

        if($request->hasFile('student_image')){

            $request->validate([
                "student_image" => 'mimes:jpeg,jpg,png,bmp,tiff.webp |max:4096'
            ]);

            $filenameWithExtension = $request->file("student_image");
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("student_image")->getClientOriginalExtension();

            $filenameToStore = $filename .'_'.time().'.'.$extension;

            $smallThumbnail = $filename .'_'.time().'.'.$extension;

            $request->file('student_image')->storeAs('public/student', $filenameToStore);

            $request->file("student_image")->storeAs('public/student/thumbnail', $smallThumbnail);

            $thumbnail = 'storage/student/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbnail, 150, 93);

            $validated['student_image'] = $filenameToStore;

        }
         $student->update($validated);

         return back()->with('message', 'Data was successfully updated');
       

    }

    public function createThumbnail($path, $width, $height){

        $img = Image::make($path)->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        });
        $img->save($path);

    }
    
    public function destroy(Students $student){
        // dd($request);
        $student->delete();
        return redirect('/')->with('message', 'Data was successfully deleted');
    }

}