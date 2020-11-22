<?php

namespace App\Http\Controllers\Laboratories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Feet;
use Session;
use DB;

class FeetsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:laboratory');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $complicationsdatatable =DB::table('complications') ->get();
        $datacomplicationsarray  =json_decode(json_encode($complicationsdatatable), true);

        for ($i=0; $i <count($datacomplicationsarray) ; $i++) { 
            
            $complications_idx[$i]                     =$datacomplicationsarray[$i]['id'];
            $complications_namex[$complications_idx[$i]]     =$datacomplicationsarray[$i]['complication_type'];
           
        }

      /*  patientdata */

        $datapatientstable =DB::table('patients') ->get();
        $datapatientsarray  =json_decode(json_encode($datapatientstable), true);

        for ($i=0; $i <count($datapatientsarray) ; $i++) { 
            
            $patient_idx[$i]                     =$datapatientsarray[$i]['id'];
            $patient_namex[$patient_idx[$i]]     =$datapatientsarray[$i]['patient_name'];
            $patient_nox[$patient_idx[$i]]       =$datapatientsarray[$i]['patient_no'];
        }

        
      /*  feetdata table */
        $datafeetstable = DB::table('feets')->get();
        $datafeetsarray =json_decode(json_encode($datafeetstable),true);

        for ($i=0; $i <count($datafeetsarray) ; $i++) { 

            $feets_id[$i]                 =$datafeetsarray[$i]['id'];
            $feet[$feets_id[$i]]   = $datafeetsarray[$i]['feet'];
            $patient_id[$feets_id[$i]]    =$datafeetsarray[$i]['patient_id'];
            $next_visit[$feets_id[$i]]    =$datafeetsarray[$i]['next_visit'];
            $created_at[$feets_id[$i]]    =$datafeetsarray[$i]['created_at'];
            $updated_at[$feets_id[$i]]    =$datafeetsarray[$i]['updated_at'];
            $complications_id[$feets_id[$i]]    =$datafeetsarray[$i]['complications_id'];
            $complications_name[$feets_id[$i]]    =$complications_namex[$complications_id[$feets_id[$i]]];
            $patient_name[$feets_id[$i]]    =$patient_namex[$patient_id[$feets_id[$i]]];
            $patient_no[$feets_id[$i]]    =$patient_nox[$patient_id[$feets_id[$i]]];
        }
        
       /*  $feetspoints = explode(",", $feetspoints);  */

        $data =compact('feets_id','feet','next_visit','created_at','updated_at','patient_name',
        'patient_no','datapatientstable','complications_name','complicationsdatatable','feet');




        return view('laboratories.feets.index',$data);
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
        $this ->validate($request,[
            'patient_id' =>'required',
            'feet'     =>'required',
          
          //  'next_visit'      =>'required',         
            'complications_id'=>'required',
            
]); 

   $feet = implode(",", $request->input('feet'));  
    
            $status = Feet::create([
                'patient_id' => $request->get('patient_id'),
                'next_visit' => Carbon::now()->addDays(30),
                'complications_id' => $request->get('complications_id'),
                'feet' =>  $feet,
            ]);    
   
    if($status) 
    {
        Session::flash('success','Patient Feets successfully saved');
    } else {
        Session::flash('flash_message','Error!');
    }
                     
       // alert()->success('Patient Feets successfully saved.', 'Thanks!'); 
         return redirect() ->route('feets.index');
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
        $this ->validate($request,[
            'patient_id' =>'required',
            'feet'     =>'required',
          //  'next_visit'      =>'required',         
            'complications_id'=>'required',
        ]);
        
    $feet = implode(",", $request->input('feet')); 

    $status = Feet::find($id)->update([
        'patient_id' => $request->get('patient_id'),
        'next_visit' => Carbon::now()->addDays(30),
        'complications_id' => $request->get('complications_id'),
        'feet' =>  $feet,
    ]);

    if($status) 
    {
        Session::flash('success','Patient Feets successfully Updated');
    } else {
        Session::flash('flash_message','Error!');
    }
                     
       // alert()->success('Patient Feets successfully Updated.', 'Thanks!'); 
         return redirect() ->route('feets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feets = Feet::find($id);
        $feets->delete();
        
        Session::flash('success','Patient Feets successfuly  Removed.');
        return redirect()->route('feets.index');
    }
}
