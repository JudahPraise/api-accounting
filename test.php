<?php

 // NSTP
if($fee->is_nstp == 1){
    if($fee->is_unifast == 1){  //NSTP
        if($nstp->isNotEmpty()){
            if($retake_nstp_course_units > $nstp->sum('units')){
                $nstp_units = $retake_nstp_course_units - $nstp->sum('units');
            } else {
                $nstp_units = $nstp->sum('units') - $retake_nstp_course_units;
            }
            $student_fee->cost = $fee->cost * $nstp_units / 2;
        }
    } else { //Reatake NSTP
        if($retake_courses->where('type', 4)->isNotEmpty()){
            $student_fee->cost = $fee->cost * $retake_nstp_course_units / 2;
        }
    }
// Tuition Fee for Retake
} else if($fee->fee_type_id == 1 && $fee->is_unifast == 0){
    if($retake_courses->isNotEmpty()){
       if($fee->is_nstp){
            $student_fee->cost = $fee->cost * $retake_courses->where('type','=',4)->sum('units') / 2;
       }else {
            $student_fee->cost = $fee->cost * $retake_courses->where('type','!=',4)->sum('units');
       }
    }
// Tuition Fee
} else {
    if($enrolment->units_for_tuition > $retake_courses->sum('units')){
       $units = $enrolment->units_for_tuition - $retake_courses->sum('units');
    } else {
        $units = $retake_courses->sum('units') - $enrolment->units_for_tuition;
    }
    $student_fee->cost = $fee->cost * $units;
}




if($fee->fee_type_id == 1 && $fee->is_nstp == 1){ //NSTP Fee
    if($fee->is_unifast == 1){  // Regular NSTP
        if($nstp->isNotEmpty()){
            $student_fee->cost = $fee->cost * $nstp->sum('units') / 2;
        }
    }else { // Retake NSTP
        if($retake_courses->where('type','=', 4)->isNotEmpty()){
            $student_fee->cost = $fee->cost * $retake_nstp_course_units / 2;
        }
    }
}else{  //Tuition Fee
    if($fee->is_unifast == 1){  // Is unifast reqular nstp fee
        $student_fee->cost = $fee->cost * $enrolment->units_for_tuition;
    }else { // Not unifast nstp fee
        $student_fee->cost = $fee->cost * $retake_courses->where('type','!=', 4)->sum('lec_units') / 2;
    }
}


if($fee->is_unifast == 1){ 
    if($fee->fee_type_id == 1 && $fee->is_nstp == 1){
        // NSTP Regular
        if($nstp->isNotEmpty()){
            $student_fee->cost = $fee->cost * $nstp->sum('units') / 2;
        }
    } else {
        // Tuition Regular
        $student_fee->cost = $fee->cost * $enrolment->units_for_tuition;
    }
} else {
    // NSTP second take
    if($retake_courses->where('type','=', 4)->isNotEmpty()){
        $student_fee->cost = $fee->cost * $retake_nstp_course_units / 2;
    }
    // Tuition second take
    $student_fee->cost = $fee->cost * $retake_courses->where('type','!=', 4)->sum('lec_units') / 2;
}

