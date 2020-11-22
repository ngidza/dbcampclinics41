<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patients;
use App\Weight;
use App\Weist;
use App\Food;
use App\Exercise;
use App\Glucoses;
use Session;
use DB;
//
class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         //clinictest_results table
       $clinictestresultsdatatable =DB::table('clinictest_results')->get();
       $clinictestresultsdataarray =json_decode(json_encode($clinictestresultsdatatable), true);

       for ($i=0; $i < count($clinictestresultsdataarray) ; $i++) { 

           $clinictest_results_idx[$i]                                    =$clinictestresultsdataarray[$i]['id'];
           $patient_clinic_test_typex[$clinictest_results_idx[$i]]     =$clinictestresultsdataarray[$i]['clinic_results'];

       }
         //classifications table
       $classificationsdatatable =DB::table('classifications')->get();
       $classificationsdataarray =json_decode(json_encode($classificationsdatatable), true);

       for ($i=0; $i < count($classificationsdataarray) ; $i++) { 

           $classifications_idx[$i]                                    =$classificationsdataarray[$i]['id'];
           $patient_classification_typex[$classifications_idx[$i]]     =$classificationsdataarray[$i]['classifications_type'];

       }
        
        //complications table
       $complicationsdatatable =DB::table('complications')->get();
       $complicationsdataarray =json_decode(json_encode($complicationsdatatable), true);

       for ($i=0; $i < count($complicationsdataarray) ; $i++) { 

           $complications_idx[$i]                             =$complicationsdataarray[$i]['id'];
           $patient_medical_typex[$complications_idx[$i]]     =$complicationsdataarray[$i]['complication_type'];

       }
        
        //referral table
       $referralsdatatable =DB::table('referrals')->get();
       $referralsdataarray =json_decode(json_encode($referralsdatatable), true);

       for ($i=0; $i < count($referralsdataarray) ; $i++) { 

           $referral_idx[$i]                             =$referralsdataarray[$i]['id'];
           $patient_reference_typex[$referral_idx[$i]]   =$referralsdataarray[$i]['referrals_type'];

       }

       //patients tables
       $patientsdatatable =DB::table('patients')->latest()->get();
       $patientsdataarray =json_decode(json_encode($patientsdatatable), true);

       for ($i=0; $i < count($patientsdataarray); $i++) { 

           $patients_id[$i]                   = $patientsdataarray[$i]['id'];
           $patient_name[$patients_id[$i]]     =$patientsdataarray[$i]['patient_name'];
           $patient_dob[$patients_id[$i]]     =$patientsdataarray[$i]['patient_dob'];
           $patient_no[$patients_id[$i]]     =$patientsdataarray[$i]['patient_no'];
           $patient_addres[$patients_id[$i]]     =$patientsdataarray[$i]['patient_addres'];
           $patient_reference_id[$patients_id[$i]]     =$patientsdataarray[$i]['reference_id'];
           $patient_classification_id[$patients_id[$i]]     =$patientsdataarray[$i]['classification_id'];
           $patient_medical_id[$patients_id[$i]]     =$patientsdataarray[$i]['medical_id'];
           $patient_clinic_test_id[$patients_id[$i]]     =$patientsdataarray[$i]['clinic_test_id'];
           $patient_date_dignised[$patients_id[$i]]     =$patientsdataarray[$i]['date_dignised'];
           $patient_created_at[$patients_id[$i]]     =$patientsdataarray[$i]['created_at'];
           $patient_updated_at[$patients_id[$i]]     =$patientsdataarray[$i]['updated_at'];
           $patient_reference_type[$patients_id[$i]] =$patient_reference_typex[$patient_reference_id[$patients_id[$i]]];
           $patient_classification_type[$patients_id[$i]] = $patient_classification_typex[$patient_classification_id[$patients_id[$i]]];
           $patient_medical_type[$patients_id[$i]]      =$patient_medical_typex[$patient_medical_id[$patients_id[$i]]];
           $patient_clinic_test_type[$patients_id[$i]]  =$patient_clinic_test_typex[$patient_clinic_test_id[$patients_id[$i]]];

       }

       $data = compact(
           'patient_clinic_test_type','patient_medical_type','patient_classification_type','patient_reference_type',
           'patient_updated_at','patient_created_at','patient_date_dignised','patient_addres','patient_no','patient_dob',
           'patient_name','patients_id','referralsdatatable','classificationsdatatable','clinictestresultsdatatable',
           'complicationsdatatable'
        );
        //dd($data);
        return view('receptions.index',$data);
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
            'patient_name' =>'required',
            'patient_dob' =>'required|date|before:yesterday',
            'patient_addres' =>'required',
            'reference_id' =>'required',
            'classification_id' =>'required',
            'medical_id' =>'required',
            'date_dignised' =>'required|date|before:yesterday',
            'clinic_test_id' =>'required'
            ]); 
            
        $patientx['patient_name'] = $request['patient_name'];
         $patientx['patient_dob'] = $request['patient_dob'];
         $patientx['patient_addres'] = $request['patient_addres'];
         $patientx['reference_id'] = $request['reference_id'];
         $patientx['classification_id'] = $request['classification_id'];
         $patientx['medical_id'] = $request['medical_id'];
         $patientx['date_dignised'] = $request['date_dignised'];
         $patientx['clinic_test_id'] = $request['clinic_test_id'];  
       
    $patient= new Patients();

         $patient['patient_name'] = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['patient_name'])))));
         $patient['patient_dob'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['patient_dob'])))));
         $patient['patient_addres'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['patient_addres'])))));
         $patient['reference_id'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['reference_id'])))));
         $patient['classification_id'] =  trim(strip_tags(htmlspecialchars($patientx['classification_id'])));
         $patient['medical_id'] =  trim(htmlspecialchars($patientx['medical_id']));
         $patient['date_dignised'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['date_dignised'])))));
         $patient['clinic_test_id'] = trim(htmlspecialchars($patientx['clinic_test_id']));
         $patient['patient_no'] = uniqid();
         $patient->save();
        
        
        $patientsx = DB::table('patients')->latest()->first();
           
            $patientid = $patientsx->id;
     
            $patients = Weight::create(
               [
                   'patient_id' => $patientid,
               ]
            );
            $patient->save();

            $patients = Exercise::create(
                [
                    'patient_id' => $patientid,
                ]
             );
             $patient->save();

             $patients = Glucoses::create(
                [
                    'patient_id' => $patientid,
                ]
             );
             $patient->save();

             $patients =Food::create(
                [
                    'patient_id' => $patientid,
                ]
             );
             $patient->save();

             $patients = Weist::create(
                [
                    'patient_id' => $patientid,
                ]
             );

            if ($patient->save()) {
                Session::flash('success','Patient successfuly  Added.');
                return redirect()->route('patients.index');
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
     * @param  int  $id`
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
            'patient_name' =>'required',
            'patient_dob' =>'required|date|before:yesterday',
            'patient_addres' =>'required',
            'reference_id' =>'required',
            'classification_id' =>'required',
            'medical_id' =>'required',
            'date_dignised' =>'required|date|before:yesterday',
            'clinic_test_id' =>'required'
            ]);    
            
            $patientx['patient_name'] = $request['patient_name'];
            $patientx['patient_dob'] = $request['patient_dob'];
            $patientx['patient_addres'] = $request['patient_addres'];
            $patientx['reference_id'] = $request['reference_id'];
            $patientx['classification_id'] = $request['classification_id'];
            $patientx['medical_id'] = $request['medical_id'];
            $patientx['date_dignised'] = $request['date_dignised'];
            $patientx['clinic_test_id'] = $request['clinic_test_id'];  
           
            $patient =Patients::find($id);
            
            $patient['patient_name'] = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['patient_name'])))));
            $patient['patient_dob'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['patient_dob'])))));
            $patient['patient_addres'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['patient_addres'])))));
            $patient['reference_id'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['reference_id'])))));
            $patient['classification_id'] =  trim(strip_tags(htmlspecialchars($patientx['classification_id'])));
            $patient['medical_id'] =  trim(htmlspecialchars($patientx['medical_id']));
            $patient['date_dignised'] =  trim(ucfirst(strtolower(strip_tags(htmlspecialchars($patientx['date_dignised'])))));
            $patient['clinic_test_id'] = trim(htmlspecialchars($patientx['clinic_test_id']));
            
            //$patient->patient_no = uniqid();
       // add other fields
       if ($patient->save()) {
       
            Session::flash('success','Patient successfuly  Updated.');
            return redirect()->route('patients.index');
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
      
        $patient =Patients::find($id);
        $patient ->delete();

        Session::flash('success','Patient successfuly  Deleted.');
        return redirect()->route('patients.index');

    }
}
