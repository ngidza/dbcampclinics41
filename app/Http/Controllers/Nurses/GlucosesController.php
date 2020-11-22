<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Glucoses;
use App\Medication;
use Session;
use DB;

class GlucosesController extends Controller
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

         $activitiesdatatable = DB::table('activities')->get();
         $activitiesdataarray =json_decode(json_encode($activitiesdatatable),true);
 
         for ($i=0; $i <count($activitiesdataarray) ; $i++) { 
            
                 $activity_idx[$i]                     = $activitiesdataarray[$i]['id'];
                 $activity_namex[$activity_idx[$i]]    = $activitiesdataarray[$i]['activity'];
         } 

         //table Meals
         $mealsdatatable = DB::table('meals')->get();
         $mealsdataarray =json_decode(json_encode($mealsdatatable),true);
 
         for ($i=0; $i <count($mealsdataarray) ; $i++) { 
            
                 $meals_idx[$i]                     = $mealsdataarray[$i]['id'];
                 $meals_namex[$meals_idx[$i]]    = $mealsdataarray[$i]['meal_time'];
         }
         //table weglucosesights
        $glucosesdatatable = DB::table('glucoses') ->get();
        $glucosesdataarray =json_decode(json_encode($glucosesdatatable), true);
 
        for ($i=0; $i < count($glucosesdataarray); $i++) { 
            
              $glucoses_id[$i]                 = $glucosesdataarray[$i]['id'];
              $patient_id[$glucoses_id[$i]]    =$glucosesdataarray[$i]['patient_id'];
              $meals_id[$glucoses_id[$i]]    =$glucosesdataarray[$i]['meals_id'];
              $value[$glucoses_id[$i]]        = $glucosesdataarray[$i]['value'];
              $activity_id[$glucoses_id[$i]]    =$glucosesdataarray[$i]['activity_id'];
              $comments[$glucoses_id[$i]]        = $glucosesdataarray[$i]['comments'];
              $created_at[$glucoses_id[$i]]        = $glucosesdataarray[$i]['created_at'];
              $updated_at[$glucoses_id[$i]]    = $glucosesdataarray[$i]['updated_at'];
              $patient_name[$glucoses_id[$i]]    = $patient_namex[$patient_id[$glucoses_id[$i]]];
              $patient_name_no[$glucoses_id[$i]]    =  $patient_name_nox[$patient_id[$glucoses_id[$i]]];
              $meals_name[$glucoses_id[$i]]    =  $meals_namex[$meals_id[$glucoses_id[$i]]];
              $activity_name[$glucoses_id[$i]]    = $activity_namex[$activity_id[$glucoses_id[$i]]];
             
        }
        
        $data =compact('glucoses_id','patient_id','value','created_at','updated_at','patient_name','patient_name_no','meals_name',
                          'patientsdatatable','mealsdatatable','activitiesdatatable','activity_name','comments'
              );
 
              return view('nurses.glucoses.index', $data);
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
            'meal_id' =>'required',
            'value' =>'required',
            'activity_id' =>'required',
            'comments' =>'required',
             
            ]);         
       
      $glucose = new Glucoses();

         $glucose->patient_id = $request['patient_id'];
         $glucose->meals_id = $request['meal_id'];
         $glucose->value = $request['value'];
         $glucose->activity_id = $request['activity_id'];
         $glucose->comments = $request['comments'];
        
    // add other fields
     $glucose->save();

           Session::flash('success','Patient glucose successfuly  Created.');
            return redirect()->route('glucose.index');
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
            'meal_id' =>'required',
            'value' =>'required',
            'activity_id' =>'required',
            'comments' =>'required',
             
            ]);         
       
      $glucose =Glucoses::find($id);

         $glucose->patient_id = $request['patient_id'];
         $glucose->meals_id = $request['meal_id'];
         $glucose->value = $request['value'];
         $glucose->activity_id = $request['activity_id'];
         $glucose->comments = $request['comments'];
         
    // add other fields
     $glucose->save();

           Session::flash('success','Patient glucose successfuly  Updated.');
            return redirect()->route('glucose.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $glucose =glucoses::find($id);
        $glucose ->delete();

        Session::flash('success','Patient glucose successfuly  Updated.');
        return redirect()->route('glucose.index');
    }
}
