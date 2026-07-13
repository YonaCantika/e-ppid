<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <a href="{{ url('/') }}/regulasi/tambah" class="btn btn-primary" style="margin-left: 15px;">Tambah</a>
        <div class="card">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">gavel</i>
            </div>
            <h4 class="card-title">Regulasi</h4>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Aturan</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">File</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Tanggal</th>
                    <th class="disabled-sorting text-center">Actions</th>
                  </tr>
                </thead>
                <!-- <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </tfoot> -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "autoWidth": true,
        "processing": true,
        "ajax": {
          "url": "{{ url('regulasi/tabelData') }}",
          "type": "POST"
        },
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatables').DataTable();

      // Edit record
      // table.on('click', '.edit', function() {
      //   $tr = $(this).closest('tr');
      //   var data = table.row($tr).data();
      //   alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      // });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      // table.on('click', '.like', function() {
      //   alert('You clicked on Like button');
      // });
    });
  </script>





