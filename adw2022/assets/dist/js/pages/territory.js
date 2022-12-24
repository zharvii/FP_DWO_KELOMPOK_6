$(async function () {
	$("#example1").DataTable();

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

	$("#gen").click(function () {
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "http://localhost/adw2022/Territory/salesTerritory", // Isi dengan url/path file php yang dituju
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
				var a = [];
				var b = [];

				var indiLabel = [];
				var indiValue = [];

				response.forEach((element) => {
					var c = {};
					c.name = element.group.replace(/\s/g, "");
					c.y = element.total;
					c.drilldown = element.group.replace(/\s/g, "");
					a.push(c);

					var d = {};
					d.name = element.group.replace(/\s/g, "");
					d.id = element.group.replace(/\s/g, "");
					d.data = element.drill;
					b.push(d);
				});

				$("#chartTer").remove(); // this is my <canvas> element

				$("#chartku").append('<div id="chartTer"></div>');

				Highcharts.chart("chartTer", {
					chart: {
						type: "pie",
					},
					title: {
						text: "Territory Sales Chart",
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
						headerFormat:
							'<span style="font-size:11px">{series.name}</span><br>',
						pointFormat:
							'<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
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
	});

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Territory/salesTerritory", // Isi dengan url/path file php yang dituju
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
			var a = [];
			var b = [];

			var indiLabel = [];
			var indiValue = [];

			response.forEach((element) => {
				var c = {};
				c.name = element.group.replace(/\s/g, "");
				c.y = element.total;
				c.drilldown = element.group.replace(/\s/g, "");
				a.push(c);

				var d = {};
				d.name = element.group.replace(/\s/g, "");
				d.id = element.group.replace(/\s/g, "");
				d.data = element.drill;
				b.push(d);
			});

			$("#chartTer").remove(); // this is my <canvas> element

			$("#chartku").append('<div id="chartTer"></div>');

			Highcharts.chart("chartTer", {
				chart: {
					type: "pie",
				},
				title: {
					text: "Territory Sales Chart",
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
					headerFormat: '<span style="font-size:11px">Total Penjualan Berdasarkan Territory</span><br>',
					pointFormat:
						'<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
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
});
