<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.app');
    }

    public function students()
    {

        $data = Cache::remember('students', now()->addHours(1), function() {
            
            $enrolments = Enrolment::current()->get();

            $collection = collect([]);

            foreach($enrolments as $enrolment){

                $student = new Student;

                $student->student_number = $enrolment->student->stud_id;
                $student->name = $enrolment->student->fullname;
                $student->program = $enrolment->program->program_code;
                $student->rle = $this->get_rle($enrolment)->sum('units');

                $collection->push($student);
            }

            return $collection;
        });

        return view('students', compact('data'));
    }
}