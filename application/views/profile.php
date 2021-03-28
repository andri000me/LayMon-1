  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url($home_url)?>">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
              <h3 class="card-title">Ganti Password</h3>
              <a href="<?=base_url($home_url)?>"><button type="button" class="btn btn-sm btn-info btn-flat" style="float:right;">Kembali</button></a>
            </div>
            <!-- /.card-header -->
            <form class="form-profile">
            <?=form_hidden($csrf['name'],$csrf['hash'])?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Masukan Password Anda ..." minlength="8" required>
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