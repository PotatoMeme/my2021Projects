<?php
	/* 누적예약 */
	$bestRoom_label="";
	$bestRoom_data="";
	foreach($bestRoom_list as $row){
		$bestRoom_label .= "'$row->room_name',"; //('$row->hotel_name')
		$bestRoom_data .= $row->room_count.',';
	}

	/* 호텔선호도 */
	$bestHotel_label="";
	$bestHotel_data="";
	foreach($bestHotel_list as $row){
		$bestHotel_label.= "'$row->hotel_name',";
		$bestHotel_data .= $row->days.',';
	}

	/* 지역별 호텔 수 */
	$hotelArea_label="";
	$hotelArea_data="";
	foreach($hotelArea_list as $row){
		$hotelArea_label.= "'$row->area_name',";
		$hotelArea_data .= $row->area_num.',';
	}
?>
<script>
	$(function(){
		$('#text1') .datetimepicker({
			locale: 'ko',
			format: 'YYYY',
			defaultDate: moment()
		});
		$("#text1") .on("dp.change", function (e) {find_text();});
	});

	function find_text()
	{
		form1.action="/~team5/admin/charts/lists/text1/" + form1.text1.value;
		form1.submit();
	}

</script>
		
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<p></p>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" style="font-weight:600;">Charts</h1>

                    <!-- Content Row -->
					<form name="form1" action="" method="post">
						<div class="row">
							<div class="col-11" align="left"> 
								<div class="form-inline">
									<div class="input-group date mb-2" id="text1">
										<div class="input-group-prepend">
											<span class="input-group-text">날짜</span>
										</div>
											<input  type="text" name="text1" class="form-control" value="<?=$text1?>" onKeydown="if (event.keyCode == 13) {find_text();}">
										<div class="input-group-append">
											<div class="input-group-text">
												<div class="input-group-addon">
													<i class="far fa-calendar-alt fa-lg-sm"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Area Chart -->
							<div class="col-xl-8 col-lg-7">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">올해 매출</h6>
									</div>
									<!-- Card Body -->
									<div class="card-body">
										<div class="chart-area">
											<canvas id="yearlyPrices"></canvas>
										</div>
									</div>
								</div>
							</div>


							<!-- Pie Chart -->
							<div class="col-xl-4 col-lg-5">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">호텔 선호도</h6>
									</div>
									<!-- Card Body -->
									<div class="card-body">
										<div class="chart-pie my-3">
											<canvas id="bestHotelChart"></canvas>
										</div>
									</div>
								</div>
							</div>
			  

							<!-- Area Chart -->
							<div class="col-xl-8 col-lg-7">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">누적 예약</h6>
									</div>
									<!-- Card Body -->
									<div class="card-body">
										<div class="chart-area">
											<canvas id="bestRoomChart"></canvas>
										</div>
									</div>
								</div>
							</div>


							<!-- Pie Chart -->
							<div class="col-xl-4 col-lg-5">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">지역 분포도</h6>
									</div>
									<!-- Card Body -->
									<div class="card-body">
										<div class="chart-pie my-3">
											<canvas id="hotelAreaCharts"></canvas>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/~team5/my/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/~team5/my/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/~team5/my/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/~team5/my/vendor/chart.js/Chart.min.js"></script>


	<?php
	foreach($price_list as $row){
			
	?>
<!--1번 그래프 -->
	<script>
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	function number_format(number, decimals, dec_point, thousands_sep) {
	  // *     example: number_format(1234.56, 2, ',', ' ');
	  // *     return: '1 234,56'
	  number = (number + '').replace(',', '').replace(' ', '');
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + Math.round(n * k) / k;
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	  }
	  return s.join(dec);
	}

	// Area Chart Example
	var ctx = document.getElementById("yearlyPrices");
	var myLineChart = new Chart(ctx, {
	  type: 'line',
	  data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [{
		  label: "Earnings",
		  lineTension: 0.3,
		  backgroundColor: "rgba(78, 115, 223, 0.05)",
		  borderColor: "rgba(78, 115, 223, 1)",
		  pointRadius: 3,
		  pointBackgroundColor: "rgba(78, 115, 223, 1)",
		  pointBorderColor: "rgba(78, 115, 223, 1)",
		  pointHoverRadius: 3,
		  pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
		  pointHoverBorderColor: "rgba(78, 115, 223, 1)",
		  pointHitRadius: 10,
		  pointBorderWidth: 2,
		  data: [<?=$row->s1?>, <?=$row->s2?>, <?=$row->s3?>, <?=$row->s4?>, <?=$row->s5?>, <?=$row->s6?>, <?=$row->s7?>, <?=$row->s8?>, <?=$row->s9?>, <?=$row->s10?>,<?=$row->s11?>, <?=$row->s12?>],
		}],
	  },
	  options: {
		maintainAspectRatio: false,
		layout: {
		  padding: {
			left: 10,
			right: 25,
			top: 25,
			bottom: 0
		  }
		},
		scales: {
		  xAxes: [{
			time: {
			  unit: 'date'
			},
			gridLines: {
			  display: false,
			  drawBorder: false
			},
			ticks: {
			  maxTicksLimit: 7
			}
		  }],
		  yAxes: [{
			ticks: {
			  maxTicksLimit: 5,
			  padding: 10,
			  // Include a dollar sign in the ticks
			  callback: function(value, index, values) {
				return '₩ ' + number_format(value);
			  }
			},
			gridLines: {
			  color: "rgb(234, 236, 244)",
			  zeroLineColor: "rgb(234, 236, 244)",
			  drawBorder: false,
			  borderDash: [2],
			  zeroLineBorderDash: [2]
			}
		  }],
		},
		legend: {
		  display: false
		},
		tooltips: {
		  backgroundColor: "rgb(255,255,255)",
		  bodyFontColor: "#858796",
		  titleMarginBottom: 10,
		  titleFontColor: '#6e707e',
		  titleFontSize: 14,
		  borderColor: '#dddfeb',
		  borderWidth: 1,
		  xPadding: 15,
		  yPadding: 15,
		  displayColors: false,
		  intersect: false,
		  mode: 'index',
		  caretPadding: 10,
		  callbacks: {
			label: function(tooltipItem, chart) {
			  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
			  return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
			}
		  }
		}
	  }
	},);

	</script>
