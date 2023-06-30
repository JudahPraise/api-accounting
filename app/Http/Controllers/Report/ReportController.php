<?php

namespace App\Http\Controllers\Report;

use App\Models\Student;
use App\Models\Enrolment;
use App\Models\CashierFee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\StudentClass;
use Spatie\Excel\Writer\Xlsx;
use App\Models\CashierFeeType;
use App\Http\Controllers\Controller;
use Spatie\Excel\Reader\Xlsx as Reader;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ReportController extends Controller
{
    public function form2(){
        set_time_limit(0);

        $enrolments = Enrolment::where('program_id', 2)->where('isassessed', 1)->current()->get();

        $fee_type_ids = CashierFee::where([['type', 1], ['is_unifast', 1]])->pluck('fee_type_id');
        $fee_types = CashierFeeType::whereIn('fee_type_id', $fee_type_ids)->select('fee_type_id', 'name')->orderBy('sequence', 'asc')->get();
        $file_reader = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('form2.xlsx'));
        $active_sheet = $file_reader->getActiveSheet();

        $row_count = 4;
        $sequence_number = 0;
        
        foreach($enrolments as $enrolment){ 
            $total_tosf = 0; 
            if($enrolment->student->unifast_collection){
                if($enrolment->student->has_unifast){
                    
                    $sequence_number += 1;
                    $active_sheet->setCellValue('A'.$row_count, $sequence_number);
                    $active_sheet->setCellValue('B'.$row_count, $enrolment->stud_id);
                    $active_sheet->setCellValue('C'.$row_count, $enrolment->student->LRN);
                    $active_sheet->setCellValue('D'.$row_count, $enrolment->student->lname);
                    $active_sheet->setCellValue('E'.$row_count, $enrolment->student->fname);
                    $active_sheet->setCellValue('F'.$row_count, Str::length($enrolment->student->mname) > 0 ? $enrolment->student->mname[0] : '-');
                    $active_sheet->setCellValue('G'.$row_count, $enrolment->program->program_code);
                    $active_sheet->setCellValue('H'.$row_count, $enrolment->year_id);
                    $active_sheet->setCellValue('I'.$row_count, $enrolment->student->stud_gender);
                    $active_sheet->setCellValue('J'.$row_count, $enrolment->student->emailaddress);
                    $active_sheet->setCellValue('K'.$row_count, $enrolment->student->contactno);
                    $active_sheet->setCellValue('L'.$row_count, $enrolment->lab_units);
                    $active_sheet->setCellValue('M'.$row_count, $enrolment->clab_units);
                    $active_sheet->setCellValue('N'.$row_count, $enrolment->units_for_tuition);
                    $active_sheet->setCellValue('O'.$row_count, $enrolment->nstp_units);
                    
                    $col_count = 'P';

                    foreach($fee_types as $fee_type){
                        if($fee_type->fee_type_id == 3){
                            if($enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id)->where('fee_id', 24)->first()){
                                $active_sheet->setCellValue('AD'.$row_count, $enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id)->where('fee_id', 24)->first()->amount);
                                $total_tosf += $enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id)->where('fee_id', 24)->first()->amount;
                            }else{
                                $active_sheet->setCellValue('AD'.$row_count, '-');
                            }
                            if($enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id)->where('fee_id', 25)->first()){
                                $active_sheet->setCellValue('S'.$row_count, $enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id)->where('fee_id', 25)->first()->amount);
                                $total_tosf += $enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id)->where('fee_id', 25)->first()->amount;
                            } else {
                                $active_sheet->setCellValue('S'.$row_count, '-');
                            }
                            $col_count ++; 
                        } else if($fee_type->fee_type_id == 1){
                            foreach($enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id) as $tf){
                                if($tf->fee->is_nstp){
                                    $active_sheet->setCellValue('Q'.$row_count, $tf->amount);
                                    $total_tosf += $tf->amount;
                                    // $col_count ++;
                                } else {
                                    $active_sheet->setCellValue('Q'.$row_count, '-');
                                    $col_count ++;
                                    $active_sheet->setCellValue('P'.$row_count, $tf->amount);
                                    $total_tosf += $tf->amount;
                                    // $col_count ++;
                                }
                                // $active_sheet->setCellValue('P'.$row_count, $tf->amount);
                                // $total_tosf += $tf->amount;
                            }
                            $col_count ++;
                        } else {

                            $amount = $enrolment->student->unifast_collection->collection_details->where('fee_type_id', $fee_type->fee_type_id);

                            if($amount->isEmpty()){

                                $active_sheet->setCellValue($col_count.$row_count, '-');

                            } else {
                                $active_sheet->setCellValue($col_count.$row_count, $amount->sum('amount'));
                            }
                            $total_tosf += $amount->sum('amount');
                            $col_count ++;
                        }
                    }

                    $active_sheet->setCellValue('AE'.$row_count, $total_tosf);

                    $row_count += 1;
                }
            }
        }


        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file_reader, 'Xlsx');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($file_reader);
        ob_end_clean();

        // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="collections'.time().'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function generate_form2(){

        $enrolments = Enrolment::where('isassessed', 1)->current()->get();
        $sequence_number = 0;

        $data = collect([]);

        foreach($enrolments as $enrolment){
            $sequence_number += 1;

            $data->push([
                'Sequence Number' => $sequence_number,
                'Student Number' => $enrolment->stud_id,
                "Learner's Reference Number" => $enrolment->student->LRN,
                'Last Name' => $enrolment->student->lname,
                'Given Name' => $enrolment->student->fname,
                'Middle Initial' => Str::length($enrolment->student->mname) > 0 ? $enrolment->student->mname[0] : '-',
                'Degree Program' => $enrolment->program->program_code,
                'Year Level' => $enrolment->year_id,
                'Sex at Birth' => $enrolment->student->stud_gender,
                'E-mail Address' => $enrolment->student->emailaddress,
                'Phone Number' => $enrolment->student->contactno,
                'Laboratory Units/Subject' => $enrolment->lab_units,
                'Computer Lab Units/Subject' => $enrolment->clab_units,
                'Academic Units Enrolled (credit and non-credit courses)' => $enrolment->units_for_tuition,
                'Academic Units of NSTP Enrolled (credit and non-credit courses)' => $enrolment->nstp_units,

            ]);
        }
        
    
       $writer = SimpleExcelWriter::streamDownload('your-export.xlsx')->addRows($data->toArray());
    }
}
