@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a href="{{ route('medications.index')}}" class="btn btn-success btn-sm">  {{ __('Patient Medication History') }}</a>
              </div>

                <div class="card-body">
                <table  id="myTable"  class="table table-bordered table-hover">
                             <thead>
                                    <tr>
                                        <th>#:</th>                                        
                                        <th>Medications:</th>                                    
                                        <th>Formular:</th>
                                        <th>Dosage:</th>
                                        <th>Date Diagnosed:</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                @foreach($users as $key => $userdatax)
                                    <tr>
                                 
                                        <td>{{$key +1}}</td>
                                        <td> {{ $userdatax ->medicines_type }}</td>
                                        <td> {{ $userdatax ->formular_type }}</td>
                                        <td> {{ $userdatax->dosage }}</td>
                                        <td> {{ $userdatax ->created_at }}</td>
                                    
                                    </tr>
                                    @endforeach 
                                </tbody>
                    </table>                     
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
