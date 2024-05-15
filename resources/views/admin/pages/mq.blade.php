@extends('layouts.template')

@section('csstambahan')
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection


@section('konten')
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Data MQ-2</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>gas</th>
                    <th>Tanggal Masuk Data</th>
                    <th>Tanggal Update data</th>
                    <th>aksi</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($gases as $d)
                    <tr>
                      <td>{{ $d['gas'] }}</td>
                      <td>{{ $d['created_at'] }}</td>
                      <td>{{ $d['updated_at'] }}</td>

                      <td>
                      <!-- <a href="/siswa/editsiswa/{{$d['id']}}"><button type="button" class="btn btn-outline-primary">Edit</button></a>  -->
                      <form action="dht22/hapus/{{ $d['id'] }}" method="post" onsubmit="return confirmDelete()">
                           @csrf
                           <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </form>
                      </td>
                    </tr>
                      
                    @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>gas</th>
                    <th>Tanggal Masuk Data</th>
                    <th>Tanggal Update data</th>
                    <th>aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
@endsection


@section('jstambahan')
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this data?');
    }
</script>
@endsection