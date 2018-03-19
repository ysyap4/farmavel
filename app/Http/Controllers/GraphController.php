<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Hash;
use Redirect;
use Auth;
use Session;
use App\Model\users;
use App\Model\medicine;
use App\Model\report;
use App\Model\appointment;
use App\Model\vas;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function graph_alltime_index()
    {
        $user = users::all();
        $medicine = medicine::all();
        $report = report::all();
        $appointment = appointment::all();
        $vas = vas::all();

        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $pie_medicine_legal_count = medicine::where('med_authenticity', 'Legal')->count();
        $pie_medicine_illegal_count = medicine::where('med_authenticity', 'Illegal')->count();

        $polar_medicine_traditional_count = medicine::where('med_category', 'Traditional')->count();
        $polar_medicine_natural_count = medicine::where('med_category', 'Natural ingredient')->count();
        $polar_medicine_supplement_count = medicine::where('med_category', 'Supplement')->count();

        $radar_report_batupahat_count = report::where('rep_location', 'Batu Pahat')->count();
        $radar_report_johorbahru_count = report::where('rep_location', 'Johor Bahru')->count();
        $radar_report_muar_count = report::where('rep_location', 'Muar')->count();
        $radar_report_segamat_count = report::where('rep_location', 'Segamat')->count();
        $radar_report_kulaijaya_count = report::where('rep_location', 'Kulaijaya')->count();
        $radar_report_skudai_count = report::where('rep_location', 'Skudai')->count();
        $radar_report_pasirgudang_count = report::where('rep_location', 'Pasir Gudang')->count();

        return View::make('graph_alltime_index', array('user' => $user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app, 
            'pie_medicine_legal_count' => $pie_medicine_legal_count, 
            'pie_medicine_illegal_count' => $pie_medicine_illegal_count, 
            'polar_medicine_traditional_count' => $polar_medicine_traditional_count, 
            'polar_medicine_natural_count' => $polar_medicine_natural_count, 
            'polar_medicine_supplement_count' => $polar_medicine_supplement_count,
            'radar_report_batupahat_count' => $radar_report_batupahat_count,
            'radar_report_johorbahru_count' => $radar_report_johorbahru_count,
            'radar_report_muar_count' => $radar_report_muar_count,
            'radar_report_segamat_count' => $radar_report_segamat_count,
            'radar_report_kulaijaya_count' => $radar_report_kulaijaya_count,
            'radar_report_skudai_count' => $radar_report_skudai_count,
            'radar_report_pasirgudang_count' => $radar_report_pasirgudang_count));
    }

    public function graph_alltime_index_pdf()
    {
        $user = users::all();
        $medicine = medicine::all();
        $report = report::all();
        $appointment = appointment::all();
        $vas = vas::all();

        $pie_medicine_legal_count = medicine::where('med_authenticity', 'Legal')->count();
        $pie_medicine_illegal_count = medicine::where('med_authenticity', 'Illegal')->count();

        $polar_medicine_traditional_count = medicine::where('med_category', 'Traditional')->count();
        $polar_medicine_natural_count = medicine::where('med_category', 'Natural ingredient')->count();
        $polar_medicine_supplement_count = medicine::where('med_category', 'Supplement')->count();

        $radar_report_batupahat_count = report::where('rep_location', 'Batu Pahat')->count();
        $radar_report_johorbahru_count = report::where('rep_location', 'Johor Bahru')->count();
        $radar_report_muar_count = report::where('rep_location', 'Muar')->count();
        $radar_report_segamat_count = report::where('rep_location', 'Segamat')->count();
        $radar_report_kulaijaya_count = report::where('rep_location', 'Kulaijaya')->count();
        $radar_report_skudai_count = report::where('rep_location', 'Skudai')->count();
        $radar_report_pasirgudang_count = report::where('rep_location', 'Pasir Gudang')->count();

        $data = array(
            'pie_medicine_legal_count' => $pie_medicine_legal_count,
            'pie_medicine_illegal_count' => $pie_medicine_illegal_count,
            'polar_medicine_traditional_count' => $polar_medicine_traditional_count,
            'polar_medicine_natural_count' => $polar_medicine_natural_count,
            'polar_medicine_supplement_count' => $polar_medicine_supplement_count,
            'radar_report_batupahat_count' => $radar_report_batupahat_count,
            'radar_report_johorbahru_count' => $radar_report_johorbahru_count,
            'radar_report_muar_count' => $radar_report_muar_count,
            'radar_report_segamat_count' => $radar_report_segamat_count,
            'radar_report_kulaijaya_count' => $radar_report_kulaijaya_count,
            'radar_report_skudai_count' => $radar_report_skudai_count,
            'radar_report_pasirgudang_count' => $radar_report_pasirgudang_count
        );

        $pdf = PDF::loadView('graph_alltime_index_pdf', $data);
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        
        return $pdf->download('graph_alltime_index.pdf');
    }

    public function graph_periodic_index()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('graph_periodic_index', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function graph_periodic_results()
    {   
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $report = report::all();
        $appointment = appointment::all();

        $start_month = Input::get('get_slider_value1');
        $end_month = Input::get('get_slider_value2');

        $display_results = array();

        
        $display_results = '';
        $display_results = report::select(DB::raw('count(*) as display_count, rep_medicine'))
                                ->whereMonth('created_at', '>=', $start_month)
                                ->whereMonth('created_at', '<=', $end_month)
                                ->groupBy('rep_medicine')
                                ->orderBy('display_count', 'desc')
                                ->take(3)
                                ->get();

        return View::make('graph_periodic_results', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app, 'report' => $report, 'appointment' => $appointment, 'start_month' => $start_month, 'end_month' => $end_month, 'display_results' => $display_results));
    }

}