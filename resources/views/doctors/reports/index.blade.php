@extends('layouts.app')

@section('content')
   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                             <a  href="{{ route('admin.dashboard')}}" class="btn btn-success btn-sm">Dashboard Reports</a>
                             
                </div>

                 <div class="card-body">
                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Patient Name') }}</label>

                            <div class="col-md-6">
                                <select class="selectpicker" data-style="btn-info"  data-live-search="true" name="patient_id" id="">
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
                            <label for="report" class="col-md-4 col-form-label text-md-right">{{ __('Reports') }}</label>

                            <div class="col-md-6">
                                    <select class="selectpicker" data-style="btn-info" name="report" id="">
                                    
                                            <option value="exercises">Exercises </option>
                                            <option value="glucoses">Glucoses</option>
                                            <option value="weights">BMI</option>
                                            <option value="weists">Waists</option>
                                          
                                    </select>

                                @if ($errors->has('report'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('report') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Types Of Graph') }}</label>

                            <div class="col-md-6">
                                    <select class="selectpicker" data-style="btn-info"  data-live-search="true" name="type" id="">

                                          <option value ="scatter">Scatter Graph</option>
                                          <option value ="area"> Area Chart</option>
                                          <option value ="areaspline"> Area Spine Chart </option>
                                          <option value ="spline"> Spline Chart</option>
                                          <option value ="column">Column Chart</option> 
                                          <option value ="line">  Line graph</option>
                                          <option value ="bar"> Bar Graph </option>
                                          <option value ="pie"> Pie Chart</option>

                                    </select>
                               
                            </div>
                        </div>

                       <!--  <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                     <select class ="form-control" name="duration" id="">
                                         <option value ="365"> One Year </option>
                                          <option value ="7"> One Week</option>
                                          <option value ="14"> Two Weeks </option>
                                          <option value ="31"> One Month</option>
                                          <option value ="93">Three Month</option>
                                          <option value ="182"> Six Month</option>
                                         
                                    </select>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
