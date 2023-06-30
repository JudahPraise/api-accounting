<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Enrolment;
use App\Models\CashierFee;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use App\Classes\StudentClass;
use App\Classes\ScheduleClass;
use App\Models\CashierFeeType;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Assessment\AssessmentController;

class ViewController extends Controller
{
    public function setPage(Request $request)
    {
        switch ($request->page) {
            case 'dashboard':
                return view('dashboard.index')->render();

            case 'fees':
                return view('fees.index')->render();

            case 'assessment':
                return view('assessment.index')->render();

            case 'student':
                $enrolment = Enrolment::with('student')->where('stud_id', decrypt($request->id))->current()->first();
                $schedules = ScheduleClass::getStudentSchedules($enrolment);
                $fees = $this->getFees($enrolment);

                $fee_types = CashierFeeType::whereIn('fee_type_id', $fees->pluck('fee_type_id'))->get();

                return view('assessment.student', compact('enrolment', 'schedules', 'fees', 'fee_types'))->render();

            case 'report':
                return view('report.index')->render();
                
            case 'user-management':

                break;
            case 'automated-assessment':
                $programs = Program::where('is_active', 1)->select('program_code', 'program_id')->get();
                return view('assessment.auto-assessment', compact('programs'));
                break;
            case 'generate':
                $programs = Program::where('is_active', 1)->select('program_code', 'program_id')->get();
                return view('assessment.generate', compact('programs'));
                break;
            default:
                # code...
                break;
        }
    }

    public function redirectDefaultPage(){
        return view('layouts.app');
    }
}
