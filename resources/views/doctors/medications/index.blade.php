@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                
                             <a  href="{{ route('admin.dashboard')}}" class="btn btn-success btn-sm">Medications</a>
                            
                                    
      
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatientM">
                    Patient Medication                                                                                                       
                    </button>
             </div>
                       
                <div class="card-body">
                <div class="row">
                      

                         <div class="col-md-4"> 
                            <div class="card  box-shadow">
                                                                                                                                 
                            <small style ="font-size: 12px; color:green; text-align: center;"> Patients Treated </small>   <p  style ="font-size: 50px; color:Green; text-align: center;" > {{$countPatientsteated}}</p>                                                                               
                                 
                            </div>
                        </div>

                       <div class="col-md-4"> 
                            <div class="card box-shadow">
                                                                                                                                 
                                 <small style ="font-size: 12px; color:Tomato; text-align: center;"> Waiting Patients </small>  <p  style ="font-size: 50px; color:Tomato; text-align: center;" > {{$countPatients}}</p>                                                                               
                                 
                            </div>
                        </div>

                     </div> 
              

                <table  id="myTable"  class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                        <!--                 <th>#:</th> -->
                                        <th>ID:</th>
                                        <th>Patient:</th>
                                        <th>Temp:</th>                                    
                                        <th>Weight:</th>
                                        <th>Glucose</th>
                                        <th>Medicine:</th>                                    
                                        <th>Formular:</th>
                                        <th>Dosage:</th>
                                        <th>Notes:</th>                                                                        
                                        <th></th>
                                        <th></th>                                    
                                        <th></th>
                                        
                                    </tr>
                                </thead> 
                                <tbody>
                                @for($i =0; $i< count($medications_id); $i++)
                                    <tr>
                                        <!-- <td>{{$i + 1 }}</td> -->
                                        <td>{{$patient_name_no[$medications_id[$i]]}}</td>
                                        <td>{{$patient_name[$medications_id[$i]] }}</td>
                                        <td>{{ $temperature[$medications_id[$i]] }}
                                       
                                                @switch($temperature[$medications_id[$i]] )

                                                        @case($temperature[$medications_id[$i]] < 36)
                                                            <i class="fa fa-flag fa-fw" style="color:black" aria-hidden="true"> </i>
                                                        @break

                                                        @case($temperature[$medications_id[$i]] < 39)
                                                        <i class="fa fa-flag fa-fw" style="color:blue" aria-hidden="true"> </i>
                                                        @break

                                                        @case($temperature[$medications_id[$i]] >39)
                                                        <i class="fa fa-flag fa-fw" style="color:red" aria-hidden="true"> </i>
                                                        @break
                                                    
                                                        @default
                                                        <p>Error</p>
                                                @endswitch 
                                        </td>
                                        <td>{{ $weight[$medications_id[$i]]}}</td>
                                        <td>{{ $glucosevalue[$medications_id[$i]] }}</td>
                                        <td>{{ $medicine_name[$medications_id[$i]] }}</td>
                                        <td>{{ $formula_name[$medications_id[$i]]}}</td>
                                        <td>{{$dosage[$medications_id[$i]] }}</td>
                                        <td>{{ $notes[$medications_id[$i]] }}</td>                                     
                                        <td>
 <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientM_<?php print_r($medications_id[$i]); ?>">
    <i class="fa fa-pencil"></i>
    </button>
                                      </td>  
                                       <td>        
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientM_<?php print_r($medications_id[$i]); ?>" >
         <i class="fa fa-eye"></i>
    </button>                       
                                       </td>  
                                       <td>
                                      
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientM_<?php print_r($medications_id[$i]); ?>" >
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

