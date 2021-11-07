<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:adminlogin.php');
} else {


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>統計</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"/>
        <!-- FONT AWESOME STYLE  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"/>
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">統計期間</h4>
                </div>
                <div class="chart_statistic">
                    <div class="wrap_date">
                        <div style="width: 220px">
                            <div class="form-group" style="margin-bottom: 0px">
                                <div class='input-group date' id='start_date'>
                                    <input type='text' class="form-control" class="start_date_class"/>
                                    <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                                </div>
                            </div>
                        </div>
                        <div class="tilde">~</div>
                        <div style="width: 220px">
                            <div class="form-group" style="margin-bottom: 0px">
                                <div class='input-group date' id='end_date'>
                                    <input type='text' class="form-control"/>
                                    <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                                   </span>
                                </div>
                            </div>
                        </div>
                        <button
                            name="trigger_statistic" class="btn btn-info" onclick="trigger_show_statistic()"
                            style="margin-left: 15px"
                        >
                            集計
                        </button>
                    </div>
                    <div class="row">
                        <div class='col-sm-12'>
                            <div class='bar_chart_statistic'>
                                <canvas id="barChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-sm-12'>
                        <div class='pie_chart_statistic'>
                            <canvas id="pieChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!--        <script data-require="chart.js@0.2.0" data-semver="0.2.0" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            function trigger_show_statistic() {
                var new_start_date = moment($('#start_date').datepicker("getDate")).format('YYYY-MM-DD');
                var new_end_date = moment($('#end_date').datepicker("getDate")).format('YYYY-MM-DD');
                getData(new_start_date, new_end_date);
            }
            var ctx = document.getElementById('barChart');
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: '学年ごとの貸出冊数',
                        data: [],
                        backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgba(54, 162, 235, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            $(document).ready(function() {
                $.fn.datepicker.dates['ja'] = {
                    days: ["日曜", "月曜", "火曜", "水曜", "木曜", "金曜", "土曜", "日曜"],
                    daysShort: ["日", "月", "火", "水", "木", "金", "土", "日"],
                    daysMin: ["日", "月", "火", "水", "木", "金", "土", "日"],
                    months: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
                    monthsShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
                    today: "今日",
                    format: "yyyy/mm/dd",
                    clear: "クリア"
                };
                var start_date = new Date();
                var end_date = new Date();
                start_date.setMonth(start_date.getMonth() - 6);

                // barChart.data.labels = ['a', 'b'];
                // barChart.data.datasets.data = [3, 5];
                // barChart.data.datasets.backgroundColor = ['red', 'blue'];
                // barChart.data.datasets.borderColor = ['red', 'blue'];
                // barChart.update();

                getData(start_date, end_date, barChart);
                console.log('barChart', barChart.data)
                $("#start_date").datepicker({
                    isRTL: false,
                    format: "dd/mm/yyyy",
                    autoclose: true,
                    language: 'ja'
                }).datepicker('setDate', start_date).datepicker('update');
                // $('#start_date').datepicker().on('changeDate', function (e) {
                //     var new_end_date = moment($('#end_date').datepicker("getDate")).format('YYYY-MM-DD');
                //     var new_start_date = moment(e.date).format('YYYY-MM-DD');
                //     console.log("dfgd", new_start_date, new_end_date);
                //     getData(new_start_date, new_end_date);
                // });

                $("#end_date").datepicker({
                    isRTL: false,
                    format: "dd/mm/yyyy",
                    autoclose: true,
                    language: 'ja'
                }).datepicker('setDate', end_date).datepicker('update');
                // $('#end_date').datepicker().on('changeDate', function (e) {
                //     var new_start_date = moment($('#start_date').datepicker("getDate")).format('YYYY-MM-DD');
                //     var new_end_date = moment(e.date).format('YYYY-MM-DD');
                //     console.log("12345", new_start_date, new_end_date);
                //     getData(new_start_date, new_end_date);
                // });

                // get category info
                $.ajax({
                    url: "common/category_info.php",
                    type: "GET",
                    cache: false,
                    data:{
                    },
                    success: function(dataResult){
                        var category_colors = [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'green',
                            '#CC6B19'
                        ];
                        var transformData = JSON.parse(dataResult);
                        console.log("transformData", transformData);
                        var book_total = 0;
                        var chart_category_colors = [];
                        var cat_labels = [];
                        var cat_percent = [];
                        transformData.map((item, key) => {
                            book_total += +item.TotalCount
                            chart_category_colors.push(category_colors[key % 5])
                            cat_labels.push(item.CategoryName)
                        })
                        transformData.map((item, key) => {
                            cat_percent.push(Math.round(((item.TotalCount / book_total) + Number.EPSILON) * 100))
                        })
                        console.log("11", book_total, chart_category_colors, cat_labels, cat_percent);
                        // pie chat
                        var ctx = document.getElementById('pieChart');
                        var pieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: cat_labels,
                                datasets: [{
                                    label: 'My First Dataset',
                                    data: cat_percent,
                                    backgroundColor: chart_category_colors,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem, data) {
                                                return ' ' + tooltipItem['formattedValue'] + '%';
                                            },
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            })
            function getData(start_date, end_date){
                var year_student_labels = {
                    '1': "1年生",
                    '2': "2年生",
                    '3': "3年生",
                    '4': "4年生"
                };
                $.ajax({
                    url: "common/statistic_info.php",
                    type: "GET",
                    cache: false,
                    data:{
                        start_date: moment(start_date).format('YYYY-MM-DD'),
                        end_date: moment(end_date).format('YYYY-MM-DD')
                    },
                    success: function(dataResult){
                        var transformData = JSON.parse(dataResult);
                        var lend_book_numbers = transformData.map(item => item.TotalCount)
                        var year_students = transformData.map(item => {
                            var year_student = year_student_labels[item.year_ordinal]
                            return year_student ? year_student : 'Sinh viên'
                        })

                        var backgroundColor = Array(year_students.length).fill('rgba(54, 162, 235, 0.2)');
                        var borderColor = Array(year_students.length).fill('rgba(54, 162, 235, 1)');

                        // barChart.data.labels = year_students;
                        // barChart.data.datasets.data = lend_book_numbers;
                        // barChart.data.datasets.backgroundColor = backgroundColor;
                        // barChart.data.datasets.borderColor = borderColor;
                        // data: {
                        //     labels: year_students,
                        //         datasets: [{
                        //         label: 'Số sách mượn trả',
                        //         data: lend_book_numbers,
                        //         backgroundColor: backgroundColor,
                        //         borderColor: borderColor,
                        //         borderWidth: 1
                        //     }]
                        // }
                        barChart.destroy();
                        var ctx = document.getElementById('barChart');
                        barChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: year_students,
                                datasets: [{
                                    label: '学年ごとの貸出冊数',
                                    data: lend_book_numbers,
                                    backgroundColor: backgroundColor,
                                    borderColor: borderColor,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: '冊数'
                                        }
                                    },
                                    x: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: '学年'
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            }
        </script>
    </body>
    </html>
<?php } ?>
