<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Charts\CashFlows;
use App\Entities\CashFlow;
use App\Entities\EventModel;
use App\Entities\Service;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

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
        $totalPayments = CashFlow::where('payment_id', '!=', '')->count();
        if ($totalPayments == 0) {
            $totalPayments = 1;
        }
            $paymentCash = (CashFlow::where(['payment_id' => 1])->count() / $totalPayments) * 100;
            $paymentCredit = (CashFlow::where(['payment_id' => 2])->count() / $totalPayments) * 100;

        $events = [];
        $eloquentModel = EventModel::all();
        $calendar = Calendar::addEvents($eloquentModel);

        $chartPayments = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Pagamento em dinheiro', 'Pagamento com cartão'])
            ->datasets([
                [
                    'backgroundColor' => ['rgb(167,167,167)', 'rgb(247,135,61)'],
                    'hoverBackgroundColor' => ['rgb(167,167,167)', 'rgb(247,135,61)'],
                    'data' => [50, $paymentCredit]
                ]
            ])
            ->options([]);

        $reports = $this->getServicesBydayOfWeek();

        $chartReport = app()->chartjs
            ->name('teste')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'])
            ->datasets([
                [
                    "label" => "Serviços",
                    'backgroundColor' => "rgb(3,153,224)",
                    'borderColor' => "rgb(6,101,146)",
                    "pointBorderColor" => "black",
                    "pointBackgroundColor" => "white",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $reports,
                ],
            ]);

        return view('adminlte::home', compact('paymentCash', 'paymentCredit', 'chartPayments', 'chartReport','calendar'));
    }

    protected function getServicesBydayOfWeek() {
        $allServices = Service::withTrashed()->where('status','done')->get();
        $monday = null; $tuesday = null; $wednesday = null; $thursday = null; $friday = null; $saturday = null; $sunday = null;

        foreach ($allServices as $service) {
            if (Carbon::parse($service['scheduled_day'])->dayOfWeek == 1) {
                $monday++;
            } elseif (Carbon::parse($service['scheduled_day'])->dayOfWeek == 2) {
                $tuesday++;
            }elseif (Carbon::parse($service['scheduled_day'])->dayOfWeek == 3) {
                $wednesday++;
            }elseif (Carbon::parse($service['scheduled_day'])->dayOfWeek == 4) {
                $thursday++;
            }elseif (Carbon::parse($service['scheduled_day'])->dayOfWeek == 5) {
                $friday++;
            }elseif (Carbon::parse($service['scheduled_day'])->dayOfWeek == 6) {
                $saturday++;
            }
        }
        return [$monday,$tuesday,$wednesday,$thursday,$friday,$saturday];
    }
}