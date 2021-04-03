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
              <h3 class="card-title">Pengiriman</h3>
              <a href="<?=base_url($home_url.'/pengiriman/add')?>"><button type="button" class="btn btn-sm btn-info btn-flat" style="float:right;">Add</button></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              <table loading="lazy" id="pengiriman-data" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Surat Jalan</th>
                  <th>Mobil</th>
                  <th>Supir</th>
                  <th>Pelanggan</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th width="160">Aksi</th>
                </tr>
                </thead>
              </table>
              </div>
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
              <h3 class="card-title">Maps</h3>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->