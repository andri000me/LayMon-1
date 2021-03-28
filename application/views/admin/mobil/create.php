  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mobil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url($home_url)?>">Home</a></li>
              <li class="breadcrumb-item active">Master Mobil</li>
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
              <h3 class="card-title">Master Mobil</h3>
              <a href="<?=base_url($home_url.'/mobil')?>"><button type="button" class="btn btn-sm btn-info btn-flat" style="float:right;">Kembali</button></a>
            </div>
            <!-- /.card-header -->
            <form class="form-create">
            <?=form_hidden($csrf['name'],$csrf['hash'])?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputNopol">No Polisi Mobil</label>
                  <input type="text" class="form-control" name="nopol" id="inputNopol" placeholder="Masukan No Polisi Kendaraan Anda ..." maxlength="10" required>
                </div>
                <div class="form-group">
                  <label for="inputMerk">Merk Mobil</label>
                  <input type="text" class="form-control" name="merk" id="inputMerk" placeholder="Masukan Merk Kendaraan Anda ..." maxlength="70" required>
                </div>
                <div class="form-group">
                  <label for="inputKapasitas">Kapasitas</label>
                  <select class="form-control select2" name="kapasitas" id="inputKapasitas" required>
                    <option selected="selected">-- Pilih --</option>
                    <option value="Besar">Besar</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Kecil">Kecil</option>
                  </select>
                </div>
              </div>
            <div class="card-footer">
              <button type="submit" name="submitKond" class="btn btn-primary" value="submitMobil">Submit</button>
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