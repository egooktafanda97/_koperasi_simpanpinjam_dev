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
    // add nasabah by id sekolah
    async function addNasabahBySekolah(id_sekolah, response) {
        const requestdata = await axios.get('<?= base_url('Nasabah/getBySekolah/') ?>' + id_sekolah).catch((err) => {
            console.log(err.response)
        });
        if (requestdata?.data) {
            response(requestdata?.data);
        }
    };

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
        addNasabahBySekolah(id, (mapData) => {
            $("#id_nasabah")
                .find('option')
                .remove()
                .end()
                .append('<option value="">Pilih Nasabah</option>')
                .val('');

            mapData?.map(function(itr, i) {
                $("#id_nasabah").append(`<option value="${itr?.id_nasabah}">${itr?.nama}</option>`)
            });
        })
    });

    const conversionInteger = (val) => {
        return !isNaN(val) ? parseInt(val) : 0;
    }

    function calculate(jumlah_pinjam, lama_pinjam) {
        let bunga = 1;
        const jumlah_bunga = conversionInteger((1 / 100) * jumlah_pinjam) * conversionInteger(lama_pinjam);
        const admin = conversionInteger((1 / 100) * jumlah_pinjam);
        const total = conversionInteger(jumlah_pinjam + conversionInteger(jumlah_bunga)) + conversionInteger(admin);
        const tagihan = conversionInteger(conversionInteger(total) / conversionInteger(lama_pinjam));

        $("#admin").val(convertToRupiah(admin));
        $("#bunga").val(bunga);
        $("#jumlah_bunga").val(convertToRupiah(jumlah_bunga));
        $("#total").val(convertToRupiah(total));
        $("#jumlah_tagihan_bulanan").val(convertToRupiah(tagihan));
    }
    $("#jumlah_pinjam").keyup(function() {
        $(this).val(formatRupiah($(this).val(), "Rp. "));
        let jml_values = convertToAngka($(this).val());
        const jumlah_pinjam = conversionInteger(jml_values);
        const lama_pinjam = conversionInteger($("#lama_pinjam").val());
        calculate(jumlah_pinjam, lama_pinjam);
    })

    $("#lama_pinjam").change(function() {
        if (isNaN($(this).val()) || $(this).val() == "")
            return;
        let jml_values = convertToAngka($("#jumlah_pinjam").val());
        const jumlah_pinjam = conversionInteger(jml_values);
        const lama_pinjam = conversionInteger($(this).val());
        calculate(jumlah_pinjam, lama_pinjam);
    })


    $("#bulan_pembayaran").change(function() {
        moment.locale("id");
        const control_bulan_mulai = moment($(this).val()).add($("#lama_pinjam").val(), 'months').format("YYYY-MM");
        $("#bulan_pembayaran_selesai").val(control_bulan_mulai)
    });


    $(document).on('click', '.edit', function() {
        const dataid = $(this).data('id');
        async function ajax__getdata(id) {
            const requestdata = await axios.get('<?= base_url('Pinjam/getById/') ?>' + id).catch((err) => {
                console.log(err.response)
            });
            if (requestdata?.status ?? 400 == 200) {
                const data = requestdata.data;
                $("#id_sekolah").val(data.id_sekolah)
                // list data nasabah berdasarkan id sekolah -> function line 77
                addNasabahBySekolah(data.id_sekolah, (mapData) => {
                    $("#id_nasabah")
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Pilih Nasabah</option>')
                        .val('');

                    mapData?.map(function(itr, i) {
                        if (itr.id_nasabah == data?.id_nasabah) {
                            $("#id_nasabah").append(`<option value="${itr?.id_nasabah}" selected="selected">${itr?.nama}</option>`)
                        } else {
                            $("#id_nasabah").append(`<option value="${itr?.id_nasabah}">${itr?.nama}</option>`)
                        }
                    });
                })
                // ------------------------------------------------
                $("#jumlah_pinjam").val(data.jumlah_pinjam);
                $("#lama_pinjam").val(data.lama_pinjam);
                $("#bulan_pembayaran").val(data?.bulan_pembayaran);
                // cek selesai pembayaran -----
                moment.locale("id");
                const control_bulan_mulai = moment(data?.bulan_pembayaran).add(data.lama_pinjam, 'months').format("YYYY-MM");
                $("#bulan_pembayaran_selesai").val(control_bulan_mulai)
                // ----------------------------
                $("#admin").val(convertToRupiah(data?.admin));
                $("#bunga").val(data?.bunga);
                $("#jumlah_bunga").val(convertToRupiah(data?.jumlah_bunga));
                $("#total").val(convertToRupiah(data?.total));
                $("#jumlah_tagihan_bulanan").val(convertToRupiah(data?.jumlah_tagihan_bulanan));
                $("#formmodal").attr('action', '<?= base_url('Pinjam/Updated/') ?>' + id)
            };
        }
        ajax__getdata(dataid)
    })
</script>

<script>
    $('.selectpicker').selectpicker();
    $(".selectpicker").change(function() {
        if ($(this).val() != "") {
            $(".nav-link").removeClass("active");
            $("#form-pembayaran").addClass("active");
            $(".tab-pane").removeClass("active");
            $(".form-pembayaran").addClass("active");

            // getData =============================
            ajax__get("<?= base_url("Pinjam/getById/") ?>" + $(this).val(), (res) => {
                console.log(res);
                $("[name='jumlah_tagihan']").val(convertToRupiah(res?.jumlah_tagihan_bulanan));
                $("[name='sisa_pinjam']").val(convertToRupiah(res?.sisa_pinjam));
                $("[name='id_nasabah']").val(res?.id_nasabah);
            })
            // =====================================
        } else {
            $(".nav-link").removeClass("active");
            $("#form-table-pembayaran").addClass("active");
            $(".tab-pane").removeClass("active");
            $(".form-table-pembayaran").addClass("active");
        }
    });

    $("[name='jumlah_bayar']").keyup(function() {
        $(this).val(formatRupiah($(this).val(), "Rp. "));
        const sisaPinjam = conversionInteger(convertToAngka($("[name='sisa_pinjam']").val()));
        let jml_bayar = conversionInteger(convertToAngka($(this).val()));
        var total = sisaPinjam - jml_bayar;
        $("[name='total_sisa_pinjam'").val(convertToRupiah(total));
    })
</script>