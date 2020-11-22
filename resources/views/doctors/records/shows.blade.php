@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                 <div class="card">
                    <div class="card-header"> <a href="{{url('admin/records')}}" class="btn btn-success btn-sm">Patients Table Records</a>
                       
                    </div>
    
                    <div class="card-body">
                    <table  id="myTable"  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Patient Name</th>
                               
                                <th>Records</th>
                                <th>Referred on</th>
                                         
                            </tr>
                        </thead>
                        
                    @foreach($patient as $key =>  $reports )
                            <tbody>
                                <td>{{ $key + 1}}</td>
                                <td>{{$reports ->patient_no }}</td>
                                <td>{{$reports->patient_name}}</td>
                               
                                <td>{{$reports->value}}</td>
                                <td>{{$reports->created_at}}</td>

                                                 
                            </tbody>
                        @endforeach
                    </table>      
                </div><!-- card-body -->
             </div><!-- card -->
          </div>
          <div class="col-md-6">
                 <div class="card">
                    <div class="card-header">Dashboard for Doctor Records 
                      Graphs for {{$groups}}
                    </div>
    
                    <div class="card-body">
                     <div id="container"></div>
                </div><!-- card-body -->
             </div><!-- card -->
          </div>
        </div>
     </div>
  </div>
</div>
 
<script>

Highcharts.chart('container', {
 chart: {
      type: '{{$type}}'
 },
 title: {
     text: '{{ucwords($groups)}}'
 },
 subtitle: {
     text: '' 
 },
 /*  xAxis: {
     type: 'month',
     labels: {
         overflow: 'justify'
     }
 },*/
 xAxis: [{
     categories: ['Baseline', '+3mo', '+6mo', '+9mo', '1yr', '+3mo', '+6mo', '9mo', '1yr'], 
     crosshair: true
 }],
 yAxis: {
     title: {
         text: ''
     }, subtitle: {
     text: ''
 },
     minorGridLineWidth: 0,
     gridLineWidth: 0,
     alternateGridColor: null,
     plotBands: [{ // Under weight
         from: 14,
         to: 18,
         color: 'rgba(68, 170, 213, 0.1)',
         label: {
             text: '',
             style: {
                 color: '#606060'
             }
         }
     }, { // Normal Weight
         from: 18,
         to: 24,
         color: 'rgba(258, 2, 5, 0)',
         label: {
             text: '',
             style: {
                 color: '#606060'
             }
         }
     }, { // Over Weight
         from: 24,
         to: 30,
         color: 'rgba(22, 5, 213, 0)',
         label: {
             text: '',
             style: {
                 color: '#606060'
             }
         }
     }, { // Moderate breeze
         from: 30,
         to: 34,
         color: 'rgba(225, 2, 5, 0)',
         label: {
             text: '',
             style: {
                 color: '#606060'
             }
         }
     }, { // Fresh breeze
         from: 36,
         to: 40,
         color: 'rgba(225, 225, 225, 0)',
         label: {
             text: '',
             style: {
                 color: '#606060'
             }
         }
     },  { // High wind
         from: 36,
         to: 40,
         color: 'rgba(68, 170, 213, 0.1)',
         label: {
             text: '',
             style: {
                 color: '#606060'
             }
         }
     }]
 },
 tooltip: {
     valueSuffix: '{{ $patientname }}',
 },
 plotOptions: {
     spline: {
         lineWidth: 4,
         states: {
             hover: {
                 lineWidth: 5
             }
         },
         marker: {
             enabled: false
         },
         
         // pointInterval: 7776000000, // one hour
         // pointStart: Date.UTC(2017)
     }
 },
 series: [{
     name: '{{ucwords($groups)}} Patients',
     data:  <?php print_r($patientdata); ?>

 }],
 navigation: {
     menuItemStyle: {
         fontSize: '10px'
     }
 }
 });
</script>


@endsection

