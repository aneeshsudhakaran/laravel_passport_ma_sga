<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    protected $fillable = [
        'user_id', 'loan_amount', 'duration', 'repayment_frequency', 'interest_rate', 'arrangement_fee', 'description', 'approved', 'approved_by'
    ];
    
}