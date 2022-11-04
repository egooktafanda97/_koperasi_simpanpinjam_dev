<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<!-- tambahdata -->
<?php if (!empty($this->session->flashdata("success"))) : ?>
    <script>
        swal({
            title: "Berhasil",
            text: "<?= $this->session->flashdata("success") ?>",
            icon: "success",
            button: "ok",

        })
    </script>
<?php endif ?>
<?php if (!empty($this->session->flashdata("error"))) : ?>
    <script>
        swal({
            title: "Opppss",
            text: "<?= $this->session->flashdata("error") ?>",
            icon: "error",
            button: "ok",

        })
    </script>

<?php endif ?>
<!-- Hapuss -->

<script>
    $(document).ready(function() {
        $("#example").DataTable({
            responsive: {
                details: {
                    type: "column",
                    target: "tr",
                },
            },
            columnDefs: [{
                className: "control",
                orderable: false,
                targets: 0,
            }, ],
            paging: false,
            ordering: false,
            info: false,
            "searching": false
        });
    });
</script>
<script>
    function convertToRupiah(number) {
        if (number) {
            var rupiah = "";
            var numberrev = number
                .toString()
                .split("")
                .reverse()
                .join("");
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
        return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    }

    $(document).on("click", ".delete", function() {
        const id = $(this).data("id");
        swal({
                title: "Apa kamu yakin?",
                text: "Data ini akan di hapus!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= base_url('nasabah/deleted/'); ?>" + id
                }
            });
    })
    //  data

    $(document).on("change", "#id_sekolah", function() {
        const id = $(this).val();
        async function getdata(id) {
            const requestdata = await axios.get('<?= base_url('Nasabah/getBySekolah/') ?>' + id).catch((err) => {
                console.log(err.response)
            });
            if (requestdata?.data) {
                $("#id_nasabah")
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Pilih Nasabah</option>')
                    .val('');

                requestdata?.data?.map(function(itr, i) {
                    $("#id_nasabah").append(`<option value="${itr?.id_nasabah}">${itr?.nama}</option>`)
                });
            }
        };
        getdata(id)
    });

    $("#lama_pinjam").change(function() {
        const values = $(this).val();
        const jumlah_pinjam = $("#jumlah_pinjam").val() ?? 0;
        let bunga = 1;
        // if (jumlah_pinjam < 20000000) {
        //     bunga = 1;
        // }
        // else {
        //     bunga = 0.8;
        // }
        const jumlah_bunga = Math.ceil((1 / 100) * jumlah_pinjam) * parseFloat(values).toString();
        const admin = Math.ceil((1 / 100) * jumlah_pinjam).toString();
        const total = Math.ceil(parseFloat(jumlah_pinjam) + parseFloat(jumlah_bunga)) + parseFloat(admin);
        const tagihan = Math.ceil(parseFloat(total) / parseFloat(values));

        $("#admin").val(convertToRupiah(admin));
        $("#bunga").val(bunga);
        $("#jumlah_bunga").val(convertToRupiah(jumlah_bunga));
        $("#total").val(convertToRupiah(total));
        $("#jumlah_tagihan_bulanan").val(convertToRupiah(tagihan));
    })

    $("#bulan_pembayaran").change(function() {
        moment.locale("id");
        const control_bulan_mulai = moment($(this).val()).add($("#lama_pinjam").val(), 'months').format("YYYY-MM");
        $("#bulan_pembayaran_selesai").val(control_bulan_mulai)
    })

    $(document).on('click', '.edit', function() {
        const dataid = $(this).data('id');
        async function getdata(id) {
            const requestdata = await axios.get('<?= base_url('nasabah/getById/') ?>' + id).catch((err) => {
                console.log(err.response)
            });
            if (requestdata?.status ?? 400 == 200) {

                const data = requestdata.data;
                $("#nip").val(data?.nip ?? "");
                $("#nik").val(data?.nik ?? "");
                $("#nama").val(data?.nama ?? "");
                $("#jabatan").val(data?.jabatan ?? "");
                $("#saldo").val(data?.saldo ?? "");
                $("#alamat").val(data?.alamat ?? "");
                $("#tanggal_masuk").val(data?.tanggal_masuk ?? "");
                $("#formmodal").attr('action', '<?= base_url('nasabah/update/') ?>' + id)
            };
        }
        getdata(dataid)
    })
</script>