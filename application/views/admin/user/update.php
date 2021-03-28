  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url($home_url)?>">Home</a></li>
              <li class="breadcrumb-item active">Master User</li>
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
              <h3 class="card-title">Master User</h3>
              <a href="<?=base_url($home_url.'/user')?>"><button type="button" class="btn btn-sm btn-info btn-flat" style="float:right;">Kembali</button></a>
            </div>
            <!-- /.card-header -->
            <form class="form-update">
            <?=form_hidden($csrf['name'],$csrf['hash'])?>
              <div class="card-body">
                <input type="hidden" class="form-control" name="id" value="<?=$id_user?>" required>
                <div class="form-group">
                  <label for="inputLevel">Level</label>
                  <select class="form-control select2" name="level" id="inputLevel" required>
                    <option>-- Pilih --</option>
                    <option value="Admin" <?php if($dataUser['level_user'] === 'Admin'){ echo 'selected'; } ?>>Admin</option>
                    <option value="Supir" <?php if($dataUser['level_user'] === 'Supir'){ echo 'selected'; } ?>>Supir</option>
                    <option value="Pelanggan" <?php if($dataUser['level_user'] === 'Pelanggan'){ echo 'selected'; } ?>>Pelanggan</option>
                  </select>
                </div>
              </div>
            <div class="card-footer">
              <button type="submit" name="submitUser" class="btn btn-primary" value="submitUser">Submit</button>
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