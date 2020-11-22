@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                             <a  href="{{ route('admin.dashboard')}}" class="btn btn-success btn-sm" >Dashboard Reports</a>
                           
                </div>

                 <div class="card-body">
                    <form method="POST" action="{{ route('records.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="groups" class="col-md-4 col-form-label text-md-right">{{ __('Groups') }}</label>

                            <div class="col-md-6">
                                <select  class ="form-control" name="groups" id="">
                                    <option value="glucoses">Glucoses</option>
                                    <option value="exercises">Exercises</option>
                                    <option value="weights">Weights</option>
                                    <option value="weists">Waists</option>
                                    <option value=""></option>
                                </select>

                                @if ($errors->has('groups'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('groups') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Types Of Graph') }}</label>

                            <div class="col-md-6">
                                    <select class ="form-control" name="type" id="">
                                          <option value ="line">  Line graph</option>
                                          <option value ="bar"> Bar Graph </option>
                                          <option value ="pie"> Pie Chart</option>
                                          <option value ="scatter">Scatter Graph</option>
                                          <option value ="area"> Area Chart</option>
                                          <option value ="areaspline"> Area Spine Chart </option>
                                          <option value ="spline"> Spline Chart</option>
                                          <option value ="column">Column Chart</option>
                                    </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                     <select class ="form-control" name="duration" id="">
                                          <option value ="7"> One Week</option>
                                          <option value ="14"> Two Weeks </option>
                                          <option value ="31"> One Month</option>
                                          <option value ="93">Three Month</option>
                                          <option value ="182"> Six Month</option>
                                          <option value ="365"> One Year </option>
                                         
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
