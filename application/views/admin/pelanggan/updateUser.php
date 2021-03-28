  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url($home_url)?>">Home</a></li>
              <li class="breadcrumb-item active">Master Pelanggan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Master Pelanggan</h3>
              <a href="<?=base_url($home_url.'/pelanggan')?>"><button type="button" class="btn btn-sm btn-info btn-flat" style="float:right;">Kembali</button></a>
            </div>
            <!-- /.card-header -->
            <form class="form-updateuser">
            <?=form_hidden($csrf['name'],$csrf['hash'])?>
            <input type="hidden" class="form-control" name="id" value="<?=$id_pelanggan?>" required>
            <div class="card-body">
              <div class="form-group">
                <label for="inputUser">User</label>
                <select class="form-control select2" name="iduser" id="inputUser" required>
                  <option selected="selected">-- Pilih --</option>
                  <?php foreach($dataAkunTersedia as $vAtersedia): ?>
                  <option value="<?=$vAtersedia['id_user']?>"><?=$vAtersedia['username_user']?></option>
                   <?php endforeach;?>
                 </select>
               </div>
            </div>
            <div class="card-footer">
              <button type="submit" name="submitPelanggan" class="btn btn-primary" value="submitPelanggan">Submit</button>
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->