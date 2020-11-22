@extends('layouts.app')

@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <a href="{{route('laboratory.dashboard')}}" class="edit-modal btn btn-info btn-sm" >Feet Examination</a>
                <button class="edit-modal btn btn-info btn-sm" style="float: right;" data-toggle ="modal" data-target="#addPatientF-modal-lg">
                          <i class="fa fa-plus" aria-radio="true"></i> Examine Feet     
                 </button>
                </div>

                <div class="card-body">
                         <table  id="myTable" class="display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ID:</th>
                                                    <th>Patient:</th>
                                                    <th>Risk Category:</th>
                                                    <th>Refered:</th>                            
                                                    <th>Complications:</th> 
                                                    <th>Next Visit:</th>                            
                                                    <th></th>
                                                     <th></th>
                                                    <th></th>
                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                @for($i =0; $i < count($feets_id); $i++)
                                                <tr>
                                                    <td>{{$i + 1}}</td>
                                                    <td>{{$patient_no[$feets_id[$i]]}}</td>
                                                    <td>{{$patient_name[$feets_id[$i]] }}</td>
                                                    <td> 
                                                    @switch(mb_strlen($feet[$feets_id[$i]]))

                                                        @case(mb_strlen($feet[$feets_id[$i]]) < 4)
                                                            <p style="color:navy">0 = No loss of protective sensation</p>
                                                        @break

                                                        @case(mb_strlen($feet[$feets_id[$i]]) < 7)
                                                            <p style="color:blue">1 = Loss of protective sensation</p>
                                                        @break

                                                        @case(mb_strlen($feet[$feets_id[$i]]) < 12)
                                                            <p style="color:maroon">2 = Weakness, deformity,pre-ulcer or callus</p>
                                                        @break

                                                        @case(mb_strlen($feet[$feets_id[$i]]) > 12)
                                                            <p style="color:red">3 = Ulceration or neuropathic fracture</p>
                                                        @break

                                                        @default
                                                            <p style="color:fuchsia"> = Default Add Another click</p>
                                                        @endswitch
                                                    
                                                    </td>                                        
                                                    <td> @switch(mb_strlen($feet[$feets_id[$i]]))

                                                            @case(mb_strlen($feet[$feets_id[$i]]) < 4)
                                                                <p style="color:blue">	Primary Care Provider</p>
                                                            @break
                                                            @case(mb_strlen($feet[$feets_id[$i]]) < 7)
                                                                <p style="color:green">Podiatrist</p>
                                                            @break

                                                            @case(mb_strlen($feet[$feets_id[$i]]) < 12)
                                                                <p style="color:red">Endrocrinologist</p>
                                                            @break

                                                            @case(mb_strlen($feet[$feets_id[$i]]) < 15)
                                                                <p style="color:navy">Orthotis</p>
                                                            @break

                                                            @case(mb_strlen($feet[$feets_id[$i]]) < 17)
                                                                <p style="color:fuchsia">Certified Diabetes Educator</p>
                                                            @break

                                                            @case(mb_strlen($feet[$feets_id[$i]]) > 17)
                                                                <p style="color:maroon">Vascular surgeon</p>
                                                            @break

                                                            @default
                                                                <p> others</p>
                                                            @endswitch
                                                            </td>
                                                    <td>{{ $complications_name[$feets_id[$i]] }}</td>
                                                    <td>{{$next_visit[$feets_id[$i]] }}</td>
                                                    <td>
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientF-modal-lg_<?php print_r($feets_id[$i]); ?>" >
    <i class="fa fa-pencil"></i>
    </button>
                                                  </td>
                                                  <td>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientFeet_<?php print_r($feets_id[$i]); ?>">
         <i class="fa fa-eye"></i>
    </button>               
                                                   </td>
                                                   <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientF_<?php print_r($feets_id[$i]); ?>">
        <i class="fa fa-trash-o"></i>
    </button> 
                                                   </td>                                              
                                                </tr>
                                @endfor
                                            </tbody>
                           </table>
                     
                </div>
            </div>
        </div>
    </div>
