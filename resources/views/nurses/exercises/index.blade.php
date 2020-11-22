@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                <a href="{{url('nurse')}}" class="btn btn-success btn-sm" >  Exercise</a>
                     <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatientEx">
                         Patient  Exercise
                    </button>
                </div>
  
                <div class="card-body">
                  <table  id="myTable"  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Patient Name</th>
                            <th>Activities</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Intensity</th>
                            <th>Notes</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    @for($i =0; $i< count($exercises_id); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$patient_name_no[$exercises_id[$i]]}}</td>
                            <td>{{$patient_name[$exercises_id[$i]]}}</td>
                            <td>{{$activity_name[$exercises_id[$i]]}} </td>
                            <td> {{ date("m-d-Y", strtotime( $created_at[$exercises_id[$i]] )) }} </td>
                            <td>{{$value[$exercises_id[$i]] }} mins</td> 
                            <td>{{$distance[$exercises_id[$i]] }} m</td>                                                   
                            <td>
                            @if($distance[$exercises_id[$i]] < 30)
                                    <p style="color:navy"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Do Much  </p>                             

                                    @elseif($distance[$exercises_id[$i]]< 45)
                                    <p style="color:blue"> Good</p>                                

                                    @elseif($distance[$exercises_id[$i]] < 90)
                                    <p style="color:mahogany"> Normal  </p>
                                   
                                    @elseif($distance[$exercises_id[$i]] < 120)
                                    <p style="color:lime"> Expected </p>                       

                                    @elseif($distance[$exercises_id[$i]] < 180)
                                    <p style="color:maroon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Standard</p>
                                   
                                    @elseif($distance[$exercises_id[$i]] > 180)
                                    <p style="color:red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Excessive</p>
                                   
                                    @else
                                    <p>Error</p>

                                   @endif
                        </td>
                           
                            <td>
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientEx_<?php print_r($exercises_id[$i]); ?>" >
    <i class="fa fa-pencil"></i>
    </button>
                                        </td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientEx_<?php print_r($exercises_id[$i]); ?>" >
         <i class="fa fa-eye"></i>
    </button>            
                                        </td>
                                        <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientEx_<?php print_r($exercises_id[$i]);?>">
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

