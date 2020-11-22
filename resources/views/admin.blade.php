@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                            Welcome to Doctor's Panel
                </div>            
                                 
                <div class="card-body">
                   <div class="col-md-12">
                   <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <div class="card mb-4 box-shadow">
                                 <img class="card-img-top" >
                                     <div class="card-body">
                                         <p class="card-text"> 
                                             Diabetic Patients Medications 
                                         </p>
                                             <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                     <a  href="{{route('medications.index')}}" class="btn btn-sm btn-outline-secondary">Medications <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                </div>
                                          </div>
                                      </div>
                                  </div>
                            </div>

                            <div class="col-xs-6 col-md-4">
                                 <div class="card mb-4 box-shadow">
                                     <img class="card-img-top" >
                                         <div class="card-body">
                                             <p class="card-text"> 
                                                  Diabetic Patients Reports
                                              </p>
                                                 <div class="d-flex justify-content-between align-items-center">
                                                      <div class="btn-group">
                                                           <a  href="{{route('reports.index')}}" class="btn btn-sm btn-outline-secondary"> Reports <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                       </div>
                                                 </div>
                                         </div>
                                  </div>
                             </div>

                            <div class="col-xs-6 col-md-4"> 
                                 <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" >
                                      <div class="card-body">
                                         <p class="card-text"> 
                                                 Diabetic Patients Records 
                                         </p>
                                             <div class="d-flex justify-content-between align-items-center">
                                                  <div class="btn-group">
                                                     <a  href="{{route('records.index')}}" class="btn btn-sm btn-outline-secondary"> Records <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
                               
                                                   </div>
                                              </div>
                                        </div> 
                                 </div>
                             </div>
 
                          </div> 
                   </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
