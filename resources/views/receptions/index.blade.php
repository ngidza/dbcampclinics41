@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
               <a href="{{route('home')}}" class="btn btn-success btn-sm">Receptionist Dashboard</a>
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatient">
  Add Patient
</button>
                </div>
                
                <div class="card-body">
                <table  id="myTable"  class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#:</th>
                                        <th>ID:</th>
                                        <th>Patient:</th>
                                        <th>D.O.B:</th>                                    
                                        <th>Referral Reason:</th>
                                        <th>Classified:</th>
                                        <th>Clinical Tests:</th>
                                         <th>Complications:</th>                                    
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead> 
                       
                                <tbody>
                                @for($i =0; $i < count($patients_id); $i++)  
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$patient_no[$patients_id[$i]]}}</td>
                                        <td>{{ $patient_name[$patients_id[$i]]}}</td>
                                        <td>{{$patient_dob[$patients_id[$i]] }}</td>
                                        <td>{{$patient_reference_type[$patients_id[$i]]}}</td>
                                        <td>{{$patient_classification_type[$patients_id[$i]]}}</td>
                                        <td>{{$patient_clinic_test_type[$patients_id[$i]]}}</td>
                                        <td> {{$patient_medical_type[$patients_id[$i]]}}</td>
                                        <td>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatient_<?php print_r($patients_id[$i]); ?>"
     >
    <i class="fa fa-pencil"></i>
    </button>
                                        </td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatient_<?php print_r($patients_id[$i]); ?>">
         <i class="fa fa-eye"></i>
    </button>            
                                        </td>
                                        <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatient_<?php print_r($patients_id[$i]); ?>"  data-id="{{$patients_id[$i]}}" 
 >
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


