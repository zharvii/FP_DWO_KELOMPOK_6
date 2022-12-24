$(async function () {
	$("#example1").DataTable();

	//-------------
	//- DONUT CHART -
	//-------------
	// Get context with jQuery - using jQuery's .get() method.

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Customer/jenisCustomer", // Isi dengan url/path file php yang dituju
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();

			let tipe;
			tipe = response.tipe;
			console.log(tipe);
			Highcharts.chart("chartType", {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: "pie",
				},
				title: {
					text: "Customer Type",
				},
				tooltip: {
					pointFormat:
						"{series.name}: <b>{point.percentage:.1f}%</b><br>Total : {point.y} Customer",
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
								name: tipe[0].type,
								y: parseInt(tipe[0].jumlah),
								custom: parseInt(tipe[0].persen),
							},
							{
								name: tipe[1].type,
								y: parseInt(tipe[1].jumlah),
								custom: parseInt(tipe[1].persen),
							},
						],
					},
				],
			});
			// var donutData = {
			// 	labels: [tipe[0].type, tipe[1].type],
			// 	datasets: [
			// 		{
			// 			data: [tipe[0].jumlah, tipe[1].jumlah],
			// 			backgroundColor: ["#f56954", "#00c0ef"],
			// 		},
			// 	],
			// };
			// var donutOptions = {
			// 	maintainAspectRatio: false,
			// 	responsive: true,
			// };
			// //Create pie or douhnut chart
			// // You can switch between pie and douhnut using the method below.
			// new Chart(donutChartCanvas, {
			// 	type: "pie",
			// 	data: donutData,
			// 	options: donutOptions,
			// });
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Customer/topIndividual", // Isi dengan url/path file php yang dituju
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
			var indiLabel = [];
			var indiValue = [];
			var indiTotal = [];

			$("#chartIndi").remove(); // this is my <canvas> element
			$("#chartku").append('<div id="chartIndi"></div>');

			response.individual.forEach((t) => {
				indiLabel.push(t.Name);
				indiValue.push(parseInt(t.jumlah));
				indiTotal.push(parseInt(t.total));
			});

			Highcharts.chart("chartIndi", {
				chart: {
					type: "column",
				},
				title: {
					text: "Chart",
				},

				xAxis: {
					categories: indiLabel,
					crosshair: true,
				},
				yAxis: {
					min: 0,
					title: {
						text: "Total Order",
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
						name: "Total Order",
						data: indiValue,
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
		url: "http://localhost/adw2022/Customer/topReseller", // Isi dengan url/path file php yang dituju
		data: {
			tahun: $("#tahun2").val(),
			kuartal: $("#kuartal2").val(),
			bulan: $("#bulan2").val(),
		},
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();
			var indiLabel = [];
			var indiValue = [];
			var indiTotal = [];

			$("#chartResel").remove(); // this is my <canvas> element
			$("#chartku2").append('<div id="chartResel"></div>');

			response.reseller.forEach((t) => {
				indiLabel.push(t.Name);
				indiValue.push(parseInt(t.jumlah));
				indiTotal.push(parseInt(t.total));
			});

			Highcharts.chart("chartResel", {
				chart: {
					type: "column",
				},
				title: {
					text: "Chart",
				},

				xAxis: {
					categories: indiLabel,
					crosshair: true,
				},
				yAxis: {
					min: 0,
					title: {
						text: "Total Order",
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
						name: "Total Order",
						data: indiValue,
					},
				],
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	$("#kuartal").change(function () {
		// alert($("#kuartal").val());
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

	$("#kuartal2").change(function () {
		// $("#kuartal2").val();
		if ($("#kuartal2").val() == "all") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
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
		} else if ($("#kuartal2").val() == "1") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                               <option value="1">Januari</option>
                                               <option value="2">Februari</option>
                                               <option value="3">Maret</option>
                                               `);
		} else if ($("#kuartal2").val() == "2") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                             <option value="4">April</option>
                                               <option value="5">Mei</option>
                                               <option value="6">Juni</option>
                                               `);
		} else if ($("#kuartal2").val() == "3") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                              <option value="7">Juli</option>
                                               <option value="8">Agustus</option>
                                               <option value="9">Spetember</option>
                                               `);
		} else if ($("#kuartal2").val() == "4") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                              <option value="10">Oktober</option>
                                               <option value="11">November</option>
                                               <option value="12">Desember</option>
                                               `);
		}
	});

	$("#gen").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Customer/topIndividual", // Isi dengan url/path file php yang dituju
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
				var indiLabel = [];
				var indiValue = [];
				var indiTotal = [];

				$("#chartIndi").remove(); // this is my <canvas> element
				$("#chartku").append('<div id="chartIndi"></div>');

				response.individual.forEach((t) => {
					indiLabel.push(t.Name);
					indiValue.push(parseInt(t.jumlah));
					indiTotal.push(parseInt(t.total));
				});

				Highcharts.chart("chartIndi", {
					chart: {
						type: "column",
					},
					title: {
						text: "Chart",
					},

					xAxis: {
						categories: indiLabel,
						crosshair: true,
					},
					yAxis: {
						min: 0,
						title: {
							text: "Total Order",
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
							name: "Total Order",
							data: indiValue,
						},
					],
				});
			},
			error: function (xhr, ajaxOptions, thrownError) {
				// Ketika ada error
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
			},
		});
	});

	$("#gen2").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Customer/topReseller", // Isi dengan url/path file php yang dituju
			data: {
				tahun: $("#tahun2").val(),
				kuartal: $("#kuartal2").val(),
				bulan: $("#bulan2").val(),
			},
			dataType: "json",
			beforeSend: function (e) {
				if (e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function (response) {
				// $("#loading").hide();
				var indiLabel = [];
				var indiValue = [];
				var indiTotal = [];

				$("#chartResel").remove(); // this is my <canvas> element
				$("#chartku2").append('<div id="chartResel"></div>');

				response.reseller.forEach((t) => {
					indiLabel.push(t.Name);
					indiValue.push(parseInt(t.jumlah));
					indiTotal.push(parseInt(t.total));
				});

				Highcharts.chart("chartResel", {
					chart: {
						type: "column",
					},
					title: {
						text: "Chart",
					},

					xAxis: {
						categories: indiLabel,
						crosshair: true,
					},
					yAxis: {
						min: 0,
						title: {
							text: "Total Order",
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
							name: "Total Order",
							data: indiValue,
						},
					],
				});
			},
			error: function (xhr, ajaxOptions, thrownError) {
				// Ketika ada error
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
			},
		});
	});
});
