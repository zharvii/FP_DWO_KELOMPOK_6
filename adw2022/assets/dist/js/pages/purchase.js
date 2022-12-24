$(async function () {
	const formatter = new Intl.NumberFormat("en-US", {
		style: "currency",
		currency: "USD",

		// These options are needed to round to whole numbers if that's what you want.
		//minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
		//maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
	});
	

	await $.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "http://localhost/adw2022/Purchase/purEx", // Isi dengan url/path file php yang dituju
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

			$("#chartEx").remove(); // this is my <canvas> element

			$("#chartku").append('<div id="chartEx"></div>');

			Highcharts.chart("chartEx", {
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
						text: "Purchase Expanses",
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
								<span style="color:{series.color}">Expanses : <b>` +
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
		url: "http://localhost/adw2022/Purchase/purAvg", // Isi dengan url/path file php yang dituju
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

			$("#chartAvg").remove(); // this is my <canvas> element

			$("#chartku2").append('<div id="chartAvg"></div>');

			Highcharts.chart("chartAvg", {
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
						text: "Purchase Average",
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
								<span style="color:{series.color}">Expanses : <b>` +
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
});
