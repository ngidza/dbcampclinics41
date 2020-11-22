@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <a href="{{url('nurse')}}" class="btn btn-success btn-sm"> Glucose Level Monitoring</a>
                     <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatientG">
                         Patient Glucose
                    </button>
                </div>
  
                <div class="card-body">
                  <table  id="myTable"  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Patient Name</th>
                            <th>Activity</th>                      
                            <th>Glucose</th>
                            <th>Notes</th>
                            <th>Meals</th>
                            <th>Date</th>
                            <th>Comments</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    @for($i =0; $i< count($glucoses_id); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$patient_name_no[$glucoses_id[$i]]}}</td>
                            <td>{{$patient_name[$glucoses_id[$i]]}}</td>
                            <td>{{ $activity_name[$glucoses_id[$i]]}}</td>
                            <td>{{$value[$glucoses_id[$i]]}}</td>                           
                            <td>
                            @if($value[$glucoses_id[$i]] < 80)
                               <p style="color:navy"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Very Bellow Average  </p>
                                                                                
                               @elseif($value[$glucoses_id[$i]] < 100)
                                  <p style="color:blue">B Avg BG</p>
                                                                    
                                 @elseif($value[$glucoses_id[$i]] < 121)
                                    <p style="color:maroon">Avg BG </p>
                                                                                   
                                 @elseif($value[$glucoses_id[$i]] < 150)
                                      <p style="color:blueviolet">Avg BG</p>
                                                                                   
                                  @elseif($value[$glucoses_id[$i]] < 179)
                                    <p style="color:red">Avg BG PM</p>
                                                                                  
                                 @elseif($value[$glucoses_id[$i]] < 180)
                                  <p style="color:maroon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> I^ Risk</p>
                                                                                  
                                @elseif($value[$glucoses_id[$i]] < 94)
                                      <p style="color:redorange"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>H Risk</p>

                                 @elseif($value[$glucoses_id[$i]] > 94)         
                                 <p style="color:brickred"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>V H Risk</p>                                                                                   

                                  @else
                                    <p>Error</p>

                              @endif                               
                            </td>
                            <td>{{ $meals_name[$glucoses_id[$i]] }} </td>
                            <td> {{$created_at[$glucoses_id[$i]] }} </td>
                            <td>{{  $comments[$glucoses_id[$i]] }} </td>
                            <td>
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientG_<?php print_r($glucoses_id[$i]); ?>" >
  
    <i class="fa fa-pencil"></i>
    </button>
                                        </td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientG_<?php print_r($glucoses_id[$i]); ?>" >
         <i class="fa fa-eye"></i>
    </button>            
                                        </td>
                                        <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientG_<?php print_r($glucoses_id[$i]); ?>" >
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

