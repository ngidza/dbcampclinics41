@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <a href="{{url('nurse')}}" class="btn btn-success btn-sm" >Waist Circumference</a>
                     <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatientWeist">
                         Patient Waist
                    </button>
                </div>
  
                <div class="card-body">
                  <table  id="myTable"  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Patient Name</th>
                            <th>Waist</th>
                            <th>Notes</th>
                            <th>Mealtime</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    @for($i =0; $i< count($weists_id); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$patient_name_no[$weists_id[$i]]}}</td>
                            <td>{{$patient_name[$weists_id[$i]]}}</td>
                            <td>{{$value[$weists_id[$i]]}}</td>                           
                            <td>
                            @switch($value[$weists_id[$i]])

                                @case($value[$weists_id[$i]] < 30)
                                <p style="color:navy"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 2 Small  </p>
                                @break

                                @case($value[$weists_id[$i]] < 40)
                                <p style="color:blue"> Normal</p>
                                @break

                                @case($value[$weists_id[$i]] < 60)
                                <p style="color:olive"> Risk</p>
                                @break

                                @case($value[$weists_id[$i]] < 80)
                                <p style="color:blueviolet"> Increased Risk</p>
                                @break

                                @case($value[$weists_id[$i]] < 94)
                                <p style="color:red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> High Risk</p>
                                @break

                                @case($value[$weists_id[$i]] > 94)         
                                <p style="color:maroon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> V.High Risk</p>
                                @break

                                @default
                                <p>Error</p>
                                @endswitch
                            </td>
                            <td>{{ $meals_name[$weists_id[$i]] }} </td>
                            <td>{{ date("m-d-Y", strtotime($created_at[$weists_id[$i]] )) }}   </td>

                            <td>
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientWeist_<?php print_r($weists_id[$i]); ?>" >
    <i class="fa fa-pencil"></i>
    </button>
                                        </td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientWeist_<?php print_r($weists_id[$i]); ?>" >
         <i class="fa fa-eye"></i>
    </button>            
                                        </td>
                                        <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientWeist_<?php print_r($weists_id[$i]); ?>">
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

<!-- Modal New Patient Weights -->
<div class="modal fade" id="addPatientWeist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient Waists</h4>
      </div>
      <div class="modal-body">
      <form id ="form" method="POST" action="{{ route('weists.store') }}">
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
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Waist') }}</label>
                            
                            <div class="col-md-6">
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" data-parsley-range="[80, 200]" required>   
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
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
@for($i =0; $i < count($weists_id); $i++)
<!-- Modal Edit Patient Weights -->
<div class="modal fade" id="editPatientWeist_<?php print_r($weists_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient Waists</h4>
      </div>
      <div class="modal-body">
      <form id="form" data-parsley-validate method="POST" action="{{ route('weists.update',$weists_id[$i]) }}">
                     {{method_field('PATCH')}} 
                        @csrf
                       
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 col-form-label text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                            <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no" value ="{{$patient_name_no[$weists_id[$i]]}}" disabled>
 
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
                            <input id="patient_id" type="text" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ="{{$patient_name[$weists_id[$i]]}}" disabled>
                            <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ="{{$patient_id[$weists_id[$i]]}}">
                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
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
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Waist') }}</label>
                            
                            <div class="col-md-6">
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value"  value ="{{ $value[$weists_id[$i]] }}" data-parsley-range="[80, 200]" required>   
                              
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('value') }}</strong>
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

@for($i =0; $i < count($weists_id); $i++)
<!-- Modal View Patient Weights -->
<div class="modal fade" id="viewPatientWeist_<?php print_r($weists_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Waists</h4>
      </div>
      <div class="modal-body">
      <form>
                        @csrf

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4  text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">
                          
                                {{ $patient_name_no[$weists_id[$i]] }}
 
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 text-md-right"><strong>{{ __('Patient Name') }}</strong></label>

                            <div class="col-md-6">

                                    {{ $patient_name[$weists_id[$i]] }}
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Waist') }}</strong></label>
                            
                            <div class="col-md-6">
                                    {{ $value[$weists_id[$i]] }}
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Notes') }}</strong></label>
                            
                            <div class="col-md-6">
                            @switch($value[$weists_id[$i]])

                                @case($value[$weists_id[$i]] < 30)
                                <p style="color:navy"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 2 Small  </p>
                                @break

                                @case($value[$weists_id[$i]] < 40)
                                <p style="color:blue"> Normal</p>
                                @break

                                @case($value[$weists_id[$i]] < 60)
                                <p style="color:olive"> Risk</p>
                                @break

                                @case($value[$weists_id[$i]] < 80)
                                <p style="color:blueviolet"> Increased Risk</p>
                                @break

                                @case($value[$weists_id[$i]] < 94)
                                <p style="color:red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> High Risk</p>
                                @break

                                @case($value[$weists_id[$i]] > 94)         
                                <p style="color:maroon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> V. High Risk</p>
                                @break

                                @default
                                <p>Error</p>
                                @endswitch
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="meal_id" class="col-md-4  text-md-right"><strong>{{ __('Meals') }}</strong></label>
                            
                            <div class="col-md-6">
                                    {{ $meals_name[$weists_id[$i]] }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 text-md-right"><strong>{{ __('Date') }}</strong></label>

                            <div class="col-md-6">
                                     {{ $created_at[$weists_id[$i]] }}
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="updated_at" class="col-md-4 text-md-right"><strong>{{ __('Update') }}</strong></label>

                            <div class="col-md-6">

                                    {{ $updated_at[$weists_id[$i]] }}

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

@for($i =0; $i < count($weists_id); $i++)
<!-- Modal Delete Patient Weights -->
<div class="modal fade" id="deletePatientWeist_<?php print_r($weists_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Waists</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('weists.destroy',$weists_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                       
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4  text-md-right"><strong>{{ __($patient_name[$weists_id[$i]]) }}</strong></label>

                            <div class="col-md-6">
                            
                                {{$patient_name_no[$weists_id[$i]]}}

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

