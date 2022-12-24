$(async function () {
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

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Produk/topProdukSales", // Isi dengan url/path file php yang dituju
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

			$("#chartPsales").remove(); // this is my <canvas> element
			$("#chartku").append('<div id="chartPsales"></div>');

			response.product.forEach((t) => {
				indiLabel.push(t.ProductName);
				indiValue.push(parseInt(t.terjual));
			});

			Highcharts.chart("chartPsales", {
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
						text: "Total Unit Sales",
					},
				},
				tooltip: {
					headerFormat:
						'<span style="font-size:10px">{point.key}</span><table>',
					pointFormat:
						'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
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
						name: "Total Unit Sales",
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

	$("#gen").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Produk/topProdukSales", // Isi dengan url/path file php yang dituju
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

				$("#chartPsales").remove(); // this is my <canvas> element
				$("#chartku").append('<div id="chartPsales"></div>');

				response.product.forEach((t) => {
					indiLabel.push(t.ProductName);
					indiValue.push(parseInt(t.terjual));
				});

				Highcharts.chart("chartPsales", {
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
							text: "Total Unit Sales",
						},
					},
					tooltip: {
						headerFormat:
							'<span style="font-size:10px">{point.key}</span><table>',
						pointFormat:
							'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
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
							name: "Total Unit Sales",
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

	$("#kuartal2").change(function () {
		// alert($("#kuartal").val());
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
		} else if ($("#kuartal").val() == "2") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                             <option value="4">April</option>
                                               <option value="5">Mei</option>
                                               <option value="6">Juni</option>
                                               `);
		} else if ($("#kuartal").val() == "3") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                              <option value="7">Juli</option>
                                               <option value="8">Agustus</option>
                                               <option value="9">Spetember</option>
                                               `);
		} else if ($("#kuartal").val() == "4") {
			$("#bulan2").empty();
			$("#bulan2").html(` <option value="all" selected>Semua</option>
                                              <option value="10">Oktober</option>
                                               <option value="11">November</option>
                                               <option value="12">Desember</option>
                                               `);
		}
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Produk/topProdukPurchase", // Isi dengan url/path file php yang dituju
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

			$("#chartPpur").remove(); // this is my <canvas> element
			$("#chartku2").append('<div id="chartPpur"></div>');

			response.product.forEach((t) => {
				indiLabel.push(t.ProductName);
				indiValue.push(parseInt(t.dibeli));
			});

			Highcharts.chart("chartPpur", {
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
						text: "Total Unit Purchase",
					},
				},
				tooltip: {
					headerFormat:
						'<span style="font-size:10px">{point.key}</span><table>',
					pointFormat:
						'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
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
						name: "Total Unit Purchase",
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

	$("#gen2").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Produk/topProdukPurchase", // Isi dengan url/path file php yang dituju
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

				$("#chartPpur").remove(); // this is my <canvas> element
				$("#chartku2").append('<div id="chartPpur"></div>');

				response.product.forEach((t) => {
					indiLabel.push(t.ProductName);
					indiValue.push(parseInt(t.dibeli));
				});

				Highcharts.chart("chartPpur", {
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
							text: "Total Unit Purchase",
						},
					},
					tooltip: {
						headerFormat:
							'<span style="font-size:10px">{point.key}</span><table>',
						pointFormat:
							'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
							'<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
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
							name: "Total Unit Purchase",
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

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Produk/categorySales", // Isi dengan url/path file php yang dituju
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) {
			// $("#loading").hide();
			var a = [];
			var b = [];

			var indiLabel = [];
			var indiValue = [];

			response.forEach((element) => {
				var c = {};
				c.name = element.group.replace(/\s/g, "");
				c.y = element.total;
				c.custom = element.jumlah;

				c.drilldown = element.group.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.group.replace(/\s/g, "");
				d.id = element.group.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});

			$("#chartKat").remove(); // this is my <canvas> element

			$("#chartku3").append('<div id="chartKat"></div>');

			Highcharts.chart("chartKat", {
				chart: {
					type: "pie",
				},
				title: {
					text: "Product Category Chart",
				},

				accessibility: {
					announceNewData: {
						enabled: true,
					},
					point: {
						valueSuffix: "%",
					},
				},

				plotOptions: {
					series: {
						dataLabels: {
							enabled: true,
							format: "{point.name}: {point.y:.1f}%",
						},
					},
				},

				tooltip: {
					useHTML: true,

					formatter: function () {
						var points = this.point;
						console.log(points);
						return (
							`<span style="color:{series.color}"> <b>` +
							points.name +
							` </b></span><br/>
								<span style="color:{series.color}">Total Product : <b>` +
							points.custom +
							`</b></span><br/>`
						);
					},
				},

				series: [
					{
						name: "Group",
						colorByPoint: true,
						data: a,
					},
				],
				drilldown: {
					series: b,
				},
			});
			console.log(a);
			console.log(b);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	// $("#kuartal3").change(function () {
	// 	// alert($("#kuartal").val());
	// 	if ($("#kuartal3").val() == "all") {
	// 		$("#bulan3").empty();
	// 		$("#bulan3").html(` <option value="all" selected>Semua</option>
	//                                            <option value="1">Januari</option>
	//                                            <option value="2">Februari</option>
	//                                            <option value="3">Maret</option>
	//                                            <option value="4">April</option>
	//                                            <option value="5">Mei</option>
	//                                            <option value="6">Juni</option>
	//                                            <option value="7">Juli</option>
	//                                            <option value="8">Agustus</option>
	//                                            <option value="9">Spetember</option>
	//                                            <option value="10">Oktober</option>
	//                                            <option value="11">November</option>
	//                                            <option value="12">Desember</option>`);
	// 	} else if ($("#kuartal3").val() == "1") {
	// 		$("#bulan3").empty();
	// 		$("#bulan3").html(` <option value="all" selected>Semua</option>
	//                                            <option value="1">Januari</option>
	//                                            <option value="2">Februari</option>
	//                                            <option value="3">Maret</option>
	//                                            `);
	// 	} else if ($("#kuartal3").val() == "2") {
	// 		$("#bulan3").empty();
	// 		$("#bulan3").html(` <option value="all" selected>Semua</option>
	//                                          <option value="4">April</option>
	//                                            <option value="5">Mei</option>
	//                                            <option value="6">Juni</option>
	//                                            `);
	// 	} else if ($("#kuartal3").val() == "3") {
	// 		$("#bulan3").empty();
	// 		$("#bulan3").html(` <option value="all" selected>Semua</option>
	//                                           <option value="7">Juli</option>
	//                                            <option value="8">Agustus</option>
	//                                            <option value="9">Spetember</option>
	//                                            `);
	// 	} else if ($("#kuartal3").val() == "4") {
	// 		$("#bulan3").empty();
	// 		$("#bulan3").html(` <option value="all" selected>Semua</option>
	//                                           <option value="10">Oktober</option>
	//                                            <option value="11">November</option>
	//                                            <option value="12">Desember</option>
	//                                            `);
	// 	}
	// });

	// await $.ajax({
	// 	type: "POST", // Method pengiriman data bisa dengan GET atau POST
	// 	url: "http://localhost/adw2022/Produk/categorySales", // Isi dengan url/path file php yang dituju
	// 	data: {
	// 		tahun: $("#tahun3").val(),
	// 		kuartal: $("#kuartal3").val(),
	// 		bulan: $("#bulan3").val(),
	// 	},
	// 	dataType: "json",
	// 	beforeSend: function (e) {
	// 		if (e && e.overrideMimeType) {
	// 			e.overrideMimeType("application/json;charset=UTF-8");
	// 		}
	// 	},
	// 	success: function (response) {
	// 		// $("#loading").hide();
	// 		var a = [];
	// 		var b = [];

	// 		var indiLabel = [];
	// 		var indiValue = [];

	// 		response.forEach((element) => {
	// 			var c = {};
	// 			c.name = element.group.replace(/\s/g, "");
	// 			c.y = element.total;
	// 			c.drilldown = element.group.replace(/\s/g, "");
	// 			a.push(c);

	// 			var d = {};
	// 			d.name = element.group.replace(/\s/g, "");
	// 			d.id = element.group.replace(/\s/g, "");
	// 			d.data = element.drill;
	// 			b.push(d);
	// 		});

	// 		$("#chartKat").remove(); // this is my <canvas> element

	// 		$("#chartku3").append('<div id="chartKat"></div>');

	// 		Highcharts.chart("chartKat", {
	// 			chart: {
	// 				type: "pie",
	// 			},
	// 			title: {
	// 				text: "Category Sales Chart",
	// 			},

	// 			accessibility: {
	// 				announceNewData: {
	// 					enabled: true,
	// 				},
	// 				point: {
	// 					valueSuffix: "%",
	// 				},
	// 			},

	// 			plotOptions: {
	// 				series: {
	// 					dataLabels: {
	// 						enabled: true,
	// 						format: "{point.name}: {point.y:.1f}%",
	// 					},
	// 				},
	// 			},

	// 			tooltip: {
	// 				headerFormat:
	// 					'<span style="font-size:11px">Total Penjualan Berdasarkan Territory</span><br>',
	// 				pointFormat:
	// 					'<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
	// 			},

	// 			series: [
	// 				{
	// 					name: "Group",
	// 					colorByPoint: true,
	// 					data: a,
	// 				},
	// 			],
	// 			drilldown: {
	// 				series: b,
	// 			},
	// 		});
	// 		console.log(a);
	// 		console.log(b);
	// 	},
	// 	error: function (xhr, ajaxOptions, thrownError) {
	// 		// Ketika ada error
	// 		alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
	// 	},
	// });

	// $("#gen3").click(function () {
	// 	$.ajax({
	// 		type: "POST", // Method pengiriman data bisa dengan GET atau POST
	// 		url: "http://localhost/adw2022/Produk/categorySales", // Isi dengan url/path file php yang dituju
	// 		data: {
	// 			tahun: $("#tahun3").val(),
	// 			kuartal: $("#kuartal3").val(),
	// 			bulan: $("#bulan3").val(),
	// 		},
	// 		dataType: "json",
	// 		beforeSend: function (e) {
	// 			if (e && e.overrideMimeType) {
	// 				e.overrideMimeType("application/json;charset=UTF-8");
	// 			}
	// 		},
	// 		success: function (response) {
	// 			// $("#loading").hide();
	// 			var a = [];
	// 			var b = [];

	// 			var indiLabel = [];
	// 			var indiValue = [];

	// 			response.forEach((element) => {
	// 				var c = {};
	// 				c.name = element.group.replace(/\s/g, "");
	// 				c.y = element.total;
	// 				c.drilldown = element.group.replace(/\s/g, "");
	// 				a.push(c);

	// 				var d = {};
	// 				d.name = element.group.replace(/\s/g, "");
	// 				d.id = element.group.replace(/\s/g, "");
	// 				d.data = element.drill;
	// 				b.push(d);
	// 			});

	// 			$("#chartKat").remove(); // this is my <canvas> element

	// 			$("#chartku3").append('<div id="chartKat"></div>');

	// 			Highcharts.chart("chartKat", {
	// 				chart: {
	// 					type: "pie",
	// 				},
	// 				title: {
	// 					text: "Category Sales Chart",
	// 				},

	// 				accessibility: {
	// 					announceNewData: {
	// 						enabled: true,
	// 					},
	// 					point: {
	// 						valueSuffix: "%",
	// 					},
	// 				},

	// 				plotOptions: {
	// 					series: {
	// 						dataLabels: {
	// 							enabled: true,
	// 							format: "{point.name}: {point.y:.1f}%",
	// 						},
	// 					},
	// 				},

	// 				tooltip: {
	// 					headerFormat:
	// 						'<span style="font-size:11px">Total Penjualan Berdasarkan Territory</span><br>',
	// 					pointFormat:
	// 						'<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
	// 				},

	// 				series: [
	// 					{
	// 						name: "Group",
	// 						colorByPoint: true,
	// 						data: a,
	// 					},
	// 				],
	// 				drilldown: {
	// 					series: b,
	// 				},
	// 			});
	// 			console.log(a);
	// 			console.log(b);
	// 		},
	// 		error: function (xhr, ajaxOptions, thrownError) {
	// 			// Ketika ada error
	// 			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
	// 		},
	// 	});
	// });
});