<!-- Modal New Patient Excercises -->
<div class="modal fade" id="addPatientEx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient  Exercise</h4>
      </div>
      <div class="modal-body">
      <form id ="form" method="POST" action="{{ route('excercise.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Patient name') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="patient_id" id="">
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
                            <label for="activity_id" class="col-md-4 col-form-label text-md-right">{{ __('Activities') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="activity_id" id="">
                                    @foreach($activitiesdatatable  as  $activities)
                                         <option value="{{$activities->id}}">{{ $activities ->activity}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('activity_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('activity_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Intensity') }}</label>
                            
                            <div class="col-md-6">
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" data-parsley-range="[45, 270]" required>   
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="distance" class="col-md-4 col-form-label text-md-right">{{ __('Distance') }}</label>
                            
                            <div class="col-md-6">
                            <input id="distance" type="text" class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}" name="distance" data-parsley-range="[100, 5000]"  required>   
                              
                                @if ($errors->has('distance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('distance') }}</strong>
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

@for($i =0; $i < count($exercises_id); $i++)
<!-- Modal Edit Patient Exercises -->
<div class="modal fade" id="editPatientEx_<?php print_r($exercises_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient  Exercise</h4>
      </div>
      <div class="modal-body">
      <form role ="form" data-parsley-validate method="POST" action="{{ route('excercise.update',$exercises_id) }}">
                     {{method_field('PATCH')}} 
                        @csrf
                       
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 col-form-label text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                            <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no" value ={{$patient_name_no[$exercises_id[$i]]}} disabled>
 
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
                            <input id="patient_id" type="text" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ={{$patient_name[$exercises_id[$i]]}} disabled>
                            <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ={{$patient_id[$exercises_id[$i]]}}>
                       

                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="activity_id" class="col-md-4 col-form-label text-md-right">{{ __('Activities') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="activity_id" >
                                    @foreach($activitiesdatatable  as  $activities)                                   
                                         <option value="{{$activities->id}}"> {{ $activities ->activity}}</option>
                                     @endforeach 
                                </select>
                                @if ($errors->has('activity_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('activity_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>
                            
                            <div class="col-md-6">
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value ={{ $value[$exercises_id[$i]] }} data-parsley-range="[45, 270]"  required>   
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="distance" class="col-md-4 col-form-label text-md-right">{{ __('Distance') }}</label>
                            
                            <div class="col-md-6">
                            <input id="distance" type="text" class="form-control{{ $errors->has('distance') ? ' is-invalid' : '' }}" name="distance" value ={{ $distance[$exercises_id[$i]] }}  name="distance" data-parsley-range="[100, 5000]"  required>   
                              
                                @if ($errors->has('distance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('distance') }}</strong>
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

@for($i=0; $i < count($exercises_id);$i++)
<!-- Modal View Patient Excercises-->
<div class="modal fade" id="viewPatientEx_<?php print_r($exercises_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient  Exercise</h4>
      </div>
      <div class="modal-body">
      <form>
                        @csrf

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4  text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">
                                {{$patient_name_no[$exercises_id[$i]]}}
 
                                @if ($errors->has('patient_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 text-md-right"><strong>{{ __('Patient Name') }}</strong></label>

                            <div class="col-md-6">
                                     {{$patient_name[$exercises_id[$i]]}}
 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="activity_id" class="col-md-4  text-md-right"><strong>{{ __('Activities') }}</strong></label>

                            <div class="col-md-6">
                                 {{$activity_name[$exercises_id[$i]]}}
 
                                @if ($errors->has('activity_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('activity_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Duration') }}</strong></label>
                            
                            <div class="col-md-6">
                                    {{$value[$exercises_id[$i]] }}  mins
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="distance" class="col-md-4  text-md-right"><strong>{{ __('Distance') }}</strong></label>
                            
                            <div class="col-md-6">
                                    {{ $distance[$exercises_id[$i]] }}  m
                              
                                @if ($errors->has('distance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('distance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         
                         <div class="form-group row">
                            <label for="distance" class="col-md-4  text-md-right"><strong>{{ __('Notes') }}</strong></label>
                            
                            @if($distance[$exercises_id[$i]] < 30)
                                    <p style="color:navy"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Do Much  </p>                             

                                    @elseif($distance[$exercises_id[$i]]< 45)
                                    <p style="color:blue"> Good</p>                                

                                    @elseif($distance[$exercises_id[$i]] < 90)
                                    <p style="color:mahogany"> Normal  </p>
                                   
                                    @elseif($distance[$exercises_id[$i]] < 120)
                                    <p style="color:lime"> Expected </p>                       

                                    @elseif($distance[$exercises_id[$i]] < 180)
                                    <p style="color:maroon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Standard</p>
                                   
                                    @elseif($distance[$exercises_id[$i]] > 180)
                                    <p style="color:red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Excessive</p>
                                   
                                    @else
                                    <p>Error</p>

                                   @endif
                            <div class="col-md-6">
                                   
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4  text-md-right"><strong>{{ __('Date') }}</strong></label>

                            <div class="col-md-6">
                                     {{ $created_at[$exercises_id[$i]] }}

                                @if ($errors->has('created_at'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('created_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="updated_at" class="col-md-4  text-md-right"><strong>{{ __('Update') }}</strong></label>

                            <div class="col-md-6">
                                     {{ $updated_at[$exercises_id[$i]] }}

                                @if ($errors->has('updated_at'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('updated_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                

                         </div> 
             </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->
@endfor

@for( $i =0; $i < count($exercises_id); $i++)
<!-- Modal Delete Patient Glucose -->
<div class="modal fade" id="deletePatientEx_<?php print_r($exercises_id[$i]);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient  Exercise</h4>
      </div>
      <div class="modal-body">
      <form  method="POST" action="{{ route('excercise.destroy',$exercises_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                       
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4  text-md-right"><strong>{{ $patient_name[$exercises_id[$i]]  }}</strong></label>

                            <div class="col-md-6">
                               

                                 {{$patient_name_no[$exercises_id[$i]] }}

                                @if ($errors->has('patient_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_name') }}</strong>
                                    </span>
                                @endif
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

