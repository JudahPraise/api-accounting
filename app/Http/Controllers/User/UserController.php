<?php

namespace App\Http\Controllers\User;

use App\Models\Employee;
use App\Models\CashierUser;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function loadData(){

        $users = CashierUser::where('status','!=',0)->with('employee')->get(); 
        return view('users.table', compact('users'));

    }

    public function employees()
    {
        $users = CashierUser::query();
        
        return DataTables::eloquent($users)
                ->editColumn('fullname', function(CashierUser $user) {
                    return $user->employee->fname.' '.$user->employee->lname;
                })
                ->editColumn('role', function(CashierUser $user) {
                    foreach($this->roles as $key => $role){
                        return $user->role == $key ? $role : '';
                    }
                })
                ->editColumn('status', function(CashierUser $user) {
                    foreach($this->status as $key => $stat){
                        return $user->status == $key ? $stat : '';
                    }
                })
                ->toJson();
    }

    public function create()
    {
        return response()->json([
            'view' => view('users.modal')->render()
        ]);
    }

    public function search(Request $request)
    {
        $search = ucwords($request->search);
        $casher_users = CashierUser::pluck('p_id');
        $employees = Employee::select('fname', 'lname', 'p_id')->whereRaw("UPPER(fname) LIKE '%".strtoupper($search)."%'")
        ->orWhereRaw("UPPER(lname) LIKE '%".strtoupper($search)."%'")->get();

        return response()->json([
           'status' => 200,
           'view' => view('users.results', compact('employees'))->render()
        ]);
    }

    public function store(Request $request)
    {
        $employee = Employee::select('fname', 'lname', 'p_id')->where('p_id', decrypt($request->user))->first();

        if(!$employee){

            return response()->json([
                'status' => 400,
                'message' => 'Employee not found!'
            ]);

        } else if($employee){

            $isCashierUser = CashierUser::where('p_id', $employee->p_id)->first();

            if($isCashierUser){
                if($isCashierUser->status != 0){
                    return response()->json([
                    'status' => 409,
                    'message' => 'User already exist!'
                    ]);
                } else {
                     return response()->json([
                       'status' => 410,
                       'message' => 'User is unauthorized!'
                    ]);
                }
            }

            CashierUser::create([
                'p_id' => decrypt($request->user),
                'role' => 0,
                'status' => 0
            ]); 

            return response()->json([
                'status' => 200
            ]);
        }
    }

    public function delete(Request $request)
    {
        $user = CashierUser::where('p_id', decrypt($request->id))->update([
            'status' => 0
        ]);
        
        if($user){
            return response()->json([
                'status' => 200,
            ]);
        }

        return response()->json([
            'status' => 400,
            'message' => 'Something went wrong!'
        ]);
    }

    public function updateStatus(Request $request)
    {

        $success_count = 0;

        foreach($request->users as $user)
        {
            CashierUser::where('p_id', decrypt($user))->update([
                'role' => 4,
               'status' => 1
            ]);

            $success_count += 1;
        }
        
        if(count($request->users) == $success_count){

            if(count($request->users) > 1){
                $message = 'Users added successfully!';
            } else{
                $message = 'User added successfully!';
            }

            return response()->json([
                'status' => 200,
                'message' => $message
            ]);
        } else {

            foreach($request->users as $user)
            {
                CashierUser::where('p_id', decrypt($user))->delete();
            }

            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
