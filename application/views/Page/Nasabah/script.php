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