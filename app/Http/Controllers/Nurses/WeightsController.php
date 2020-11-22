<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weight;
use Session;
use DB;
use App\Medication;

class WeightsController extends Controller
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
       $weightsdatatable = DB::table('weights') ->latest()->get();
       $weightsdataarray =json_decode(json_encode($weightsdatatable), true);

       for ($i=0; $i < count($weightsdataarray); $i++) { 
           
             $weights_id[$i]                 = $weightsdataarray[$i]['id'];
             $patient_id[$weights_id[$i]]    = $weightsdataarray[$i]['patient_id'];
             $meals_id[$weights_id[$i]]    =$weightsdataarray[$i]['meals_id'];
             $weight[$weights_id[$i]]    = $weightsdataarray[$i]['weight'];
             $value[$weights_id[$i]]        = $weightsdataarray[$i]['value'];
             $temperature[$weights_id[$i]]    = $weightsdataarray[$i]['temperature'];
             $created_at[$weights_id[$i]]        = $weightsdataarray[$i]['created_at'];
             $updated_at[$weights_id[$i]]    = $weightsdataarray[$i]['updated_at'];
             $patient_name[$weights_id[$i]]    = $patient_namex[$patient_id[$weights_id[$i]]];
             $patient_name_no[$weights_id[$i]]    =  $patient_name_nox[$patient_id[$weights_id[$i]]];
             $meals_name[$weights_id[$i]]    =  $meals_namex[$meals_id[$weights_id[$i]]];
            
       }

         $data = compact(
            'weights_id','weight','patient_id','value','temperature','patient_name','patient_name_no','meals_name','mealsdatatable','patientsdatatable',
            'created_at','updated_at'
            );
          
        return view('nurses.weights.index', $data);
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
            'meals_id' =>'required',
            'weight' =>'required',
            'height' =>'required',
            'temperature' =>'required',
           
            ]);

            //  Querry to findglucose
            $glucosevalue = DB::table('glucoses')->where('patient_id', $request['patient_id'] )->value('value');
           // dd($glucosevalue );
          
    $weight = new Weight();

         $weight->patient_id = $request['patient_id'];
         $weight->meals_id = $request['meals_id'];
         $weight->weight = $request['weight'];
         $weight->value =$request['weight']/($request['height']*$request['height']);
         $weight->temperature= $request['temperature'];

    $weight = new  Medication();
  
         $weight -> patient_id= $request['patient_id'];
         $weight ->  weight = $request['weight'] ; 
         $weight ->  value = ($glucosevalue == NULL) ? "nill" : $glucosevalue;         
          $weight ->  temperature = $request['temperature'] ;                

    
    // add other fields
    $weight->save();

           Session::flash('success','Patient weights successfuly  Created.');
            return redirect()->route('weights.index');

         
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
            'meals_id' =>'required',
            'weight' =>'required',
            'height' =>'required',
            'temperature' =>'required',
           
            ]); 
            
         
            //  Querry to findglucose
     $glucosevalue = DB::table('glucoses')->where('patient_id', $request['patient_id'] )->value('value');

    $weight = Weight::find($id);

    $weight-> meals_id = $request['meals_id'];
    $weight-> weight = $request['weight'];
    $weight-> value =$request['weight']/($request['height']*$request['height']);
    $weight-> temperature= $request['temperature'];
    $weight->save();

    $weight = new  Medication();
  
    $weight -> patient_id= $request['patient_id'];
    $weight -> weight = $request['weight'] ; 
    $weight -> value = ($glucosevalue == NULL) ? "nill" : $glucosevalue;         
    $weight -> temperature = $request['temperature'] ;  
                  
 
    if ($weight->save()) {
        Session::flash('success','Patient weights successfuly Upadated.');
            return redirect()->route('weights.index');
    }
   
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weight = Weight::find($id);
        $weight->delete();
        
        Session::flash('success','Patient Medication successfuly  Removed.');
        return redirect()->route('weights.index');
    }
}