<!-- Modal New Patient -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient</h4>
      </div>
      <div class="modal-body">
      <form  id="form" method="POST" action="{{ route('patients.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 col-form-label text-md-right">{{ __('Patient name') }}</label>

                            <div class="col-md-6">
                                <input id="patient_name" type="text" class="form-control{{ $errors->has('patient_name') ? ' is-invalid' : '' }}" name="patient_name" value="{{ old('patient_name') }}" required autofocus>

                                @if ($errors->has('patient_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patient_addres" class="col-md-4 col-form-label text-md-right">{{ __('Patient Addres') }}</label>

                            <div class="col-md-6">
                                <input id="patient_addres" type="text" class="form-control{{ $errors->has('patient_addres') ? ' is-invalid' : '' }}" name="patient_addres" value="{{ old('patient_addres') }}" required>

                                @if ($errors->has('patient_addres'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_addres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patient_dob" class="col-md-4 col-form-label text-md-right">{{ __('Patient DOB') }}</label>

                            <div class="col-md-6">
                                <input id="patient_dob" type="date" class="form-control{{ $errors->has('patient_dob') ? ' is-invalid' : '' }}" name="patient_dob" max="2010-06-30" required>

                                @if ($errors->has('patient_dob'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_dignised" class="col-md-4 col-form-label text-md-right">{{ __('Patient Date Diagnosed') }}</label>

                            <div class="col-md-6">
                                <input id="date_dignised" type="date" class="form-control{{ $errors->has('date_dignised') ? ' is-invalid' : '' }}" name="date_dignised" max="2018-04-30" required>

                                @if ($errors->has('date_dignised'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_dignised') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="reference_id" class="col-md-4 col-form-label text-md-right">{{ __('Reason for Referral') }}</label>

                            <div class="col-md-6">
                                <select class="form-control"  name="reference_id">
                                     @foreach($referralsdatatable as $referrals)
                                       <option value="{{$referrals ->id}}">{{$referrals->referrals_type}}</option>
                                     @endforeach     
                                </select>

                                @if ($errors->has('reference_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reference_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="classification_id" class="col-md-4 col-form-label text-md-right">{{ __('Classified As') }}</label>

                            <div class="col-md-6">
                               <select class ="form-control" name="classification_id" id="">
                                    @foreach($classificationsdatatable as $classifications )
                                    <option value="{{$classifications ->id}}">{{$classifications ->classifications_type}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('classification_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('classification_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="medical_id" class="col-md-4 col-form-label text-md-right">{{ __('Complications') }}</label>

                            <div class="col-md-6">
                              <select class ="form-control" name="medical_id" id="">
                                    @foreach($complicationsdatatable as $complications)
                                    <option value="{{$complications->id}}">{{ $complications->complication_type}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('medical_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('medical_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clinic_test_id" class="col-md-4 col-form-label text-md-right">{{ __('Clinic Test Results') }}</label>

                            <div class="col-md-6">
                            <select class ="form-control" name="clinic_test_id" id="">
                                    @foreach($clinictestresultsdatatable as $clinictestresults)
                                    <option value="{{$clinictestresults ->id}}">{{$clinictestresults->clinic_results}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('clinic_test_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clinic_test_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                             </button>

                         </div> 
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->


@for($i = 0; $i < count($patients_id); $i++)

<div class="modal fade" id="editPatient_<?php print_r($patients_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient Record</h4>
      </div>
             <div class="modal-body"> 
                 <form id ="form" action="{{ route('patients.update', $patients_id[$i]) }}" method="post">
                    {{method_field('PATCH')}}  
                        @csrf
                       <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                                <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no" value="{{ $patient_no[$patients_id[$i]]  }}" disabled>

                                @if ($errors->has('patient_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 col-form-label text-md-right">{{ __('Patient name') }}</label>

                            <div class="col-md-6">
                                <input id="patient_name" type="text" class="form-control{{ $errors->has('patient_name') ? ' is-invalid' : '' }}" name="patient_name" value="{{$patient_name[$patients_id[$i]]  }}" required autofocus>

                                @if ($errors->has('patient_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patient_addres" class="col-md-4 col-form-label text-md-right">{{ __('Patient Addres') }}</label>

                            <div class="col-md-6">
                                <input id="patient_addres" type="text" class="form-control{{ $errors->has('patient_addres') ? ' is-invalid' : '' }}" name="patient_addres" value="{{ $patient_addres[$patients_id[$i]]  }}" required>

                                @if ($errors->has('patient_addres'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_addres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patient_dob" class="col-md-4 col-form-label text-md-right">{{ __('Patient DOB') }}</label>

                            <div class="col-md-6">
                                <input id="patient_dob" type="date" class="form-control{{ $errors->has('patient_dob') ? ' is-invalid' : '' }}" name="patient_dob" value="{{ $patient_dob[$patients_id[$i]]   }}" max="2010-06-30" required>

                                @if ($errors->has('patient_dob'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_dignised" class="col-md-4 col-form-label text-md-right">{{ __('Patient Date Diagnosed') }}</label>

                            <div class="col-md-6">
                                <input id="date_dignised" type="date" class="form-control{{ $errors->has('date_dignised') ? ' is-invalid' : '' }}" name="date_dignised" value="{{ $patient_date_dignised[$patients_id[$i]]   }}" max="2018-04-30" required>

                                @if ($errors->has('date_dignised'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date_dignised') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="reference_id" class="col-md-4 col-form-label text-md-right">{{ __('Reason for Referral') }}</label>

                            <div class="col-md-6">
                                <select class="form-control"  name="reference_id">
                                     @foreach($referralsdatatable as $referrals)
                                       <option value="{{$referrals ->id}}">{{$referrals->referrals_type}}</option>
                                     @endforeach     
                                </select>

                                @if ($errors->has('reference_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('reference_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="classification_id" class="col-md-4 col-form-label text-md-right">{{ __('Classified As') }}</label>

                            <div class="col-md-6">
                               <select class ="form-control" name="classification_id" id="">
                                    @foreach($classificationsdatatable as $classifications )
                                    <option value="{{$classifications ->id}}">{{$classifications ->classifications_type}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('classification_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('classification_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="medical_id" class="col-md-4 col-form-label text-md-right">{{ __('Complications') }}</label>

                            <div class="col-md-6">
                              <select class ="form-control" name="medical_id" id="">
                                    @foreach($complicationsdatatable as $complications)
                                    <option value="{{$complications->id}}">{{ $complications->complication_type}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('medical_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('medical_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clinic_test_id" class="col-md-4 col-form-label text-md-right">{{ __('Clinic Test Results') }}</label>

                            <div class="col-md-6">
                            <select class ="form-control" name="clinic_test_id" id="">
                                    @foreach($clinictestresultsdatatable as $clinictestresults)
                                    <option value="{{$clinictestresults ->id}}">{{$clinictestresults->clinic_results}}</option>
                                    @endforeach
                               </select>

                                @if ($errors->has('clinic_test_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clinic_test_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                             </button>
                          
                    </div> 
                 </form>
            </div>
         </div>
     </div>
 </div>

@endfor


@for($i = 0; $i < count($patients_id); $i++)

<div class="modal fade" id="viewPatient_<?php print_r($patients_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Record</h4>
       </div>
             <div class="modal-body"> 

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Patient No') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $patient_no[$patients_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Patient Name') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{  $patient_name[$patients_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Patient Address') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{ $patient_addres[$patients_id[$i]]   }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Patient DOB') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $patient_dob[$patients_id[$i]]  }} 
                                                        
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Reason for Referral') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $patient_reference_type[$patients_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Classified As') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{ $patient_classification_type[$patients_id[$i]]   }} 
                                                        
                            </div>
                        </div>

                           <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Complications') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $patient_medical_type[$patients_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Clinic Test Results') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{  $patient_clinic_test_type[$patients_id[$i]]   }} 
                                                        
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Date Referred') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $patient_created_at[$patients_id[$i]] }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Updated On') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{  $patient_updated_at[$patients_id[$i]]  }} 
                                                        
                            </div>
                        </div> 

                         <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                

                         </div>                 
                 </div>
             </div>
      </div>
 </div>

@endfor

@for($i =0; $i < count($patients_id); $i++)
<!-- Modal Delete Patient -->
<div class="modal fade" id="deletePatient_<?php print_r($patients_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Record</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('patients.destroy', $patients_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                       
                        <p> Are you sure you want to delete? </p>

                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 text-md-right"><strong>{{  $patient_name[$patients_id[$i]] }}</strong></label>

                            <div class="col-md-6">
                               
                                     {{$patient_no[$patients_id[$i]]}} 

                               
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No, Close</button>
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Yes, Delete') }}
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
