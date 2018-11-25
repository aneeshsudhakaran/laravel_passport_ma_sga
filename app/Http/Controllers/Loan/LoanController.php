<?php
namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Loan;

class LoanController extends Controller
{
    // requestLoan
    public function requestLoan(Request $request)
    {
        $request->validate([
            'loan_amount' => 'required',
            'duration' => 'required',
            'repayment_frequency' => 'required',
            'interest_rate' => 'required',
            'arrangement_fee' => 'required',
            'description' => 'required'
        ]);
        
        $date_now = Carbon::now();
        
        $loan = new Loan([
            'user_id' => Auth::user()->id,
            'loan_amount' => $request->loan_amount,
            'duration' => $request->duration,
            'repayment_frequency' => $request->repayment_frequency,
            'interest_rate' => $request->interest_rate,
            'arrangement_fee' => $request->arrangement_fee,
            'description' => $request->description,
            'created_at' => $date_now,
            'updated_at' => $date_now,
        ]);
        
        $loan->save();
        
        return response()->json([
            'message' => __('loan.request_success')
        ], 201);
        
    }
    
    // approveloan
    public function approveloan(Request $request) {
        
        $date_now = Carbon::now();
        $message ="";
        
        $loan = Loan::find( $request->id );
        
        $loan->updated_at = $date_now;
        $loan->approved = $request->approved;
        $loan->approved_at = $date_now;
        
        if($loan->save()){
            $message =  __('loan.approved_success');
        } else {
            $message =  __('loan.approved_reject');
        }
        
        return response()->json([
            'message' => $message
        ], 201);
    }
    
    // myloan
    public function myloan() {
        $loan = Loan::find( array("user_id"=> Auth::user()->id) );
        
        return response()->json([
            'myloan' => $loan,
            'message' => __('loan.request_success')
        ], 201);
    } 
}
