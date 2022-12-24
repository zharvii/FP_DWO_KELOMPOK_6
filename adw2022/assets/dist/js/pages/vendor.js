$(async function () {
	function getMinMaxWithMath(arr) {
		// Math.max(10,3,8,1,33)
		let maximum = Math.max(...arr);
		// Math.min(10,3,8,1,33)
		return maximum;
	}

	// Create our number formatter.
	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",

		// These options are needed to round to whole numbers if that's what you want.
		//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
		//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
	});
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
			url: "http://localhost/adw2022/Vendors/vendorChart", // Isi dengan url/path file php yang dituju
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

				$("#chartVen").remove(); // this is my <canvas> element
				$("#chartku").append('<div id="chartVen"></div>');

				response.vendor.forEach((t) => {
					indiLabel.push(t.VendorName);
					indiValue.push(parseInt(t.expanses));
				});

				Highcharts.chart("chartVen", {
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
							text: "Total Expanses",
						},
					},
					tooltip: {
						shared: true,

						useHTML: true,

						formatter: function () {
							var points = this.points;
							// console.log(points);
							return (
								`<span style="color:{series.color}"> <b>` +
								points[0].x +
								` </b></span><br/>
								<span style="color:{series.color}">Purcahse Expanses : <b>` +
								formatter.format(points[0].y) +
								`</b></span><br/>`
							);
						},
					},
					plotOptions: {
						column: {
							pointPadding: 0.3,
							borderWidth: 0,
						},
					},
					series: [
						{
							name: "Total Expanses",
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
		url: "http://localhost/adw2022/Vendors/vendorChart", // Isi dengan url/path file php yang dituju
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

			$("#chartVen").remove(); // this is my <canvas> element
			$("#chartku").append('<div id="chartVen"></div>');

			response.vendor.forEach((t) => {
				indiLabel.push(t.VendorName);
				indiValue.push(parseInt(t.expanses));
			});

			Highcharts.chart("chartVen", {
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
						text: "Total Expanses",
					},
				},
				tooltip: {
					shared: true,

					useHTML: true,

					formatter: function () {
						var points = this.points;
						// console.log(points);
						return (
							`<span style="color:{series.color}"> <b>` +
							points[0].x +
							` </b></span><br/>
								<span style="color:{series.color}">Purcahse Expanses : <b>` +
							formatter.format(points[0].y) +
							`</b></span><br/>`
						);
					},
				},
				plotOptions: {
					column: {
						pointPadding: 0.3,
						borderWidth: 0,
					},
				},
				series: [
					{
						name: "Total Expanses",
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