</div>

 <div id="addPatientF-modal-lg" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Feet Examination</h4>
        </div>
        <div class="modal-body">
        <div class='row'>
        <div class="col-md-12">
           
        <form class="form-horizontal" role="form" method="POST" action ="{{ route('feets.store') }}">
                        {{ csrf_field('GET') }}
                        @csrf 
                        <div class="form-control">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="patient_id" class="col-md-6 col-form-label text-md-right">{{ __('Patient Name:') }}</label>

                                    <div class="col-md-6">
                                    <select class="form-control" name ="patient_id">
                                            @foreach($datapatientstable as $patients)
                                                <option value ="{{$patients->id}}">{{$patients->patient_name}}</option>
                                        @endforeach
                                    </select> 

                                        @if ($errors->has('patient_id'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('patient_id') }}</strong>
                                            </span>
                                        @endif
                                     </div>
                                 </div>
                            </div>
                          
                        <div class="col-md-6"> 
                             
                        <div class="form-group row">
                            <label for="complications_id" class="col-sm-6 col-form-label text-md-right">Medical Issues</label>

                            <div class="col-md-6">
                            <select class="form-control" name ="complications_id">
                                      @foreach($complicationsdatatable  as $complication) 
                                        <option value ="{{$complication->id}}">{{$complication->complication_type}}</option>
                                        @endforeach 
                            </select>

                                @if ($errors->has('complications_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('complications_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                
                          </div>
                    <div class="form-control">
                        <div class='col-md-12'> 
                                    <div class='row' >
                                        <div class="col-md-5"> 
                                        <p><strong>check (/) the appropriate boxes below :</strong></p>
                                            <label for="">Is there a foot ulcer now? </label>
                                            <label for="">is there a history of foot ulcer? </label>
                                            <label for="">is there an abnormal shape of the foot?</label>                    
                                            <label for="">is there a callus buildup?</label>            
                                            <label for=""> Has there been a previous amputation?</label>       
                                            <label for=""> Is ther a blister or laceration??</label>                                 
                                            <label for=""> Can the patient see the botom feet?</label> 
                                            <label for=""> Does the patient use footwear appropriate</label>   
                                <hr>
                                    </div>
                  
                               <div class="col-md-2 ">
                              <p><strong>  right left</strong></p>
                              <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" data-parsley-checkmin="3" type="checkbox" name="feet[]" value="1" required > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="11"> 
                                    </div>
                                 
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="2" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="12"> 
                                    </div>
                                    
                               </label>
                              
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="3"> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="13"> 
                                    </div>
                                   
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="4"> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="14" > 
                                    </div>
                                    
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="5" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="15" > 
                                    </div>
                                   
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="6"> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="16" > 
                                    </div>
                                   
                               </label>
                             
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="7" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="17" }> 
                                    </div>
                                    
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="8" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="18"> 
                                    </div>
                                    
                               </label>
                              
                                 </div>
                               <div class="col-md-5" style="background: pink" >       
                                   
                                  <strong> Vascular Findings:(+)Present (-)Absent</strong>
                                  
                                   
                                    <li>Foot Hair <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feet[]"
                                           <?php if (isset($feet) && $feet=="9") echo "checked";?>
                                            value="9" >  <i class="fa fa-plus" aria-radio="true"></i>
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feet[]"
                                           <?php if (isset($feet) && $feet =="19") echo "checked";?>
                                            value="19" >  <i class="fa fa-minus" aria-radio="true"></i>
                                    </div>
                                   
                                    </label>  </li>
                                    <li>Capillary Refill  <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feets[]"
                                             <?php if (isset($feets) && $feets=="10") echo "checked";?>
                                            value="10" > <i class="fa fa-plus" aria-radio="true"></i>
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feets[]"
                                                <?php if (isset($feets) && $feets=="20") echo "checked";?>
                                            value="20" > <i class="fa fa-minus" aria-radio="true"></i>
                                    </div>
                                   
                                    </label> </li> 
                                     <div class="">
                                      <img src ="{{asset('images/images.jpg')}}"  height="200" width="300"/>  
                                      </div>                
                               </div>
                               
                                    <div class="col-md-8">
                                          <p><strong> Skin condtion on the footand between the toes:</strong></p> 
                                          <p>  1. Draw pattern where there is:<img src ="{{asset('images/foot.jpg')}}" height="40" width="400"/> </p>
                                          <p> 2. Label: Skin condition with <strong>R</strong> - Redness,<strong> S </strong>- Swelling, <strong>W</strong> - Warmth,<strong> D</strong> - Dryness,and/or<strong> M</strong> - Maceration </p>  
                                    </div>
                     
                         <div class="col-md-4">
                              <p><strong> follow-up Care:</strong> Schedule follow-up visit
                              Next 30 Days.

                              </p>
                             
                        </div>
                                            
                          </div>
                          <div class="modal-footer">
                                     <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                     <div class="form-group row mb-0">
                                          <div class="col-md-8 offset-md-2">
                                         <button type="submit" class="btn btn-primary">
                                                 Add Patient Foot
                                            </button>

                                     </div>
                                 </div>
                         </div>
                                  
                               
                                    </div><!--row -->
                                 </div><!--col-sm-12 -->

                  
                  
                           </form>
                        </div>                        
                    </div>
                    </div>

                </div>    
         </div>
        </div>
    </div>
</div>
</div>

@for($i=0; $i < count($feets_id); $i++)
 <div id="editPatientF-modal-lg_<?php print_r($feets_id[$i]); ?>" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Feet Examination Update</h4>
        </div>
        <div class="modal-body">
        <div class='row'>
        <div class="col-md-12">
           
        <form class="form-horizontal" role="form"  method="POST" action ="{{ route('feets.update',$feets_id[$i]) }}">
                     {{method_field('PATCH')}}  
                        @csrf  

                       
                        <div class="form-control">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="patient_id" class="col-md-6 col-form-label text-md-right">{{ __('Patient Name:') }}</label>

                                    <div class="col-md-6">
                                    <select class="form-control" name ="patient_id">
                                            @foreach($datapatientstable as $patients)
                                                <option value ="{{$patients->id}}">{{$patients->patient_name}}</option>
                                        @endforeach
                                    </select> 

                                        @if ($errors->has('patient_id'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('patient_id') }}</strong>
                                            </span>
                                        @endif
                                     </div>
                                 </div>
                            </div>

                          
                        <div class="col-md-6"> 
                             
                        <div class="form-group row">
                            <label for="complications_id" class="col-sm-6 col-form-label text-md-right">Medical Issues</label>

                            <div class="col-md-6">
                            <select class="form-control" name ="complications_id">
                                      @foreach($complicationsdatatable  as $complication) 
                                        <option value ="{{$complication->id}}">{{$complication->complication_type}}</option>
                                        @endforeach 
                            </select>

                                @if ($errors->has('complications_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('complications_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                
                          </div>
                    <div class="form-control">
                        <div class='col-md-12'> 
                                    <div class='row'>
                                    <div class="col-md-5"> 
                                    <p><strong>check (/) the appropriate boxes below :</strong></p>
                                          <label for="">Is there a foot ulcer now? </label>
                                          <label for="">is there a history of foot ulcer? </label>
                                          <label for="">is there an abnormal shape of the foot?</label>                    
                                           <label for="">is there a callus buildup?</label>            
                                           <label for=""> Has there been a previous amputation?</label>       
                                           <label for=""> Is ther a blister or laceration??</label>                                 
                                           <label for=""> Can the patient see the botom feet?</label> 
                                           <label for=""> Does the patient use footwear appropriate</label>   
                             <hr>
                                 </div>
                  
                               <div class="col-md-2" >
                              <p><strong>  right left</strong></p>
                              <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input"  type="checkbox" name="feet[]" value="1" required> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="11"> 
                                    </div>
                                 
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="2" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="12"> 
                                    </div>
                                    
                               </label>
                              
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="3"> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="13"> 
                                    </div>
                                   
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="4"> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="14" > 
                                    </div>
                                    
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="5" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="15" > 
                                    </div>
                                   
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="6"> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="16" > 
                                    </div>
                                   
                               </label>
                             
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="7" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="17" }> 
                                    </div>
                                    
                               </label>
                               <label for="">
                                     <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="8" > 
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="checkbox" name="feet[]" value="18"> 
                                    </div>
                                    
                               </label>
                              
                                 </div>
                               <div class="col-md-5" style="background: pink" >       
                                   
                                  <strong> Vascular Findings:(+)Present (-)Absent</strong>
                                  
                                   
                                    <li>Foot Hair <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feet[]"
                                           <?php if (isset($feet) && $feet=="9") echo "checked";?>
                                            value="9" >  <i class="fa fa-plus" aria-radio="true"></i>
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feet[]"
                                           <?php if (isset($feet) && $feet =="19") echo "checked";?>
                                            value="19" >  <i class="fa fa-minus" aria-radio="true"></i>
                                    </div>
                                   
                                    </label>  </li>
                                    <li>Capillary Refill  <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feets[]"
                                             <?php if (isset($feets) && $feets=="10") echo "checked";?>
                                            value="10" > <i class="fa fa-plus" aria-radio="true"></i>
                                    </div>
                                    <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="feets[]"
                                                <?php if (isset($feets) && $feets=="20") echo "checked";?>
                                            value="20" > <i class="fa fa-minus" aria-radio="true"></i>
                                    </div>
                                   
                                    </label> </li>  
                                     <div class="">
                                      <img src ="{{asset('images/images.jpg')}}"  height="200" width="300"/>  
                                      </div>                
                               </div>
                               
                                    <div class="col-md-8">
                                          <p><strong> Skin condtion on the footand between the toes:</strong></p> 
                                          <p>  1. Draw pattern where there is:<img src ="{{asset('images/foot.jpg')}}" height="40" width="400"/> </p>
                                          <p> 2. Label: Skin condition with <strong>R</strong> - Redness,<strong> S </strong>- Swelling, <strong>W</strong> - Warmth,<strong> D</strong> - Dryness,and/or<strong> M</strong> - Maceration </p>  
                                    </div>
                     
                         <div class="col-md-4">
                              <p><strong> follow-up Care:</strong> Schedule follow-up visit
                              Next 30 Days.

                              </p>
                             
                        </div>
                                            
                          </div>
                          <div class="modal-footer">
                                     <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                     <div class="form-group row mb-0">
                                          <div class="col-md-8 offset-md-2">
                                         <button type="submit" class="btn btn-primary">
                                                 Update Patient Feet
                                            </button>

                                     </div>
                                 </div>
                         </div>
                                  
                               
                                    </div><!--row -->
                                 </div><!--col-sm-12 -->

                  
                  
                           </form>
                        </div>                        
                    </div>
                    </div>

                </div>    
         </div>
        </div>
    </div>
</div>
</div>
@endfor

@for($i =0; $i < count($feets_id); $i++ )
<!-- Modal Delete Patient Feet -->  
<div class="modal fade" id="deletePatientF_<?php print_r($feets_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-radio="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Feet</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('feets.destroy',$feets_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                      
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 text-md-right"><strong>{{ __($patient_name[$feets_id[$i]]) }}</strong></label>

                            <div class="col-md-6">
                                        {{__($patient_no[$feets_id[$i]])}}
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No, Close</button>
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Yes, Submit') }}
                             </button>

                         </div> 
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->
@endfor

@for($i =0; $i < count($feets_id); $i++)
<!-- Modal View Patient Feet -->
<div class="modal fade" id="viewPatientFeet_<?php print_r($feets_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-radio="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Feet</h4>
      </div>
      <div class="modal-body">
      <form role ="form">
                    
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right"><strong>{{ __('Patient ID:') }}</strong></label>

                            <div class="col-md-6">
                                {{__($patient_no[$feets_id[$i]])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4  text-md-right"><strong>{{ __('Patient Name:') }}</strong></label>

                            <div class="col-md-6">
                                    {{__($patient_name[$feets_id[$i]])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="created_at" class="col-md-4  text-md-right"><strong>{{ __('Date Diagnosed:') }}</strong></label>

                            <div class="col-md-6">
                                      {{ __($created_at[$feets_id[$i]]) }}
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="riskcategory" class="col-md-4 col-form-label text-md-right"><strong>{{ __('Risk Category:') }}</strong></label>

                            <div class="col-md-6">
                            @switch(mb_strlen($feet[$feets_id[$i]]))

                                @case(mb_strlen($feet[$feets_id[$i]]) < 10)
                                    <p style="color:navy">0 = No loss of protective sensation</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) < 25)
                                    <p style="color:blue">1 = Loss of protective sensation</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) < 40)
                                    <p style="color:maroon">2 = Weakness, deformity,pre-ulcer or callus</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) > 40)
                                    <p style="color:red">3 = Ulceration or neuropathic fracture</p>
                                @break

                                @default
                                    <p style="color:fuchsia"> = Default Add Anther click</p>
                             @endswitch

                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="refered" class="col-md-4  text-md-right"><strong>{{ __('Refered To:') }}</strong></label>

                            <div class="col-md-6">
                            @switch(mb_strlen($feet[$feets_id[$i]]))

                                @case(mb_strlen($feet[$feets_id[$i]]) < 5)
                                    <p style="color:blue">	Primary Care Provider</p>
                                @break
                                @case(mb_strlen($feet[$feets_id[$i]]) < 10)
                                    <p style="color:green">Podiatrist</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) < 15)
                                    <p style="color:red">Endrocrinologist</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) < 20)
                                    <p style="color:navy">Orthotis</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) < 30)
                                    <p style="color:fuchsia">Certified Diabetes Educator</p>
                                @break

                                @case(mb_strlen($feet[$feets_id[$i]]) > 30)
                                    <p style="color:maroon">Vascular surgeon</p>
                                @break

                                @default
                                    <p> others</p>
                                @endswitch
                            </div>
                        </div>     
                        <div class="form-group row">
                            <label for="complications" class="col-md-4  text-md-right"><strong>{{ __('Medical History:') }}</strong></label>

                            <div class="col-md-6">
                                {{__($complications_name[$feets_id[$i]])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="updated_at" class="col-md-4 text-md-right"><strong>{{ __('Record Updated On:') }}</strong></label>

                            <div class="col-md-6">
                                    {{__($updated_at[$feets_id[$i]])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="next_visit" class="col-md-4 text-md-right"><strong>{{ __('Next Checkup Visit:') }}</strong></label>

                            <div class="col-md-6">
                                     {{__( $next_visit[$feets_id[$i]] )}}
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No, Close</button>
                               

                         </div> 
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->

@endfor
@endsection
