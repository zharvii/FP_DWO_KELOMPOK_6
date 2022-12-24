$(async function () {
	$("#example1").DataTable();

	// Create our number formatter.
	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",

		// These options are needed to round to whole numbers if that's what you want.
		//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
		//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
	});

	console.log(formatter.format(2500)); /* $2,500.00 */
	//-------------
	//- DONUT CHART -
	//-------------
	// Get context with jQuery - using jQuery's .get() method.

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Employee/employeeGender", // Isi dengan url/path file php yang dituju
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();
			let gender;

			gender = response.gender;

			console.log(gender);
			Highcharts.chart("chartGender", {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: "pie",
				},
				title: {
					text: "Employee Gender",
				},
				tooltip: {
					pointFormat:
						"{series.name}: <b>{point.percentage:.1f}%</b><br>Total : {point.custom} Employees",
				},
				accessibility: {
					point: {
						valueSuffix: "%",
					},
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: "pointer",
						dataLabels: {
							enabled: true,
							format: "<b>{point.name}</b>: {point.percentage:.1f} %",
						},
					},
				},
				series: [
					{
						name: "Brands",
						colorByPoint: true,
						data: [
							{
								name: gender[0].Gender,
								y: parseInt(gender[0].persen),
								custom: parseInt(gender[0].jumlah),
							},
							{
								name: gender[1].Gender,
								y: parseInt(gender[1].persen),
								custom: parseInt(gender[1].jumlah),
							},
						],
					},
				],
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Employee/topSales", // Isi dengan url/path file php yang dituju
		data: {
			tahun: $("#tahun").val(),
			kuartal: $("#kuartal").val(),
			bulan: $("#bulan").val(),
		},
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();
			if (response.sales.length == 0) {
				$("#kosong").show();
				$("#chartEmpSales").hide();
			} else {
				$("#kosong").hide();
				$("#chartEmpSales").show();
				$("#chartEmpSales").remove(); // this is my <canvas> element
				$("#chartku").append('<div id="chartEmpSales"></div>');
				// $("#loading").hide();
				var salesLabel = [];
				var salesValue = [];
				var salesRevenue = [];
				response.sales.forEach((t) => {
					salesLabel.push(t.Name);
					salesValue.push(parseInt(t.jumlah));
					salesRevenue.push(parseInt(t.revenue));
				});

				Highcharts.chart("chartEmpSales", {
					chart: {
						type: "column",
					},
					title: {
						text: "Chart",
					},
					
					xAxis: {
						categories: salesLabel,
						crosshair: true,
					},
					yAxis: {
						min: 0,
						title: {
							text: "Total Sales",
						},
					},
					tooltip: {
						headerFormat:
							'<span style="font-size:10px">{point.key}</span><table>',
						pointFormat:
							'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y}</b></td></tr>',
						footerFormat: "</table>",
						shared: true,
						useHTML: true,
					},
					plotOptions: {
						column: {
							pointPadding: 0.3,
							borderWidth: 0,
						},
					},
					series: [
						{
							name: "Total Sales",
							data: salesValue,
						},
					],
				});

				// Highcharts.chart("chartEmpSales", {
				// 	chart: {
				// 		zoomType: "xy",
				// 	},
				// 	title: {
				// 		text: "Chart",
				// 		align: "center",
				// 	},

				// 	xAxis: [
				// 		{
				// 			categories: salesLabel,
				// 			crosshair: true,
				// 		},
				// 	],
				// 	yAxis: [
				// 		{
				// 			// Primary yAxis
				// 			labels: {
				// 				format: "{value}",
				// 				style: {
				// 					color: Highcharts.getOptions().colors[1],
				// 				},
				// 			},
				// 			title: {
				// 				text: "Total Sales",
				// 				style: {
				// 					color: Highcharts.getOptions().colors[1],
				// 				},
				// 			},
				// 		},
				// 		{
				// 			// Secondary yAxis
				// 			title: {
				// 				text: "Revenue",
				// 				style: {
				// 					color: Highcharts.getOptions().colors[0],
				// 				},
				// 			},
				// 			labels: {
				// 				format: "${value}",
				// 				style: {
				// 					color: Highcharts.getOptions().colors[0],
				// 				},
				// 			},
				// 			opposite: true,
				// 		},
				// 	],
				// 	tooltip: {
				// 		shared: true,

				// 		useHTML: true,

				// 		formatter: function () {
				// 			var points = this.points;
				// 			// console.log(points);
				// 			return (
				// 				`<span style="color:{series.color}"> <b>` +
				// 				points[0].x +
				// 				` </b></span><br/>
				// 		<span style="color:{series.color}">Total Sales : <b>` +
				// 				points[1].y +
				// 				`</b></span><br/>
				// 			<span style="color:{series.color}">Revenue : <b>` +
				// 				formatter.format(points[0].y) +
				// 				`</b></span><br/>`
				// 			);
				// 		},
				// 	},
				// 	legend: {
				// 		align: "left",
				// 		x: 80,
				// 		verticalAlign: "top",
				// 		y: 30,
				// 		floating: true,
				// 		backgroundColor:
				// 			Highcharts.defaultOptions.legend.backgroundColor || // theme
				// 			"rgba(255,255,255,0.25)",
				// 	},
				// 	series: [
				// 		{
				// 			name: "Revenue",
				// 			type: "column",
				// 			yAxis: 1,
				// 			data: salesRevenue,
				// 		},
				// 		{
				// 			name: "Total Sales",
				// 			type: "spline",
				// 			data: salesValue,
				// 		},
				// 	],
				// });
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	$("#kuartal").change(function () {
		if ($("#kuartal").val() == "all") {
			$("#bulan").empty();
			$("#bulan").html(` <option value="all" selected>Semua</option>
                                               <option value="1">Januari</option>
                                               <option value="2">Februari</option>
                                               <option value="3">Maret</option>
                                               <option value="4">April</option>
                                               <option value="5">Mei</option>
                                               <option value="6">Juni</option>
                                               <option value="7">Juli</option>
                                               <option value="8">Agustus</option>
                                               <option value="9">Spetember</option>
                                               <option value="10">Oktober</option>
                                               <option value="11">November</option>
                                               <option value="12">Desember</option>`);
		} else if ($("#kuartal").val() == "1") {
			$("#bulan").empty();
			$("#bulan").html(` <option value="all" selected>Semua</option>
                                               <option value="1">Januari</option>
                                               <option value="2">Februari</option>
                                               <option value="3">Maret</option>
                                               `);
		} else if ($("#kuartal").val() == "2") {
			$("#bulan").empty();
			$("#bulan").html(` <option value="all" selected>Semua</option>
                                             <option value="4">April</option>
                                               <option value="5">Mei</option>
                                               <option value="6">Juni</option>
                                               `);
		} else if ($("#kuartal").val() == "3") {
			$("#bulan").empty();
			$("#bulan").html(` <option value="all" selected>Semua</option>
                                              <option value="7">Juli</option>
                                               <option value="8">Agustus</option>
                                               <option value="9">Spetember</option>
                                               `);
		} else if ($("#kuartal").val() == "4") {
			$("#bulan").empty();
			$("#bulan").html(` <option value="all" selected>Semua</option>
                                              <option value="10">Oktober</option>
                                               <option value="11">November</option>
                                               <option value="12">Desember</option>
                                               `);
		}
	});

	$("#gen").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Employee/topSales", // Isi dengan url/path file php yang dituju
			data: {
				tahun: $("#tahun").val(),
				kuartal: $("#kuartal").val(),
				bulan: $("#bulan").val(),
			},
			dataType: "json",
			beforeSend: function (e) {
				if (e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function (response) {
				// $("#loading").hide();
				if (response.sales.length == 0) {
					$("#kosong").show();
					$("#chartEmpSales").hide();
				} else {
					$("#kosong").hide();
					$("#chartEmpSales").show();
					$("#chartEmpSales").remove(); // this is my <canvas> element
					$("#chartku").append('<div id="chartEmpSales"></div>');
					// $("#loading").hide();
					var salesLabel = [];
					var salesValue = [];
					var salesRevenue = [];
					response.sales.forEach((t) => {
						salesLabel.push(t.Name);
						salesValue.push(parseInt(t.jumlah));
						salesRevenue.push(parseInt(t.revenue));
					});

					Highcharts.chart("chartEmpSales", {
						chart: {
							type: "column",
						},
						title: {
							text: "Chart",
						},

						xAxis: {
							categories: salesLabel,
							crosshair: true,
						},
						yAxis: {
							min: 0,
							title: {
								text: "Total Sales",
							},
						},
						tooltip: {
							headerFormat:
								'<span style="font-size:10px">{point.key}</span><table>',
							pointFormat:
								'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
								'<td style="padding:0"><b>{point.y}</b></td></tr>',
							footerFormat: "</table>",
							shared: true,
							useHTML: true,
						},
						plotOptions: {
							column: {
								pointPadding: 0.3,
								borderWidth: 0,
							},
						},
						series: [
							{
								name: "Total Sales",
								data: salesValue,
							},
						],
					});

					// Highcharts.chart("chartEmpSales", {
					// 	chart: {
					// 		zoomType: "xy",
					// 	},
					// 	title: {
					// 		text: "Chart",
					// 		align: "center",
					// 	},

					// 	xAxis: [
					// 		{
					// 			categories: salesLabel,
					// 			crosshair: true,
					// 		},
					// 	],
					// 	yAxis: [
					// 		{
					// 			// Primary yAxis
					// 			labels: {
					// 				format: "{value}",
					// 				style: {
					// 					color: Highcharts.getOptions().colors[1],
					// 				},
					// 			},
					// 			title: {
					// 				text: "Total Sales",
					// 				style: {
					// 					color: Highcharts.getOptions().colors[1],
					// 				},
					// 			},
					// 		},
					// 		{
					// 			// Secondary yAxis
					// 			title: {
					// 				text: "Revenue",
					// 				style: {
					// 					color: Highcharts.getOptions().colors[0],
					// 				},
					// 			},
					// 			labels: {
					// 				format: "${value}",
					// 				style: {
					// 					color: Highcharts.getOptions().colors[0],
					// 				},
					// 			},
					// 			opposite: true,
					// 		},
					// 	],
					// 	tooltip: {
					// 		shared: true,

					// 		useHTML: true,

					// 		formatter: function () {
					// 			var points = this.points;
					// 			// console.log(points);
					// 			return (
					// 				`<span style="color:{series.color}"> <b>` +
					// 				points[0].x +
					// 				` </b></span><br/>
					// 		<span style="color:{series.color}">Total Sales : <b>` +
					// 				points[1].y +
					// 				`</b></span><br/>
					// 			<span style="color:{series.color}">Revenue : <b>` +
					// 				formatter.format(points[0].y) +
					// 				`</b></span><br/>`
					// 			);
					// 		},
					// 	},
					// 	legend: {
					// 		align: "left",
					// 		x: 80,
					// 		verticalAlign: "top",
					// 		y: 30,
					// 		floating: true,
					// 		backgroundColor:
					// 			Highcharts.defaultOptions.legend.backgroundColor || // theme
					// 			"rgba(255,255,255,0.25)",
					// 	},
					// 	series: [
					// 		{
					// 			name: "Revenue",
					// 			type: "column",
					// 			yAxis: 1,
					// 			data: salesRevenue,
					// 		},
					// 		{
					// 			name: "Total Sales",
					// 			type: "spline",
					// 			data: salesValue,
					// 		},
					// 	],
					// });
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				// Ketika ada error
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
			},
		});

	});
});
