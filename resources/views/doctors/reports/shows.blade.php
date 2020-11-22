
@extends('layouts.app')
@section('content')

  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
             <div class="card">
                 <div class="card-header">
                        <a href="{{route('reports.index')}}" class="btn btn-success btn-sm">Doctor Records</a>
                  </div>
             <div class="card card-default">          
                <div class="card-body">
                     <div class="card card-default">
                        <div class="card-header"> 
                            Graph for {{$patientsnamedata}}
                
                        </div>
           
                        <div class="card-body">
                            <div id="container"></div>
                        
                             </div>
                        </div>
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
            text: '<?php print(ucwords($patientsnamedata)); ?> <?php print_r(ucwords($report)); ?>'
        },
        subtitle: {
            text: '<?php print_r(ucwords($report)); ?>' 
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
            text: '<?php print_r($report); ?>'
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
            valueSuffix: ' <?php print_r($report); ?>'
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
            name:'<?php print($patientsnamedata); ?>',
            data:  <?php print_r($patient); ?>

        },{
            name:'F General Target Expected',
            data:[76, 80, 78,79,78,80]

        },{
            name:'M General Target Expected',
            data:[92, 94, 93, 94, 95,94]

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
        });
</script>
@endsection