<!-- Modal New Patient Medications -->
<div class="modal fade" id="addPatientM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient Medications</h4>
      </div>
      <div class="modal-body">
      <form id="form" method="POST" action="{{ route('medications.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Patient name') }}</label>
                           
                            <div class="col-md-6">
                                 <select class="selectpicker" data-style="btn-info"  data-live-search="true" name="patient_id"  id="">
                                    @foreach($patientsdatatable as $patients )
                                    <option value="{{$patients ->id}}">{{$patients ->patient_name}}</option>
                                    @endforeach
                                 </select>


                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="temperature" class="col-md-4 col-form-label text-md-right">{{ __('Temperature') }}</label>

                            <div class="col-md-6">
                            <input id="temperature" type="text" data-style="btn-info" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" name="temperature" data-parsley-range="[35, 40]" required>

                                @if ($errors->has('temperature'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('temperature') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                          <div class="form-group row">
                            <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>
                            
                            <div class="col-md-6">
                            <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" data-parsley-range="[50, 150]" required>   
                              
                                @if ($errors->has('weight'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="medicine_id" class="col-md-4 col-form-label text-md-right">{{ __('Medications') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" data-style="btn-info" name="medicine_id" id="">
                                    @foreach($medicinesdatatable as $medicines )
                                         <option value="{{$medicines ->id}}">{{$medicines ->medicines_type}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('medicine_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('medicine_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="formula_id" class="col-md-4 col-form-label text-md-right">{{ __('Formulars') }}</label>
                            
                            <div class="col-md-6">
                                 <select class ="form-control" name="formula_id" id="">
                                    @foreach($formularsdatatable as $formulars )
                                         <option value="{{$formulars ->id}}">{{$formulars ->formular_type}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('formula_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('formula_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dosage" class="col-md-4 col-form-label text-md-right">{{ __('Dosage') }}</label>

                            <div class="col-md-6">
                                <input id="dosage" type="text" class="form-control{{ $errors->has('dosage') ? ' is-invalid' : '' }}" name="dosage" data-parsley-required data-parsley-maxlength="5">

                                @if ($errors->has('dosage'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dosage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                            <div class="col-md-6">
                            <input id="notes" type="text" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes" required>

                                @if ($errors->has('notes'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                             </button>

                         </div> 
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->

@for($i =0; $i < count($medications_id); $i++)
<!-- Modal Edit Patient Medications -->
<div class="modal fade" id="editPatientM_<?php print_r($medications_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient Medications</h4>
      </div>
      <div class="modal-body">
      <form  id="form" data-parsley-validate role ="form" method="POST" action="{{ route('medications.update',$medications_id[$i]) }}">
                     {{method_field('PATCH')}} 
                        @csrf
                           
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 col-form-label text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                            <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no" value="{{$patient_name_no[$medications_id[$i]]}}" disabled>
 
                                @if ($errors->has('patient_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Patient name') }}</label>

                            <div class="col-md-6">
                            <input id="patient_id" type="text" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value="{{$patient_name[$medications_id[$i]]}}" disabled>
                            <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value="{{$patient_id[$medications_id[$i]]}}">
 
                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="temperature" class="col-md-4 col-form-label text-md-right">{{ __('Temperature') }}</label>

                            <div class="col-md-6">
                            <input id="temperature" type="text" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" name="temperature" value ="{{ $temperature[$medications_id[$i]] }}" data-parsley-range="[35, 40]">

                                @if ($errors->has('temperature'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('temperature') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                          <div class="form-group row">
                            <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>
                            
                            <div class="col-md-6">
                            <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight"  value ="{{ $weight[$medications_id[$i]] }}" data-parsley-range="[50, 150]" >   
                              
                                @if ($errors->has('weight'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>          
            
                        <div class="form-group row">
                            <label for="medicine_id" class="col-md-4 col-form-label text-md-right">{{ __('Medications') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="medicine_id" id="">
                                    @foreach($medicinesdatatable as $medicines )
                                         <option value="{{$medicines ->id}}">{{$medicines ->medicines_type}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('medicine_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('medicine_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="formula_id" class="col-md-4 col-form-label text-md-right">{{ __('Formulars') }}</label>
                            
                            <div class="col-md-6">
                                 <select class ="form-control" name="formula_id" id="">
                                    @foreach($formularsdatatable as $formulars )
                                         <option value="{{$formulars ->id}}">{{$formulars ->formular_type}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('formula_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('formula_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dosage" class="col-md-4 col-form-label text-md-right">{{ __('Dosage') }}</label>

                            <div class="col-md-6">
                                <input id="dosage" type="text" class="form-control{{ $errors->has('dosage') ? ' is-invalid' : '' }}" name="dosage"  value ="{{  $dosage[$medications_id[$i]]}}" data-parsley-required data-parsley-maxlength="5">

                                @if ($errors->has('dosage'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dosage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                            <div class="col-md-6">
                            <input id="notes" type="text" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes" value ="{{ $notes[$medications_id[$i]] }}" required>

                                @if ($errors->has('notes'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            
               <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                             </button>

                         </div> 
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->
@endfor

@for($i =0; $i < count($medications_id); $i++)
<!-- Modal View Patient Medications -->
<div class="modal fade" id="viewPatientM_<?php print_r($medications_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Medications</h4>
      </div>
      <div class="modal-body">
      <form>
                        @csrf

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4  text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">
                                    {{$patient_name_no[$medications_id[$i]]}}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4  text-md-right"><strong>{{ __('Patient Name') }}</strong></label>

                            <div class="col-md-6">

                                    {{ $patient_name_no[$medications_id[$i]] }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="medicine" class="col-md-4  text-md-right"><strong>{{ __('Medications') }}</strong></label>

                            <div class="col-md-6">
                            
                                {{ $medicine_name[$medications_id[$i]] }}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="formular" class="col-md-4 text-md-right"><strong>{{ __('Formulars') }}</strong></label>
                            
                            <div class="col-md-6">
                                     {{ $formula_name[$medications_id[$i]]  }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dosage" class="col-md-4 text-md-right"><strong>{{ __('Dosage') }}</strong></label>

                            <div class="col-md-6">
                                       {{ $dosage[$medications_id[$i]] }}
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="notes" class="col-md-4 text-md-right"><strong>{{ __('Notes') }}</strong></label>

                            <div class="col-md-6">
                                    {{ $notes[$medications_id[$i]] }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notes" class="col-md-4 text-md-right"><strong>{{ __('Date Diagnosed') }}</strong></label>

                            <div class="col-md-6">
                                    {{ $created_at[$medications_id[$i]] }}
                            </div>
                        </div>
                       <!-- visits and type of medication , github-->
                        <div class="modal-footer">
                        <a href="{{ route('medications.show', $patient_id[$medications_id[$i]])}}" class="btn btn-success" >Patient History</a>
                          
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>  

                         </div> 

                         
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->
@endfor

@for($i=0; $i < count($medications_id); $i++)
<!-- Modal Delete Patient Medications -->
<div class="modal fade" id="deletePatientM_<?php print_r($medications_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Medications</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('medications.destroy',$medications_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                       
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4  text-md-right"><strong>{{ __($patient_name[$medications_id[$i]]) }}</strong></label>

                            <div class="col-md-6">

                                    {{__($patient_name_no[$medications_id[$i]]) }}

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
           


@endsection
