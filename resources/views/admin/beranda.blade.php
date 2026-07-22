<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-soft-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">people_alt</i>
            </div>
            <p class="card-category">Pengunjung</p>
            <h3 class="card-title">1,000
              <!-- <small>GB</small> -->
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Last 1 Month
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-soft-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">person_add</i>
            </div>
            <p class="card-category">Pemohon</p>
            <h3 class="card-title">1,000</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Last 1 Month
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-soft-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">gavel</i>
            </div>
            <p class="card-category">Regulasi</p>
            <h3 class="card-title">{{ number_format($jmlRegulasi,0,'.',',') }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-soft-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">contactless</i>
            </div>
            <p class="card-category">Informasi</p>
            <h3 class="card-title">{{ number_format($jmlInformasi,0,'.',',') }}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i> Just Updated
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-custom-title">
            <h4 class="card-title">Status Pemohon Informasi</h4>
            <p class="card-category">Pemohon baru pada {{ date('d F, Y') }}</p>
          </div>
          <div class="card-body table-responsive">
            <div class="material-datatables">
              <table id="datatables" class="table table-modern" cellspacing="0" width="100%" style="width:100%">
                <thead class="text-info">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Salary</th>
                  <th>Country</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>CuraÃ§ao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




