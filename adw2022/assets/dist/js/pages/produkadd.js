$(function () {
	$("#bsimpan").click(function () {
		if ($("#nama").val() == "") {
			alert("isi nama produk");
		} else if (
			$("#kategori").val() == "" ||
			$("#kategori").val() == null ||
			$("#kategori").val() == undefined
		) {
			alert("Pilih Kategori");
		} else if ($("#harga").val() == "") {
			alert("isi harga");
		} else if ($("#f1")[0].files.length === 0) {
			alert("upload foto produk");
		} else {
			$("#frmProduk").Submit();
		}
	});
});
