<div>
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <h2 class="mt-2 text-xl font-semibold">Nordics</h2>
        </div>
        <div class="flex flex-col items-center">
            <div class="animate__animated animate__pulse animate__infinite">
                <span class="text-7xl font-semibold">£{{ $recentSales }}</span>
            </div>
            <span class="mt-3 text-xl text-gray-700">Sales per Month</span>
        </div>
    </div>

   <div class="w-full" style="height: 50%;">
        <div id="chart"></div>
   </div>
           
</div>

@push('js')
    <script>
        var options = {
            chart: {
                type: 'line',
                height: '450px'
            },
            series: [{
                name: 'sales',
                data: @json($days)
            }],
            xaxis: {
                categories: @json($sales)
            }
        }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
    </script>
@endpush
