<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Food;
use Session;
use DB;

class FoodsController extends Controller
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
         //table medicine
         $foods_typesdatatable = DB::table('foods_type')->get();
         $foods_typesdataarray =json_decode(json_encode($foods_typesdatatable),true);
 
         for ($i=0; $i <count($foods_typesdataarray) ; $i++) { 
            
                 $foods_types_idx[$i]                    = $foods_typesdataarray[$i]['id'];
                 $food_namex[$foods_types_idx[$i]]       = $foods_typesdataarray[$i]['food_type'];
                 $food_nutrientsx[$foods_types_idx[$i]]  = $foods_typesdataarray[$i]['nutrients'];
         }
         //table patients
         $patientsdatatable = DB::table('patients')->get();
         $patientsdataarray =json_decode(json_encode($patientsdatatable),true);
 
         for ($i=0; $i <count($patientsdataarray) ; $i++) { 
            
                 $patient_idx[$i]                     = $patientsdataarray[$i]['id'];
                 $patient_namex[$patient_idx[$i]]    = $patientsdataarray[$i]['patient_name'];
                 $patient_name_nox[$patient_idx[$i]]    = $patientsdataarray[$i]['patient_no'];
         }
         //table formulars
         $mealsdatatable = DB::table('meals')->get();
         $mealsdataarray =json_decode(json_encode($mealsdatatable),true);
 
         for ($i=0; $i <count($mealsdataarray) ; $i++) { 
            
                 $meals_idx[$i]                     = $mealsdataarray[$i]['id'];
                 $meals_namex[$meals_idx[$i]]    = $mealsdataarray[$i]['meal_time'];
         }
         //table medication
        $foodsdatatable = DB::table('foods') ->get();
        $foodsdataarray =json_decode(json_encode($foodsdatatable), true);
 
        for ($i=0; $i < count($foodsdataarray); $i++) { 
            
              $foods_id[$i]                 = $foodsdataarray[$i]['id'];
              $patient_id[$foods_id[$i]]    = $foodsdataarray[$i]['patient_id'];
              $meals_id[$foods_id[$i]]    = $foodsdataarray[$i]['meals_id'];
              $food_type_id[$foods_id[$i]]    = $foodsdataarray[$i]['food_type_id'];
              $notes[$foods_id[$i]]    = $foodsdataarray[$i]['notes'];
              $created_at[$foods_id[$i]]        = $foodsdataarray[$i]['created_at'];
              $updated_at[$foods_id[$i]]        = $foodsdataarray[$i]['updated_at'];
              $patient_name[$foods_id[$i]]    =  $patient_namex[$patient_id[$foods_id[$i]]];
              $patient_name_no[$foods_id[$i]]    =  $patient_name_nox[$patient_id[$foods_id[$i]]];
              $meals_name[$foods_id[$i]]    = $meals_namex[$meals_id[$foods_id[$i]]];
              $food_name[$foods_id[$i]]    = $food_namex[$food_type_id[$foods_id[$i]]];
              $food_nutrients[$foods_id[$i]]    = $food_nutrientsx[$food_type_id[$foods_id[$i]]];
        }

        $data =compact('foods_id','patient_id','notes','created_at','updated_at','patient_name','patient_name_no','meals_name',
                        'food_name','food_nutrients','patientsdatatable','mealsdatatable','foods_typesdatatable');

         return view('nurses.foods.index',$data);           
 
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
            'food_type_id' =>'required',
            'notes' =>'required',
           
            ]);         
       
    $foods = new Food();

         $foods->patient_id = $request['patient_id'];
         $foods->meals_id = $request['meal_id'];
         $foods->food_type_id = $request['food_type_id'];
         $foods->notes= $request['notes'];
       
    // add other fields
    $foods->save();

           Session::flash('success','Patient Foods successfuly  Created.');
            return redirect()->route('foods.index');
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
            'food_type_id' =>'required',
            'notes' =>'required',
           
            ]);         
       
    $foods = Food::find($id);

         $foods->patient_id = $request['patient_id'];
         $foods->meals_id = $request['meal_id'];
         $foods->food_type_id = $request['food_type_id'];
         $foods->notes= $request['notes'];
       
    // add other fields
    $foods->save();

           Session::flash('success','Patient Foods successfuly  Updated.');
            return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foods = Food::find($id);
        $foods->delete();

        Session::flash('success','Patient Foods successfuly Removed.');
         return redirect()->route('foods.index');
    }
}
