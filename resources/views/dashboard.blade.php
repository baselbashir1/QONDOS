<x-base-layout>

    <x-slot:pageTitle>لوحة التحكم</x-slot>

    <div class="container mt-4 row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <a href="/clients">
                <div class="card bg-secondary">
                    <div class="card-body pt-3">
                        <p class="card-title mb-3" style="font-size: 20px">العملاء</p>
                        <p class="card-text text-center" style="font-size: 25px">
                            <b>{{ count($clients) }}</b>
                        </p>
                    </div>
                    <div class="card-footer px-4 pt-0 border-0">
                        <p>اضغط هنا لرؤية العملاء</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <a href="/maintenance-technicians">
                <div class="card bg-primary">
                    <div class="card-body pt-3">
                        <p class="card-title mb-3" style="font-size: 20px">فنيو الصيانة</p>
                        <p class="card-text text-center" style="font-size: 25px">
                            <b>{{ count($maintenances) }}</b>
                        </p>
                    </div>
                    <div class="card-footer px-4 pt-0 border-0">
                        <p>اضغط هنا لرؤية الفنيين</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <a href="/join-requests">
                <div class="card bg-dark">
                    <div class="card-body pt-3">
                        <p class="card-title mb-3" style="font-size: 20px">طلبات انضمام الفنيين</p>
                        <p class="card-text text-center" style="font-size: 25px">
                            <b>{{ count($maintenancesJoinRequests) }}</b>
                        </p>
                    </div>
                    <div class="card-footer px-4 pt-0 border-0">
                        <p>اضغط هنا لرؤية طلبات انضمام الفنيين</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <a href="/orders">
                <div class="card bg-danger">
                    <div class="card-body pt-3">
                        <p class="card-title mb-3" style="font-size: 20px">اجمالي مبلغ الطلبات</p>
                        <p class="card-text text-center" style="font-size: 25px">
                            <b>${{ $totalPrice }}</b>
                        </p>
                    </div>
                    <div class="card-footer px-4 pt-0 border-0">
                        <p>اضغط هنا لرؤية الطلبات</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="container mt-4 row">
        <div id="piechart" style="width: 690px; height: 400px;" class="text-right"></div>
        {{-- <div id="columnchart" style="width: 100px; height: 100px;" class="text-left"></div> --}}
        <div id="chart_div" style="width: 690px; height: 400px;" class="text-right"></div>
    </div>

    <div class="container mt-4 row">
        {{-- <div id="chart_div" style="width: 500px; height: 400px;" class="text-right"></div> --}}
        {{-- <div id="columnchart" style="width: 100px; height: 100px;" class="text-left"></div> --}}
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Type', 'Count', {
                    role: 'link'
                }],
                ['تصنيفات رئيسية', <?php echo count($categories); ?>, '/categories'],
                ['تصنيفات فرعية', <?php echo count($subCategories); ?>, '/sub-categories'],
                ['خدمات', <?php echo count($services); ?>, '/services'],
            ]);

            var options = {
                title: 'جميع التصنيفات',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            google.visualization.events.addListener(chart, 'select', function() {
                var selection = chart.getSelection();
                if (selection.length > 0) {
                    var row = selection[0].row;
                    var url = data.getValue(row, 2);
                    window.location.href = url;
                }
            });

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['User Type', 'Count', {
                    role: 'style',
                }, {
                    role: 'link'
                }],
                ['Clients', <?php echo count($clients); ?>, '#b87333', '/clients'],
                ['Maintenances', <?php echo count($maintenances); ?>, 'silver', '/maintenance-technicians'],
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "Users",
                width: 600,
                height: 400,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));

            google.visualization.events.addListener(chart, 'select', function() {
                var selection = chart.getSelection();
                if (selection.length > 0) {
                    var row = selection[0].row;
                    var url = data.getValue(row, 3);
                    window.location.href = url;
                }
            });

            chart.draw(view, options);
        }
    </script>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pizza');
            data.addColumn('number', 'Populartiy');
            data.addColumn(['string', 'Link']);
            data.addRows([
                ['منتهي', <?php echo count($finished); ?>, '/orders'],
                ['قيد التحضير', <?php echo count($processing); ?>, '/orders'],
                ['ملغي', <?php echo count($canceled); ?>, '/orders'],
                ['غير ذلك', <?php echo count($other); ?>, '/orders']
            ]);

            var options = {
                title: 'الطلبات',
                sliceVisibilityThreshold: .2,
                colors: ['green', 'orange', 'red', 'lightgray']
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

            google.visualization.events.addListener(chart, 'select', function() {
                var selectedItem = chart.getSelection()[0];
                if (selectedItem) {
                    var link = data.getValue(selectedItem.row, 2);
                    window.open(link);
                }
            });

            chart.draw(data, options);
        }
    </script>

</x-base-layout>
