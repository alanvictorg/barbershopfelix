<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Charts\CashFlows;
use App\Entities\CashFlow;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
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
     * @return Response
     */
    public function index()
    {
        $totalPayments = CashFlow::where('payment_id','!=', '')->count();
        $paymentCash = (CashFlow::where(['payment_id' => 1])->count() / $totalPayments) * 100;
        $paymentCredit = (CashFlow::where(['payment_id' => 2])->count() / $totalPayments) * 100;

        $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Pagamento em dinheiro', 'Pagamento com cartão'])
            ->datasets([
                [
                    'backgroundColor' => ['black', '#36A2EB'],
                    'hoverBackgroundColor' => ['black', '#36A2EB'],
                    'data' => [$paymentCashf, $paymentCredit]
                ]
            ])
            ->options([]);

        return view('adminlte::home', compact('paymentCash', 'paymentCredit','chartjs'));
    }
}