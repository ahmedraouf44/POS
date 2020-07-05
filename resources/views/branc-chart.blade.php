@extends("include")

@section("body")

        <!-- Main Section ------------------------------------------------------------------------------->

        <div class="main-cont chrt">
            <div class="new-chrt">
                <h3>إجمالي المبيعات</h3>
                <hr>
                <canvas id="sales"></canvas>
            </div>
            <div class="new-chrt">
                <h3>العملاء</h3>
                <hr>
                <canvas id="customer"></canvas>
            </div>
            <div class="new-chrt">
                <h3>الأذونات</h3>
                <hr>
                <canvas id="docs"></canvas>
            </div>
            <div class="new-chrt">
                <h3>الأذونات</h3>
                <hr>
                <canvas id="docs-2"></canvas>
            </div>
        </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: '/charts',
                type: "get",
                data:{"chart":'sales'},
                contentType: 'application/json; charset=utf-8',
                success: function (data) {

                    var sales = document.getElementById('sales');
                    var saleschart = new Chart(sales, {
                        type: 'line',
                        data: {
                            labels: data['alldates'],
                            datasets: [{
                                label: 'إجمالي المبيعات',
                                data: data['allamounts'],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }],

                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });


                }



            });
            // chart ----------------

            // chart ----------------
            var customer = document.getElementById('customer');
            var customerchart = new Chart(customer, {
                type: 'pie',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            // chart ----------------
            var docs = document.getElementById('docs');
            var docschart = new Chart(docs, {
                type: 'bar',
                data: {
                    labels: ['الصادر', 'الوارد', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'الأذونات',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            // chart ----------------
            var customer = document.getElementById('docs-2');
            var customerchart = new Chart(customer, {
                type: 'pie',
                data: {
                    labels: ['Red'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        });

    </script>
@endsection