<?php
	}
?>


<!-- 2번 그래프 -->

<script>
 // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("bestRoomChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?=$bestRoom_label?>],
    datasets: [{
      label: "Revenue",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [<?=$bestRoom_data?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value) + "건";
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return number_format(tooltipItem.yLabel) + "건";
        }
      }
    },
  }
});
</script>


<!-- 1번도넛 -->
	<script>
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	// Pie Chart Example
	var ctx = document.getElementById("bestHotelChart");
	var myPieChart = new Chart(ctx, {
	  type: 'doughnut',
	  data: {
		labels: [<?=$bestHotel_label; ?>],
		datasets: [{
		  data: [<?=$bestHotel_data; ?>],
		  backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
		  hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
		  hoverBorderColor: "rgba(234, 236, 244, 1)",
		}],
	  },
	  options: {
		maintainAspectRatio: false,
		tooltips: {
		  backgroundColor: "rgb(255,255,255)",
		  bodyFontColor: "#858796",
		  borderColor: '#dddfeb',
		  borderWidth: 1,
		  xPadding: 15,
		  yPadding: 15,
		  displayColors: false,
		  caretPadding: 10,
		},
		legend: {
		  display: true
		},
		cutoutPercentage: 50,
	  },
	});

	</script>


<!-- 2번도넛 -->
	<script>
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	// Pie Chart Example
	var ctx = document.getElementById("hotelAreaCharts");
	var myPieChart = new Chart(ctx, {
	  type: 'doughnut',
	  data: {
		labels: [<?=$hotelArea_label; ?>],
		datasets: [{
		  data: [<?=$hotelArea_data; ?>],
		  backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
		  hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
		  hoverBorderColor: "rgba(234, 236, 244, 1)",
		}],
	  },
	  options: {
		maintainAspectRatio: false,
		tooltips: {
		  backgroundColor: "rgb(255,255,255)",
		  bodyFontColor: "#858796",
		  borderColor: '#dddfeb',
		  borderWidth: 1,
		  xPadding: 15,
		  yPadding: 15,
		  displayColors: false,
		  caretPadding: 10,
		},
		legend: {
		  display: true
		},
		cutoutPercentage: 50,
	  },
	});

	</script>

</body>

</html>