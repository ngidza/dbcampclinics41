<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medication;
use Session;
use DB;

class MedicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {

        //Count function
        
        $countPatients = DB::table('medications')->select('dosage')->where('dosage',NULL)->count();
        $countPatientsteated = DB::table('medications')->select('dosage')->where('dosage','!=', NULL)->count();
      
        //table medicine
        $medicinesdatatable = DB::table('medicines')->get();
        $medicinesdataarray =json_decode(json_encode($medicinesdatatable),true);

        for ($i=0; $i <count($medicinesdataarray) ; $i++) { 
           
                $medicines_idx[$i]                     = $medicinesdataarray[$i]['id'];
                $medicine_namex[$medicines_idx[$i]]    = $medicinesdataarray[$i]['medicines_type'];
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
        $formularsdatatable = DB::table('formulars')->get();
        $formularsdataarray =json_decode(json_encode($formularsdatatable),true);

        for ($i=0; $i <count($formularsdataarray) ; $i++) { 
           
                $formulars_idx[$i]                     = $formularsdataarray[$i]['id'];
                $formulars_namex[$formulars_idx[$i]]    = $formularsdataarray[$i]['formular_type'];
        }
        //table medication
       $medicationsdatatable = DB::table('medications')->latest()->get();
       $medicationsdataarray =json_decode(json_encode($medicationsdatatable), true);

       for ($i=0; $i < count($medicationsdataarray); $i++) { 
           
             $medications_id[$i]                 = $medicationsdataarray[$i]['id'];
             $patient_id[$medications_id[$i]]    = $medicationsdataarray[$i]['patient_id'];
             $medicine_id[$medications_id[$i]]    = $medicationsdataarray[$i]['medicine_id'];
             $formula_id[$medications_id[$i]]    = $medicationsdataarray[$i]['formula_id'];
             $dosage[$medications_id[$i]]        = $medicationsdataarray[$i]['dosage'];
             $notes[$medications_id[$i]]    = $medicationsdataarray[$i]['notes'];
             $temperature[$medications_id[$i]]        = $medicationsdataarray[$i]['temperature'];
             $weight[$medications_id[$i]]    = $medicationsdataarray[$i]['weight'];
             $glucosevalue[$medications_id[$i]]    = $medicationsdataarray[$i]['value'];
             $created_at[$medications_id[$i]]        = $medicationsdataarray[$i]['created_at'];
             $updated_at[$medications_id[$i]]        = $medicationsdataarray[$i]['updated_at'];
             $patient_name[$medications_id[$i]]    =  $patient_namex[$patient_id[$medications_id[$i]]];
            // $patient_name[$medications_id[$i]]    =  $patient_namex[$patient_id[$medications_id[$i]]];
             $patient_name_no[$medications_id[$i]]    =  $patient_name_nox[$patient_id[$medications_id[$i]]];
             $medicine_name[$medications_id[$i]]    = $medicine_namex[$medicine_id[$medications_id[$i]]];
             $formula_name[$medications_id[$i]]    = $formulars_namex[$formula_id[$medications_id[$i]]];
       }

         $data = compact(
             'medications_id','glucosevalue','patient_id','countPatients','countPatientsteated','temperature','weight','dosage','notes','created_at','updated_at','patient_name','medicine_name','formula_name',
             'patientsdatatable','medicinesdatatable','formularsdatatable','patient_name_no','temperature','weight','medicationsdatatable'
            );
           
        return view('doctors.medications.index',$data);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'medicine_id' =>'required',
            'formula_id' =>'required',
            'dosage' =>'required',
            'notes' =>'required',
             'temperature' =>'required',
             'weight' =>'required',
           
            ]);     
            
         
       
    $medications = new Medication();

         $medications->patient_id = $request['patient_id'];
         $medications->medicine_id = $request['medicine_id'];
         $medications->formula_id = $request['formula_id'];
         $medications->dosage = $request['dosage'];
         $medications->notes= $request['notes'];
         $medications->temperature = $request['temperature'];
         $medications->weight= $request['weight'];
       
       
    // add other fields
    $medications->save();

           Session::flash('success','Patient successfuly  Created.');
            return redirect()->route('medications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($medications_id)
    {
        $users = DB::table('medications')
        
                ->select('medicines_type','formular_type','medications.created_at','dosage')

                ->join('medicines', 'medicines.id','=','medications.medicine_id')
                ->join('formulars', 'medications.formula_id', '=', 'formulars.id')
                ->where('patient_id', $medications_id)
                ->groupBy('medications.created_at')
                ->get();

           /*  foreach($users as $user ){
                $userdata[] = $user ->medicines_type;
                $userdata[] = $user ->formular_type;
                $userdata[] = $user ->created_at;
                $userdata[] = $user ->dosage;
            } */
            
        $data =compact('users','userdata');

            
               return view('doctors.medications.show', $data);
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
            'medicine_id' =>'required',
            'formula_id' =>'required',
            'dosage' =>'required',
            'notes' =>'required',
            'temperature' =>'required',
            'weight' =>'required',
           
            ]);         
       
            $medications =Medication::find($id);

                $medications->patient_id = $request['patient_id'];
                $medications->medicine_id = $request['medicine_id'];
                $medications->formula_id = $request['formula_id'];
                $medications->dosage = $request['dosage'];
                $medications->notes= $request['notes'];
                $medications->temperature = $request['temperature'];
                $medications->weight= $request['weight'];
            
            // add other fields
            $medications->save();

                     Session::flash('success','Patient Medication successfuly  Updated.');
                    return redirect()->route('medications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medication =Medication::find($id);
        $medication->delete();
        
        Session::flash('success','Patient Medication successfuly  Removed.');
        return redirect()->route('medications.index');
    }
}