<!-- Modal New Patient Glucose -->
<div class="modal fade" id="addPatientG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient Glucose</h4>
      </div>
      <div class="modal-body">
      <form  id="form" method="POST" action="{{ route('glucose.store') }}">
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
                            <label for="activity_id" class="col-md-4 col-form-label text-md-right">{{ __('Physical Excercises') }}</label>

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
                            <label for="meal_id" class="col-md-4 col-form-label text-md-right">{{ __('Meals') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="meal_id" id="">
                                    @foreach($mealsdatatable  as  $meals)
                                         <option value="{{$meals->id}}">{{ $meals ->meal_time}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('meal_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('meal_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Glucose') }}</label>
                            
                            <div class="col-md-6">
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" data-parsley-range="[100, 250]"  required>   
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>
                            
                            <div class="col-md-6">
                            <input id="comments" type="text" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments"  required>   
                              
                                @if ($errors->has('comments'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('comments') }}</strong>
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

<!-- Modal Edit Patient Glucose -->
@for($i =0; $i < count($glucoses_id); $i++)
<div class="modal fade" id="editPatientG_<?php print_r($glucoses_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient Glucose</h4>
      </div>
      <div class="modal-body">
      <form id ="form" data-parsley-validate role ="form" method="POST" action="{{ route('glucose.update',$glucoses_id[$i]) }}">
                     {{method_field('PATCH')}} 
                        @csrf
 
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                                 
                            <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no"  value ="{{ $patient_name_no[$glucoses_id[$i]] }}" disabled>   
                            <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ={{$patient_id[$glucoses_id[$i]]}} >   
 
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
                            <input id="patient_id" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_id"  value ="{{ $patient_name[$glucoses_id[$i]] }}" disabled>   
                                 

                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="activity_id" class="col-md-4 col-form-label text-md-right">{{ __('Physical Excercises') }}</label>

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
                            <label for="meal_id" class="col-md-4 col-form-label text-md-right">{{ __('Meals') }}</label>

                            <div class="col-md-6">
                                 
                                 <select class ="form-control" name="meal_id" id="">
                                    @foreach($mealsdatatable  as  $meals)
                                         <option value="{{$meals->id}}">{{ $meals ->meal_time}}</option>
                                     @endforeach
                                </select>
                               
                                @if ($errors->has('meal_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('meal_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Glucose') }}</label>
                            
                            <div class="col-md-6">
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value"  value ="{{ $value[$glucoses_id[$i]]  }}"  data-parsley-range="[100, 250]"   required>   
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>
                            
                            <div class="col-md-6">
                            <input id="comments" type="text" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments"  value ="{{ $comments[$glucoses_id[$i]]  }}" required>   
                              
                                @if ($errors->has('comments'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('comments') }}</strong>
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

@for($i =0; $i < count($glucoses_id); $i++)
<!-- Modal View Patient Glucose -->
<div class="modal fade" id="viewPatientG_<?php print_r($glucoses_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Glucose</h4>
      </div>
      <div class="modal-body">
      <form>
                        @csrf

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">

                                    {{$patient_name_no[$glucoses_id[$i]]}}
 
                                @if ($errors->has('patient_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4  text-md-right"><strong>{{ __('Patient Name') }}</strong></label>

                            <div class="col-md-6">
                           
                                    {{$patient_name[$glucoses_id[$i]]}}
 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Glucose') }}</strong></label>
                            
                            <div class="col-md-6">

                                    {{$value[$glucoses_id[$i]] }} 
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Activity') }}</strong></label>
                            
                            <div class="col-md-6">

                                    {{ $activity_name[$glucoses_id[$i]] }} 
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Notes') }}</strong></label>
                            
                            <div class="col-md-6">

                               
                                 @if($value[$glucoses_id[$i]] < 80)
                               <p style="color:navy"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Very Bellow Average  </p>
                                                                                
                               @elseif($value[$glucoses_id[$i]] < 100)
                                  <p style="color:blue">B Avg BG</p>
                                                                    
                                 @elseif($value[$glucoses_id[$i]] < 121)
                                    <p style="color:maroon">Avg BG </p>
                                                                                   
                                 @elseif($value[$glucoses_id[$i]] < 150)
                                      <p style="color:blueviolet">Avg BG</p>
                                                                                   
                                  @elseif($value[$glucoses_id[$i]] < 179)
                                    <p style="color:red">Avg BG PM</p>
                                                                                  
                                 @elseif($value[$glucoses_id[$i]] < 180)
                                  <p style="color:maroon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> I^ Risk</p>
                                                                                  
                                @elseif($value[$glucoses_id[$i]] < 94)
                                      <p style="color:redorange"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>H Risk</p>

                                 @elseif($value[$glucoses_id[$i]] > 94)         
                                 <p style="color:brickred"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>V H Risk</p>                                                                                   

                                  @else
                                    <p>Error</p>

                              @endif            
                            </div>
                        </div>

                      <div class="form-group row">
                            <label for="comments" class="col-md-4  text-md-right"><strong>{{ __('Comments') }}</strong></label>
                            
                            <div class="col-md-6">
                           
                                 {{$comments[$glucoses_id[$i]] }}
                              
                                @if ($errors->has('comments'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meal_id" class="col-md-4  text-md-right"><strong>{{ __('Meals') }}</strong></label>
                            
                            <div class="col-md-6">
                           
                                    {{$meals_name[$glucoses_id[$i]] }}
                              
                                @if ($errors->has('meal_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('meal_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4  text-md-right"><strong>{{ __('Date') }}</strong></label>

                            <div class="col-md-6">

                                        {{$created_at[$glucoses_id[$i]] }}

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
                           
                                        {{$updated_at[$glucoses_id[$i]] }}

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

@for($i=0; $i < count($glucoses_id); $i++)
<!-- Modal Delete Patient Glucose -->
<div class="modal fade" id="deletePatientG_<?php print_r($glucoses_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Glucose</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('glucose.destroy',$glucoses_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                     
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 text-md-right"><strong>{{__( $patient_name[$glucoses_id[$i]]) }}</strong></label>

                            <div class="col-md-6">
                                {{ $patient_name_no[$glucoses_id[$i]]}}

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

