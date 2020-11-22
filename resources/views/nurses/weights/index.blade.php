@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <a href="{{url('nurse')}}" class="btn btn-success btn-sm"> Weight Management</a>
              
                     <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatientW">
                         Patient Weight
                    </button>
                </div>
  
                <div class="card-body">
                  <table  id="myTable"  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Patient Name</th>
                            <th>Weight</th>
                            <th>BMI</th>
                            <th>Temperature</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    @for($i =0; $i< count($weights_id); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$patient_name_no[$weights_id[$i]]}}</td>
                            <td>{{$patient_name[$weights_id[$i]]}}</td>
                            <td>{{$weight[$weights_id[$i]]}}</td>
                            <td>
                            {{ round($value[$weights_id[$i]], 2) }}
                            @switch($value[$weights_id[$i]])

                                @case($value[$weights_id[$i]] < 20)
                                <i class="fa fa-exclamation-triangle" style="color:navy" aria-hidden="true"> Under </i> 
                                @break

                                @case($value[$weights_id[$i]] < 25)
                                <i style="color:blue"> Normal </i>
                                @break

                                @case($value[$weights_id[$i]] < 34)
                                <i style="color:teal" > Over </i>
                                @break

                                @case($value[$weights_id[$i]] < 40)
                                  <i  style="color:red" > Obese</i> 
                                @break

                                @case($value[$weights_id[$i]] > 40)         
                                   <i class="fa fa-exclamation-triangle"  style="color:maroon" aria-hidden="true"> Morbity </i> 
                                @break

                                @default
                                <p>Error</p>
                                @endswitch 
                            </td>
                            <td>
                            {{$temperature[$weights_id[$i]]}}

                            @switch($temperature[$weights_id[$i]] )

                                    @case($temperature[$weights_id[$i]] < 36)
                                         <i class="fa fa-flag fa-fw" style="color:black" aria-hidden="true"> </i>Admit
                                    @break

                                    @case($temperature[$weights_id[$i]] < 39)
                                       <i class="fa fa-flag fa-fw" style="color:blue" aria-hidden="true"> </i>Normal
                                    @break

                                    @case($temperature[$weights_id[$i]] >39)
                                       <i class="fa fa-flag fa-fw" style="color:red" aria-hidden="true"> </i> Admit
                                    @break
                                   
                                    @default
                                    <p>Error</p>
                             @endswitch 
                                
                            </td>
                            <td>
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientW_<?php print_r($weights_id[$i]); ?>">
    <i class="fa fa-pencil"></i>
    </button>
                                        </td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientW_<?php print_r($weights_id[$i]); ?>" >
         <i class="fa fa-eye"></i>
    </button>            
                                        </td>
                                        <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientW_<?php print_r($weights_id[$i]); ?>" data-id="{{$weights_id[$i]}}">
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
<div class="modal fade" id="addPatientW" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient Weights</h4>
      </div>
      <div class="modal-body">
      <form id="form" method="POST" action="{{ route('weights.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Patient name') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="patient_id" id="">                               
                                   
                                    @foreach($patientsdatatable as $patients )                                   
                                    <option value="{{$patients ->id}}">  {{$patients ->patient_name}} </option>                                  
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
                            <label for="meals_id" class="col-md-4 col-form-label text-md-right">{{ __('Meals') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="meals_id" id="">
                                    @foreach($mealsdatatable as  $meals)
                                         <option value="{{$meals->id}}">{{ $meals ->meal_time}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('meals_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('meals_id') }}</strong>
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
                            <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height') }}</label>

                            <div class="col-md-6">
                            <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" data-parsley-range="[1, 2]" required>

                                @if ($errors->has('height'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="temperature" class="col-md-4 col-form-label text-md-right">{{ __('Temperature') }}</label>

                            <div class="col-md-6">
                            <input id="temperature" type="text" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" name="temperature" data-parsley-range="[35, 40]" required>

                                @if ($errors->has('temperature'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('temperature') }}</strong>
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


@for($i =0; $i < count($weights_id); $i++)
<!-- Modal Edit Patient Weights -->
<div class="modal fade" id="editPatientW_<?php print_r($weights_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient Weights</h4>
      </div>
      <div class="modal-body">
      <form  id="form" data-parsley-validate role ="form"  method="POST" action="{{ route('weights.update',$weights_id[$i]) }}">
                     {{method_field('PATCH')}} 
                        @csrf

                       
                        <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}"  name="patient_id"  value ="{{$patient_id[$weights_id[$i]]}}">
 
                         <div class="form-group row">
                            <label for="patient_no" class="col-md-4 col-form-label text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                            <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no" value ="{{$patient_name_no[$weights_id[$i]]}}" disabled>
 
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
                                   <input id="patient_name" type="text" class="form-control{{ $errors->has('patient_name') ? ' is-invalid' : '' }}" name="patient_name" value =" {{$patient_name[$weights_id[$i]]}}" disabled>

                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="meals_id" class="col-md-4 col-form-label text-md-right">{{ __('Meals') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="meals_id" id="">
                                    @foreach($mealsdatatable as  $meals)
                                         <option value="{{$meals->id}}">{{ $meals ->meal_time}}</option>
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
                            <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>
                            
                            <div class="col-md-6">
                            <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value ="{{$weight[$weights_id[$i]]}}" data-parsley-range="[50, 150]" required>   
                              
                                @if ($errors->has('weight'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height') }}</label>

                            <div class="col-md-6">
                            <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" data-parsley-range="[1, 2]" required>

                                @if ($errors->has('height'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                       <div class="form-group row">
                            <label for="temperature" class="col-md-4 col-form-label text-md-right">{{ __('Temperature') }}</label>

                            <div class="col-md-6">
                            <input id="temperature" type="text" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" name="temperature" value ="{{ $temperature[$weights_id[$i]] }}" data-parsley-range="[35, 40]" required>

                                @if ($errors->has('temperature'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('temperature') }}</strong>
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
<!-- Modal View Patient Weights -->
@for($i =0; $i < count($weights_id); $i++)
<div class="modal fade" id="viewPatientW_<?php print_r($weights_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Weights</h4>
      </div>
      <div class="modal-body">
      <form>
                        @csrf
                      
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">

                                  {{$patient_name_no[$weights_id[$i]]}}

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
                            
                                    {{$patient_name[$weights_id[$i]]}}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="weight" class="col-md-4 text-md-right"><strong>{{ __('Weight') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                            {{  $weight[$weights_id[$i]] }}
                          
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('BMI') }}</strong></label>

                            <div class="col-md-6">
                               
                                        {{round($value[$weights_id[$i]], 2)}}

                                 @switch($value[$weights_id[$i]])

                                    @case($value[$weights_id[$i]] < 20)
                                    <i class="fa fa-exclamation-triangle" style="color:navy" aria-hidden="true"> Under </i> 
                                    @break

                                    @case($value[$weights_id[$i]] < 25)
                                    <i style="color:blue"> Normal </i>
                                    @break

                                    @case($value[$weights_id[$i]] < 34)
                                    <i style="color:teal" > Over </i>
                                    @break

                                    @case($value[$weights_id[$i]] < 40)
                                    <i  style="color:red" > Obese </i> 
                                    @break

                                    @case($value[$weights_id[$i]] > 40)         
                                    <i class="fa fa-exclamation-triangle"  style="color:maroon" aria-hidden="true"> Morbity </i> 
                                    @break

                                    @default
                                    <p>Error</p>
                                 @endswitch 
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="temperature" class="col-md-4 text-md-right"><strong>{{ __('Temperature') }}</strong></label>

                            <div class="col-md-6">
                         
                                    {{$temperature[$weights_id[$i]]}}

                                        @switch($temperature[$weights_id[$i]] )

                                        @case($temperature[$weights_id[$i]] < 36)
                                            <i class="fa fa-flag fa-fw" style="color:black" aria-hidden="true"> </i>Admit
                                        @break

                                        @case($temperature[$weights_id[$i]] < 39)
                                        <i class="fa fa-flag fa-fw" style="color:blue" aria-hidden="true"> </i>Normal
                                        @break

                                        @case($temperature[$weights_id[$i]] >39)
                                        <i class="fa fa-flag fa-fw" style="color:red" aria-hidden="true"> </i> Admit
                                        @break

                                        @default
                                        <p>Error</p>
                                        @endswitch 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="created_at" class="col-md-4 text-md-right"><strong>{{ __('Date') }}</strong></label>

                            <div class="col-md-6">
                               
                                    {{$created_at[$weights_id[$i]]}}

                                @if ($errors->has('created_at'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('created_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="updated_at" class="col-md-4 text-md-right"><strong>{{ __('Update') }}</strong></label>

                            <div class="col-md-6">
                            
                                    {{$updated_at[$weights_id[$i]]}}

                                @if($errors->has('updated_at'))
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

@for($i =0; $i < count($weights_id); $i++)
<!-- Modal Delete Patient Weights -->
<div class="modal fade" id="deletePatientW_<?php print_r($weights_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Weights</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('weights.destroy',$weights_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                       
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4 text-md-right"><strong>{{ __($patient_name[$weights_id[$i]]) }}</strong></label>

                            <div class="col-md-6">

                                            {{$patient_name_no[$weights_id[$i]]}}

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

