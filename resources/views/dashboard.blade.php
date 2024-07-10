@extends('layouts.app')
@section('content')
    <style>
        .card-box:hover {
            background-color: #f0f0f0;
            /* Ubah warna abu-abu di sini */
        }
    </style>
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-4">DATA PASIEN TAHUN 2023</h5>
                                </div>
                            </div>
                            <div>
                                <div id="chart-rekap"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $(document).ready(function() {

        // Ekstrak kunci (nama warehouse) dan nilai (stock) dari data
        var categories = ['JAN' , 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];
        var seriesData = [90, 40, 35, 60, 55, 70, 20, 30, 40, 50, 60, 70];

        var options = {
            series: [{
                name: 'Pasien',
                data: seriesData,
                color: '#556ee6'
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: categories,
            },
            yaxis: {
                title: {
                    text: 'Stock'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Orang";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-rekap"), options);
        chart.render();
    });
</script>
