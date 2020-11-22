@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                   Patient Management Tools
                   
                </div>

   <div class="card-body">
              <div class="col-md-12">
                     <div class="row">
                       
                            <div class="col-xs-6 col-md-4">
                                 <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" >
                                          <div class="card-body">
                                            <p class="card-text"> 
                                            Glucose Level Management 
                                            </p>   
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a  href="{{route('glucose.index')}}" class="btn btn-sm btn-outline-secondary"> Glucose <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                
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
                                                  Clinical Waists Management 
                                              </p>
                                                 <div class="d-flex justify-content-between align-items-center">
                                                      <div class="btn-group">
                                                           <a  href="{{route('weists.index')}}" class="btn btn-sm btn-outline-secondary"> Waists <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
                                        Special  Foods for Diabetic Patients 
                                         </p>
                                             <div class="d-flex justify-content-between align-items-center">
                                                  <div class="btn-group">
                                                     <a  href="{{route('foods.index')}}" class="btn btn-sm btn-outline-secondary"> Foods <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                               
                                                   </div>
                                              </div>
                                        </div> 
                                 </div>
                             </div>
 
                          </div> 

                     <div class="row">
                         <div class="col-xs-6 col-md-4">
                            <div class="card mb-4 box-shadow">
                                 <img class="card-img-top" >
                                     <div class="card-body">
                                         <p class="card-text"> 
                                             Clinical Weight Management 
                                         </p>
                                             <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                     <a  href="{{route('weights.index')}}" class="btn btn-sm btn-outline-secondary">Weight <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
                                                   Clinical Excercise Management 
                                              </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="btn-group">
                                                        <a  href="{{route('excercise.index')}}" class="btn btn-sm btn-outline-secondary"> Excercise <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                
                                                    </div>
                                                </div>
                                           </div>
                                   </div>
                              </div>

                           <!--  <div class="col-xs-6 col-md-4">    
                                 <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" >
                                        <div class="card-body">
                                            <p class="card-text"> 
                                                Clinical Examination of the Foot and Ankle 
                                            </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                      <div class="btn-group">
                                                          <a  href="{{route('feets.index')}}" class="btn btn-sm btn-outline-secondary"> Sensory Foot Examination</a>
                               
                                                       </div>
                                                </div>
                                          </div> 
                                  </div>
                             </div> -->

                            </div><!--  row -->
                          </div><!--  end of row12 -->
                     </div><!-- card-body -->
                                  
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
