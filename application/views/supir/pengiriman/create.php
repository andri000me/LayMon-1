  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengiriman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url($home_url)?>">Home</a></li>
              <li class="breadcrumb-item active">Pengiriman</li>
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
              <h3 class="card-title">Map</h3>
              <a href="<?=base_url($home_url.'/pengiriman/created')?>"><button type="button" class="btn btn-sm btn-info btn-flat" style="float:right;">Kembali</button></a>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <div id="map"></div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pengiriman</h3>
            </div>
            <!-- /.card-header -->
            <form class="form-create">
            <?=form_hidden($csrf['name'],$csrf['hash'])?>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputNSurat">No Surat Jalan</label>
                  <input type="text" class="form-control" name="suratjalan" id="inputNSurat" placeholder="Masukan No Surat Jalan Anda ..." maxlength="13" required>
                </div>
                <div class="form-group">
                  <label for="inputMobil">Mobil</label>
                  <select class="form-control select2" name="mobil" id="inputMobil" required>
                    <option selected="selected">-- Pilih --</option>
                    <?php foreach($datasMobil as $vMobil): ?>
                    <option value="<?=$vMobil['id_mobil']?>"><?=$vMobil['merk_mobil']?> (<?=$vMobil['nopol_mobil']?>)</option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputSupir">Supir</label>
                  <select class="form-control select2" name="supir" id="inputSupir" required>
                    <option selected="selected">-- Pilih --</option>
                    <?php foreach($datasSupir as $vSupir): ?>
                    <option value="<?=$vSupir['id_supir']?>"><?=$vSupir['nama_supir']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputPelanggan">Pelanggan</label>
                  <select class="form-control select2" name="pelanggan" id="inputPelanggan" required>
                    <option selected="selected">-- Pilih --</option>
                    <?php foreach($datasPelanggan as $vPelanggan): ?>
                    <option value="<?=$vPelanggan['id_pelanggan']?>"><?=$vPelanggan['nama_pelanggan']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputStart">Kordinat Asal</label>
                  <input type="text" class="form-control" name="startkordinat" id="inputStart" placeholder="Masukan Kordinat Asal ..." required>
                </div>
                <div class="form-group">
                  <label for="inputEnd">Kordinat Tujuan</label>
                  <input type="text" class="form-control" name="endkordinat" id="inputEnd" placeholder="Masukan Kordinat Tujuan ..." required>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->