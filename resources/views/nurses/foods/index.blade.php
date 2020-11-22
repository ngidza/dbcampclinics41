@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                
                 <a href="{{url('nurse')}}" class="btn btn-success btn-sm">Foods</a>
                    
                    <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatientF">
                        Add Patient to Food
                    </button>
                </div>
  
                <div class="card-body">
                  <table  id="myTable"  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Patient Name</th>
                            <th>Meals</th>
                            <th>Foods</th>
                            <th>Nutrients</th>
                            <th>Notes</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    @for($i =0; $i< count($foods_id); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$patient_name_no[$foods_id[$i]]}}</td>
                            <td>{{$patient_name[$foods_id[$i]]}}</td>
                            <td>{{ $meals_name[$foods_id[$i]] }}</td>
                            <td>{{ $food_name[$foods_id[$i]]  }}</td>
                            <td>{{$food_nutrients[$foods_id[$i]]}}</td>
                            <td>{{$notes[$foods_id[$i]] }}</td>
                            <td>
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatientF_<?php print_r($foods_id[$i]); ?>" >
    <i class="fa fa-pencil"></i>
    </button>
                                        </td>
                                        <td>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatientF_<?php print_r($foods_id[$i]); ?>" >
         <i class="fa fa-eye"></i>
    </button>            
                                        </td>
                                        <td>
 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatientF_<?php print_r($foods_id[$i]); ?>" >
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
<div class="modal fade" id="addPatientF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Patient Foods</h4>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('foods.store') }}">
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
                            <label for="food_type_id" class="col-md-4 col-form-label text-md-right">{{ __('Foods') }}</label>
                            
                            <div class="col-md-6">

                                   <select class ="form-control" name="food_type_id" id="">
                                    @foreach($foods_typesdatatable as  $foods)
                                         <option value="{{$foods->id}}"><a href="">{{ $foods ->food_type}}</a>
                                               
                                         </option>
                                     @endforeach
                                </select>

                                @if ($errors->has('food_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('food_type_id') }}</strong>
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

@for($i =0; $i < count($foods_id); $i++)
<!-- Modal Edit Patient Foods -->
<div class="modal fade" id="editPatientF_<?php print_r($foods_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Patient Foods</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('foods.update',$foods_id[$i]) }}">
                     {{method_field('PATCH')}} 
                        @csrf
                       
                        <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ={{$patient_id[$foods_id[$i]]}} >
 
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 col-form-label text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                            <input id="patient_no" type="text" class="form-control{{ $errors->has('patient_no') ? ' is-invalid' : '' }}" name="patient_no" value ={{$patient_name_no[$foods_id[$i]]}} disabled>
 
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
                            <input id="patient_id" type="text" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id" value ={{$patient_name[$foods_id[$i]]}} disabled>
 

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
                            <label for="food_type_id" class="col-md-4 col-form-label text-md-right">{{ __('Foods') }}</label>
                            
                            <div class="col-md-6">
                                 <select class ="form-control" name="food_type_id" id="">
                                    @foreach($foods_typesdatatable as  $foods)
                                         <option value="{{$foods->id}}">{{ $foods ->food_type}}</option>
                                     @endforeach
                                </select>

                                @if ($errors->has('food_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('food_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                            <div class="col-md-6">
                                <input id="notes" type="text" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes"  value ="{{$notes[$foods_id[$i]]}}" required>

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

@for($i =0; $i < count($foods_id); $i++)
<!-- Modal View Patient Foods -->
<div class="modal fade" id="viewPatientF_<?php print_r($foods_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Foods</h4>
      </div>
      <div class="modal-body">
      <form>
                        @csrf

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">
                                     {{$patient_name_no[$foods_id[$i]]}}
 
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
                                    {{$patient_name[$foods_id[$i]]}}
 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="food_type_id" class="col-md-4  text-md-right"><strong>{{ __('Meals') }}</strong></label>
                            
                            <div class="col-md-6">
                                     {{  $meals_name[$foods_id[$i]]  }}
                              
                                @if ($errors->has('food_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('food_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="food_type_id" class="col-md-4  text-md-right"><strong>{{ __('Foods') }}</strong></label>
                            
                            <div class="col-md-6">
                                     {{ $food_name[$foods_id[$i]] }}
                              
                                @if ($errors->has('food_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('food_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="food_type_id" class="col-md-4  text-md-right"><strong>{{ __('Nutrients') }}</strong></label>
                            
                            <div class="col-md-6">
                                     {{  $food_nutrients[$foods_id[$i]] }}
                              
                                @if ($errors->has('food_type_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('food_type_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notes" class="col-md-4  text-md-right"><strong>{{ __('Notes') }}</strong></label>

                            <div class="col-md-6">
                                    {{$notes[$foods_id[$i]]}}

                                @if ($errors->has('notes'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="created_at" class="col-md-4  text-md-right"><strong>{{ __('Date') }}</strong></label>

                            <div class="col-md-6">
                                    {{$created_at[$foods_id[$i]]}}

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
                                    {{$updated_at[$foods_id[$i]]}}

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

@for($i=0; $i < count($foods_id); $i++)
<!-- Modal Delete Patient Foods -->
<div class="modal fade" id="deletePatientF_<?php print_r($foods_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Foods</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('foods.destroy',$foods_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" required>
                        <p>Are you sure you want to delete?</p>
                        <div class="form-group row">
                            <label for="patient_name" class="col-md-4  text-md-right"><strong>{{ $patient_name[$foods_id[$i]]  }}</strong></label>

                            <div class="col-md-6">
                            
                                        {{ $patient_name[$foods_id[$i]] }}

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

