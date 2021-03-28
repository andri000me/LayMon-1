  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?=date("Y").' '.$this->config->item('laymon_judul')?>. Developed by <a href="mailto:hexageek1337@gmail.com">Denny Septian Panggabean</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <?=$this->config->item('laymon_version')?>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- Select2 -->
<script src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- InputMask -->
<script src="<?=base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js')?>"></script>
<!-- date-range-picker -->
<script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- bootstrap color picker -->
<script src="<?=base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- DataTables -->
<script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<!-- AdminLTE -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- Summernote -->
<script src="<?=base_url('assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- Sweetalert2 -->
<script src="<?=base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js')?>"></script>
<!-- Custom -->
<script src="<?=base_url('assets/dist/js/custom.js')?>"></script>
<?php
if (isset($master) AND $master === 'mobil') {
  $read = base_url('apilm/mobil/baca');
  $add = base_url('apilm/mobil/simpan');
  $edit = base_url('apilm/mobil/ubah');
  $editUser = ''; ?>
<script type="text/javascript">
  let readUrl = '<?=$read?>',
  addUrl = '<?=$add?>',
  editUrl = '<?=$edit?>',
  edituserUrl = '<?=$editUser?>';
</script>
<script src="<?=base_url('assets/dist/js/master/'.$master.'.js')?>"></script>
<?php } elseif (isset($master) AND $master === 'user') {
  $read = base_url('apilm/user/baca');
  $add = base_url('apilm/user/simpan');
  $edit = base_url('apilm/user/ubah');
  $editUser = ''; ?>
<script type="text/javascript">
  let readUrl = '<?=$read?>',
  addUrl = '<?=$add?>',
  editUrl = '<?=$edit?>',
  edituserUrl = '<?=$editUser?>';
</script>
<script src="<?=base_url('assets/dist/js/master/'.$master.'.js')?>"></script>
<?php } elseif (isset($master) AND $master === 'pelanggan') {
  $read = base_url('apilm/pelanggan/baca');
  $add = base_url('apilm/pelanggan/simpan');
  $edit = base_url('apilm/pelanggan/ubah');
  $editUser = base_url('apilm/pelanggan/ubahuser'); ?>
<script type="text/javascript">
  let readUrl = '<?=$read?>',
  addUrl = '<?=$add?>',
  editUrl = '<?=$edit?>',
  edituserUrl = '<?=$editUser?>';
</script>
<script src="<?=base_url('assets/dist/js/master/'.$master.'.js')?>"></script>
<?php } elseif (isset($master) AND $master === 'supir') {
  $read = base_url('apilm/supir/baca');
  $add = base_url('apilm/supir/simpan');
  $edit = base_url('apilm/supir/ubah');
  $editUser = base_url('apilm/supir/ubahuser'); ?>
<script type="text/javascript">
  let readUrl = '<?=$read?>',
  addUrl = '<?=$add?>',
  editUrl = '<?=$edit?>',
  edituserUrl = '<?=$editUser?>';
</script>
<script src="<?=base_url('assets/dist/js/master/'.$master.'.js')?>"></script>
<?php }

if (isset($master) AND $master === 'profile') { ?>
<script type="text/javascript">
let profileUrl = '<?=base_url('apilm/profile')?>';

$(document).ready(function () {
    $(".form-profile").submit(function (event) {
        $.ajax({
            url: profileUrl,
            type: "post",
            dataType: "json",
            data: $(".form-profile").serialize(),
            success: (dataProfile) => {
                if (dataProfile.error === true) {
                    let errorList='';

                    Object.keys(dataProfile.errorMsg).forEach(function(key) {
                        errorList += '<p>'+dataProfile.errorMsg[key]+'<p>';
                    });

                    Swal.fire("Gagal", dataProfile.message+'<hr class="hr">'+errorList, "error").then(function() {
                        window.location.href = dataProfile.redirect;
                    });;
                } else {
                    Swal.fire("Sukses", dataProfile.message, "success").then(function() {
                        window.location.href = dataProfile.redirect;
                    });;
                }
            },
            error: err => {
                console.log(err)
            }
        });

        event.preventDefault();
    });
});
</script>
<?php } ?>
</body>
</html>