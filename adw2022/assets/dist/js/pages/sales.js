$(async function () {
	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",

		// These options are needed to round to whole numbers if that's what you want.
		//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
		//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
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

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Sales/salesType", // Isi dengan url/path file php yang dituju
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

			$("#chartType").remove(); // this is my <canvas> element
			$("#chartku3").append('<div id="chartType"></div>');

			let type;

			type = response.data;

			console.log(type);
			Highcharts.chart("chartType", {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: "pie",
				},
				title: {
					text: "Sales Type",
				},
				tooltip: {
					pointFormat:
						"{series.name}: <b>{point.percentage:.1f}%</b><br>Total : {point.custom} Order",
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
								name: type[0].tipe,
								y: parseInt(type[0].persen),
								custom: parseInt(type[0].jumlah),
							},
							{
								name: type[1].tipe,
								y: parseInt(type[1].persen),
								custom: parseInt(type[1].jumlah),
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

	$("#gen").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Sales/salesType", // Isi dengan url/path file php yang dituju
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

				$("#chartType").remove(); // this is my <canvas> element
				$("#chartku3").append('<div id="chartType"></div>');

				let type;

				type = response.data;

				console.log(type);
				Highcharts.chart("chartType", {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: "pie",
					},
					title: {
						text: "Sales Type",
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
									name: type[0].tipe,
									y: parseInt(type[0].persen),
									custom: parseInt(type[0].jumlah),
								},
								{
									name: type[1].tipe,
									y: parseInt(type[1].persen),
									custom: parseInt(type[1].jumlah),
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
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Sales/salesRev", // Isi dengan url/path file php yang dituju
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

			response.forEach((element) => {
				var c = {};
				c.name = element.tahun.replace(/\s/g, "");
				c.y = element.total;
				c.drilldown = element.tahun.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.tahun.replace(/\s/g, "");
				d.id = element.tahun.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});

			$("#chartRev").remove(); // this is my <canvas> element

			$("#chartku").append('<div id="chartRev"></div>');

			Highcharts.chart("chartRev", {
				chart: {
					type: "column",
				},
				title: {
					text: "Chart",
				},
				accessibility: {
					announceNewData: {
						enabled: true,
					},
				},
				xAxis: {
					type: "category",
				},
				yAxis: {
					title: {
						text: "Sales Revenue",
					},
				},
				legend: {
					enabled: false,
				},
				plotOptions: {
					series: {
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							formatter: function () {
								return formatter.format(this.y);
							},
						},
					},
				},

				tooltip: {
					useHTML: true,

					formatter: function () {
						var points = this.point;
						// console.log(this.y);
						return (
							`<span style="color:{series.color}"> <b>` +
							points.name +
							` </b></span><br/>
								<span style="color:{series.color}">Revenue : <b>` +
							formatter.format(points.y) +
							`</b></span><br/>`
						);
					},
				},

				series: [
					{
						name: "Tahun",
						colorByPoint: true,
						data: a,
					},
				],
				drilldown: {
					breadcrumbs: {
						position: {
							align: "right",
						},
					},
					series: b,
				},
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Sales/salesTrend", // Isi dengan url/path file php yang dituju
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

			response.forEach((element) => {
				var c = {};
				c.name = element.tahun.replace(/\s/g, "");
				c.y = element.total;
				c.drilldown = element.tahun.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.tahun.replace(/\s/g, "");
				d.id = element.tahun.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});

			$("#chartT").remove(); // this is my <canvas> element

			$("#chartku2").append('<div id="chartT"></div>');

			Highcharts.chart("chartT", {
				chart: {
					type: "line",
				},
				title: {
					text: "Chart",
				},
				accessibility: {
					announceNewData: {
						enabled: true,
					},
				},
				xAxis: {
					type: "category",
				},
				yAxis: {
					title: {
						text: "Total Order",
					},
				},
				legend: {
					enabled: false,
				},
				plotOptions: {
					series: {
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							formatter: function () {
								return this.y + " Order";
							},
						},
					},
				},

				tooltip: {
					useHTML: true,

					formatter: function () {
						var points = this.point;
						// console.log(this.y);
						return (
							`<span style="color:{series.color}"> <b>` +
							points.name +
							` </b></span><br/>
								<span style="color:{series.color}">Total Order : <b>` +
							points.y +
							`</b></span><br/>`
						);
					},
				},

				series: [
					{
						name: "Tahun",
						colorByPoint: true,
						data: a,
					},
				],
				drilldown: {
					breadcrumbs: {
						position: {
							align: "right",
						},
					},
					series: b,
				},
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			// Ketika ada error
			alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
		},
	});
});
