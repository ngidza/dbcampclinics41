<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patients;
use App\Glucoses;
use App\Exercise;
use App\Weight;
use App\Weist;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use DB;
use Session;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //table patients
         $patientsdatatable = Patients::all();

         $exercises =Exercise::all() ->toArray();
         $exercises = array_column($exercises,'value');

         $glucoses =Glucoses::all() ->toArray();
         $glucoses = array_column($glucoses,'value');

         $weights =Weight::all()  ->toArray();
         $weights = array_column($weights,'value');
            
         $weists =Weist::all() ->toArray();
         $weists = array_column($weists,'value');
            
        return view('doctors.reports.index')->withExercises(json_encode($exercises))
                                             ->withGlucoses(json_encode($glucoses))
                                             ->withWeights(json_encode($weights))
                                             ->withWeists(json_encode($weists))
                                             ->withPatientsdatatable($patientsdatatable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            //put fields to be validated here
            'patient_id' =>'required',
            'report' =>'required',
           /*  'duration' =>'required', */
            'type' =>'required',
           
            ]);  
            
            $patient_id = $request ->input('patient_id');
            $report = $request ->input('report');

          /*   $duration1 = $request ->input('duration'); */
           /*  $duration = $request; */
            /*  $now = Carbon::now();
             $now ->subWeekdays($duration1); */

            $type = $request ->input('type');

            $patientreportsdata = DB::table($report)->where('patient_id', $patient_id)->get();

            foreach ($patientreportsdata as $key => $patients) {
                $patient[] = $patients ->value;
            }
           
            if (!$patientreportsdata ->isEmpty()) {

                // $patientreportsduration[] = DB::table($duration)->where('created_at',$duration)->value('created_at');
            $patientsnamedata =DB::table('patients')->where('id',$patient_id) ->value('patient_name');
            
            return view('doctors.reports.shows')   ->withPatient(json_encode($patient))
                                                     ->withPatientsnamedata($patientsnamedata)
                                                    ->withReport($report)
                                                     ->withType($type)
                                                    /* ->withNow($now) */; 
            } else {
                
                Session::flash('error','Patient no data at the moment.');          
                return redirect() ->route('reports.index');
               
                                                    }
          
       
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
