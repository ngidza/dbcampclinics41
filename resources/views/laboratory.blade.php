@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Foot Examinations</div>

                <div class="card-body">

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                          <img class="card-img-top" >
                            <div class="card-body">
                                 <p class="card-text"> 
                                     Clinical Examination of the Foot and Ankle 
                                 </p>
                              <div class="d-flex justify-content-between align-items-center">
                                 <div class="btn-group">
                                     <a  href="{{route('feets.index')}}" class="btn btn-sm btn-outline-secondary"> Sensory Foot Exams <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                               
                                 </div>
                              </div>
                            </div>
                        </div>
                     </div>
           
                <!--  <div class="card mb-4 box-shadow">
                  
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                        <a href="{{route('feets.index')}}" class="btn btn-sm btn-primary">Feet Examinations</a>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                       
                        </ul>
                     
                    </div>
                    </div> -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
