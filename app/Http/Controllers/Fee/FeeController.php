<?php

namespace App\Http\Controllers\Fee;

use Validator;
use App\Models\CashierFee;
use Illuminate\Http\Request;
use App\Models\CashierFeeType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function filterData(Request $request)
    {
        switch ($request->data) {
            case 1:
                $fees = CashierFee::where('type', 1)->orderBy('fee_type_id', 'asc')->orderBy('cabs', 'desc')->orderBy('is_unifast', 'desc')->get();
                return response([
                    'message' => 'success',
                    'type' => 1,
                    'data' =>  $fees,
                    'user_role' => Auth::user()->user_role
                ], 200);  
                
            
            case 2:
                $fees = CashierFee::where('type', 2)->orderBy('fee_type_id', 'asc')->get();
                return response([
                    'message' => 'success',
                    'type' => 2,
                    'data' =>  $fees,
                    'user_role' => Auth::user()->user_role
                ], 200);  
                
        }
    }

    public function create()
    {
        $fee_types = CashierFeeType::all();

        return response()->json([
            'view' => view('fees.create', compact('fee_types'))->render()
        ]);
    }

    public function validateRequest(Request $request)
    {

        switch ($request->type) {
            case 1:
                $validator = Validator::make($request->all(), [
                    'fee_type_id' => 'required',
                    'name' => 'required',
                    'description' => 'required',    
                    'cost' => 'required',
                    'cabs' => 'required',
                    'coverage' => 'required',
                    'frequency' => 'required',
                    'year_level' => 'required',
                    'is_unifast' => 'required',
                ]);
                break;
            
            default:
                $validator = Validator::make($request->all(), [
                    'fee_type_id' => 'required',
                    'name' => 'required',
                    'description' => 'required',    
                    'cost' => 'required',
                    'reference_number' => 'required',
                    'date_of_approval' => 'required',
                ]);
                break;
        }

        if(!$validator->passes()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->toArray()
            ]);
        } else {
            return response()->json([
                'status' => 200
            ]);
        }
    }

    public function store(Request $request)
    {
        $new_fee = CashierFee::create([
            'fee_type_id' => $request->fee_type_id, 
            'name' => $request->name, 
            'description' => $request->description, 
            'cost' => $request->cost, 
            'cabs' => $request->cabs, 
            'coverage' => $request->coverage, 
            'frequency' => $request->frequency, 
            'year_level' => $request->year_level,
            'is_nstp'  => $request->is_nstp,
            'is_unifast' => $request->is_unifast ? $request->is_unifast : 0,
            'reference_number' => $request->reference_number,
            'account_type' => $request->account_type,
            'type' => $request->type,
            'date_of_approval' => $request->date_of_approval
        ]);

        $this->addToLog('create', 'fees', $new_fee->fee_id);

        return response()->json([
            'status' => 200,
            'message' => 'Fee added successfully!'
        ]);
    }

    public function delete(Request $request)
    {
        $fee = CashierFee::where('fee_id', decrypt($request->id))->first();
        $fee->delete();

        $this->addToLog('update', 'fees', decrypt($request->id));

        return response([
            'message' => 'Fee deleted successfully!',
            'type' => $fee->type,
        ], 200);  
    }

    public function edit(Request $request)
    {

        switch ($request->type) {
            case 1:
                $fee_types = CashierFeeType::active()->student()->get();
                $fee = CashierFee::where('fee_id', decrypt($request->id))->first();
                return response()->json([
                    'view' => view('fees.edit')->render(),
                    'form' => view('fees.form-wizards.form-student', compact('fee', 'fee_types'))->render()
                ]);
                break;
            case 2:
                $fee_types = CashierFeeType::active()->others()->get();
                $fee = CashierFee::where('fee_id', decrypt($request->id))->first();
                return response()->json([
                    'view' => view('fees.edit')->render(),
                    'form' => view('fees.form-wizards.form-others', compact('fee', 'fee_types'))->render()
                ]);
                break;
            default:

                break;
        }
    }

    public function update(Request $request)
    {

        $this->addToLog('update', 'fees', decrypt($request->id));

        $fee = CashierFee::where('fee_id', decrypt($request->id))->update([
            'fee_type_id' => $request->fee_type_id, 
            'name' => $request->name, 
            'description' => $request->description, 
            'cost' => $request->cost, 
            'cabs' => $request->cabs, 
            'coverage' => $request->coverage, 
            'frequency' => $request->frequency, 
            'year_level' => $request->year_level,
            'is_nstp'  => $request->is_nstp,
            'is_unifast' => $request->is_unifast, 
            'reference_number' => $request->reference_number, 
            'date_of_approval' => $request->date_of_approval
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Fee updated successfully!'
        ]);
    }

    public function selectType(Request $request)
    {
        switch ($request->type) {
            case 1:
                $fee_types = CashierFeeType::active()->student()->get();
                return response()->json([
                    'view' => view('fees.form-wizards.form-student', compact('fee_types'))->render()
                ]);
                break;
            case 2:
                $fee_types = CashierFeeType::active()->others()->get();
                return response()->json([
                    'view' => view('fees.form-wizards.form-others', compact('fee_types'))->render()
                ]);
                break;
            default:

                break;
        }
    }
}
