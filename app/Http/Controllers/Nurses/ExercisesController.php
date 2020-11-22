<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exercise;
use Session;
use DB;

class ExercisesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //table patients
         $patientsdatatable = DB::table('patients')->get();
         $patientsdataarray =json_decode(json_encode($patientsdatatable),true);
 
         for ($i=0; $i <count($patientsdataarray) ; $i++) { 
            
                 $patient_idx[$i]                     = $patientsdataarray[$i]['id'];
                 $patient_namex[$patient_idx[$i]]    = $patientsdataarray[$i]['patient_name'];
                 $patient_name_nox[$patient_idx[$i]]    = $patientsdataarray[$i]['patient_no'];
         }
         //table Meals
         $activitiesdatatable = DB::table('activities')->get();
         $activitiesdataarray =json_decode(json_encode($activitiesdatatable),true);
 
         for ($i=0; $i <count($activitiesdataarray) ; $i++) { 
            
                 $activity_idx[$i]                     = $activitiesdataarray[$i]['id'];
                 $activity_namex[$activity_idx[$i]]    = $activitiesdataarray[$i]['activity'];
         } 
         //table exercises
        $exercisesdatatable = DB::table('exercises') ->latest()->get();
        $exercisesdataarray =json_decode(json_encode($exercisesdatatable), true);
 
        for ($i=0; $i < count($exercisesdataarray); $i++) { 
            
              $exercises_id[$i]                 = $exercisesdataarray[$i]['id'];
              $patient_id[$exercises_id[$i]]    =$exercisesdataarray[$i]['patient_id'];
              $activity_id[$exercises_id[$i]]    =$exercisesdataarray[$i]['activity_id'];
              $value[$exercises_id[$i]]        = $exercisesdataarray[$i]['value'];
              $distance[$exercises_id[$i]]        = $exercisesdataarray[$i]['distance'];
              $created_at[$exercises_id[$i]]        = $exercisesdataarray[$i]['created_at'];
              $updated_at[$exercises_id[$i]]    = $exercisesdataarray[$i]['updated_at'];
              $patient_name[$exercises_id[$i]]    = $patient_namex[$patient_id[$exercises_id[$i]]];
              $patient_name_no[$exercises_id[$i]]    =  $patient_name_nox[$patient_id[$exercises_id[$i]]];
              $activity_name[$exercises_id[$i]]    =  $activity_namex[$activity_id[$exercises_id[$i]]];
             
        }
        
        $data = compact('exercises_id','patient_id','value','created_at','updated_at','patient_name','patient_name_no','activity_name',
                          'patientsdatatable','activitiesdatatable','distance'
              );
 
              return view('nurses.exercises.index', $data);
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
            'patient_id' =>'required',
            'activity_id' =>'required',
            'value' =>'required',
            'distance' =>'required',
             
            ]);

            $exercisesx['patient_id']     = $request['patient_id'];
            $exercisesx['activity_id']    = $request['activity_id'];
            $exercisesx['distance']       = $request['distance'];
            $exercisesx['value']          = $request['value'];

            $exercises = new Exercise();

             $exercises['patient_id']        = trim(strip_tags(htmlspecialchars($exercisesx['patient_id'] )));
             $exercises['activity_id']       = trim(htmlspecialchars($exercisesx['activity_id']));
             $exercises['distance']          = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($exercisesx['distance'])))));
             $exercises['value']             = trim(ucfirst(strtolower(strip_tags(htmlspecialchars( $exercisesx['value'] )))));
                
        // add other fields
        if ($exercises->save()) {
        
            Session::flash('success','Patient glucose successfuly  Created.');
            return redirect()->route('excercise.index');
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
       
        $this->validate(request(),[
            //put fields to be validated here
            'patient_id' =>'required',
            'activity_id' =>'required',
            'value' =>'required',
            'distance' =>'required',
             
            ]);  
            
            $exercisesx['patient_id']     = $request['patient_id'];
            $exercisesx['activity_id']    = $request['activity_id'];
            $exercisesx['distance']       = $request['distance'];
            $exercisesx['value']          = $request['value'];
       
      $exercises =Exercise::find($id);

      $exercises['patient_id']        = trim(strip_tags(htmlspecialchars($exercisesx['patient_id'] )));
      $exercises['activity_id']       = trim(htmlspecialchars($exercisesx['activity_id']));
      $exercises['distance']          = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($exercisesx['distance'])))));
      $exercises['value']             = trim(ucfirst(strtolower(strip_tags(htmlspecialchars( $exercisesx['value'] )))));
         
    // add other fields
     $exercises->save();

           Session::flash('success','Patient glucose successfuly  Updated.');
            return redirect()->route('excercise.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $exercises =Exercise::find($id);
        $exercises ->delete();

        Session::flash('success','Patient exercises successfuly  Deleted.');
        return redirect()->route('excercise.index');
    }
}
