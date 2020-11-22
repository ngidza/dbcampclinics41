<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exercise;
use App\Glucoses;
use App\Weight;
use App\Weist;
use DB;

class RecordsController extends Controller
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
         
         $exercises =Exercise::all() ->toArray();
         $exercises = array_column($exercises,'value');

         $glucoses =Glucoses::all() ->toArray();
         $glucoses = array_column($glucoses,'value');

         $weights =Weight::all()  ->toArray();
         $weights = array_column($weights,'value'); 
        
         $weists =Weist::all() ->toArray();
         $weists = array_column($weists,'value');
           
        return view('doctors.records.index')->withExercises(json_encode($exercises))
                                             ->withGlucoses(json_encode($glucoses))
                                             ->withWeights(json_encode($weights))
                                             ->withWeists(json_encode($weists));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'groups' =>'required',
           //'report' =>'required',
            // 'duration' =>'required',
            'type' =>'required',
           
            ]);  
            
            $groups = $request ->input('groups');
            $report = $request ->input('report');
           /*  $duration = $request; */
            $type = $request ->input('type');

            $patient = DB::table($groups)
                                 ->join('patients', 'patients.id','=','patient_id')
                                  ->get();

            foreach ($patient as $key => $patients) {
               $patientdata[] = $patients ->value;
               $patientname[] = $patients ->patient_name;
             }
           // $patientreportsduration[] = DB::table($duration)->where('created_at',$duration)->value('created_at');
           // $patientsnamedata =DB::table('patients')->where('id',$patient_id) ->value('patient_name');
        
         return view('doctors.records.shows')   //->withPatientreports(json_encode($patientreports))
                                               // ->withPatientsnamedata($patientsnamedata)
                                                ->withPatientdata(json_encode($patientdata))
                                                ->withPatient($patient)
                                                ->withGroups($groups)
                                                ->withPatientname(json_encode($patientname))
                                                ->withType($type);
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
