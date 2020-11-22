<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weist;
use Session;
use DB;

class WeistsController extends Controller
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
        $mealsdatatable = DB::table('meals')->get();
        $mealsdataarray =json_decode(json_encode($mealsdatatable),true);

        for ($i=0; $i <count($mealsdataarray) ; $i++) { 
           
                $meals_idx[$i]                     = $mealsdataarray[$i]['id'];
                $meals_namex[$meals_idx[$i]]    = $mealsdataarray[$i]['meal_time'];
        }
        //table weights
       $weistsdatatable = DB::table('weists')->latest() ->get();
       $weistsdataarray =json_decode(json_encode($weistsdatatable), true);

       for ($i=0; $i < count($weistsdataarray); $i++) { 
           
             $weists_id[$i]                 = $weistsdataarray[$i]['id'];
             $patient_id[$weists_id[$i]]    =$weistsdataarray[$i]['patient_id'];
             $meals_id[$weists_id[$i]]    =$weistsdataarray[$i]['meals_id'];
             $value[$weists_id[$i]]        = $weistsdataarray[$i]['value'];
             $created_at[$weists_id[$i]]        = $weistsdataarray[$i]['created_at'];
             $updated_at[$weists_id[$i]]    = $weistsdataarray[$i]['updated_at'];
             $patient_name[$weists_id[$i]]    = $patient_namex[$patient_id[$weists_id[$i]]];
             $patient_name_no[$weists_id[$i]]    =  $patient_name_nox[$patient_id[$weists_id[$i]]];
             $meals_name[$weists_id[$i]]    =  $meals_namex[$meals_id[$weists_id[$i]]];
            
       }
       
       $data =compact('weists_id','value','patient_id','created_at','updated_at','patient_name','patient_name_no','meals_name',
                         'patientsdatatable','mealsdatatable'
             );

             return view('nurses.weists.index', $data);
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
             
            ]);         
       
      $weist = new Weist();

         $weist->patient_id = $request['patient_id'];
         $weist->meals_id = $request['meal_id'];
         $weist->value = $request['value'];
         
    // add other fields
     $weist->save();

           Session::flash('success','Patient weists successfuly  Created.');
            return redirect()->route('weists.index');
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
             
            ]);         
       
      $weist =Weist::find($id);

         $weist->patient_id = $request['patient_id'];
         $weist->meals_id = $request['meal_id'];
         $weist->value = $request['value'];
         
    // add other fields
     $weist->save();

           Session::flash('success','Patient weists successfuly  Updated.');
            return redirect()->route('weists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weist =Weist::find($id); 

            $weist ->delete();
            
            Session::flash('success','Patient weists successfuly  Removed.');
            return redirect()->route('weists.index');
     
    }
}
