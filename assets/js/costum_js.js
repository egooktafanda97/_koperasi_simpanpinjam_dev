$(".login-btn").click(function () {
	$(this).addClalss("loading");
	setTimeout(() => $(this).removeClass("loading"), 3000);
});

function convertToRupiah(number) {
	if (number) {
		var rupiah = "";
		var numberrev = number.toString().split("").reverse().join("");
		for (var i = 0; i < numberrev.length; i++)
			if (i % 3 == 0) rupiah += numberrev.substr(i, 3) + ".";
		return (
			"Rp. " +
			rupiah
				.split("", rupiah.length - 1)
				.reverse()
				.join("")
		);
	} else {
		return number;
	}
}

function convertToAngka(rupiah) {
	return parseInt(rupiah.replace(/,.*|[^0-9]/g, ""), 10);
}
/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

$(".decimal").keyup(function () {
	var val = $(this).val();
	if (isNaN(val)) {
		val = val.replace(/[^0-9\.]/g, "");
		if (val.split(".").length > 2) val = val.replace(/\.+$/, "");
	}
	$(this).val(val);
});

async function ajax__get(urlGet, response) {
	const requestdata = await axios.get(urlGet).catch((err) => {
		console.log(err.response);
	});
	if (requestdata?.data) {
		response(requestdata?.data);
	}
}
