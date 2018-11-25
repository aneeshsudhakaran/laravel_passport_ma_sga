<?php

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');
    
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
 
Route::group([
    'namespace' => 'Loan',
    'middleware' => 'api',
    'prefix' => 'loan'
], function () {
    
    
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::post('requestloan','LoanController@requestLoan');
        Route::post('approveloan','LoanController@approveLoan');
        Route::get('myloan','LoanController@myLoan');
    });
});

 
Route::group([
    'namespace' => 'Repayment',
    'middleware' => 'api',
    'prefix' => 'repayment'
], function () {
    
    
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::post('repay','RepaymentController@replayLoan');
    });
});