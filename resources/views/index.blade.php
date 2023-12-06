<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onclick="add()" href="javascript:void(0)">Create</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>

        @endif
        <div class="card-body">
            <table class="table table-bordered" id="crud">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>


  <!-- Modal -->
  <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="create">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0)" id="form" name="form" class="form-horizontal" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="Nama" name="Nama" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="NIK" class="form-label">NIK</label>
                  <input type="number" class="form-control" id="Nik" name="Nik">
                </div>
                <div class="mb-3">
                    <label for="Jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" aria-label="Default select example" id="Jabatan" name="Jabatan">
                        <option selected>Pilih Jabatan</option>
                        <option value="Staff">Staff</option>
                        <option value="Manager">Manager</option>
                        <option value="Direktu">Direktur</option>
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email">
                  </div>
                  <div class="mb-3">
                    <label for="Alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="Alamat" name="Alamat">
                  </div>


                <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
    </div>
    <script type="text/javascript">
    $(document).ready( function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#crud').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ url('crud') }}",
            columns:[
                {data: 'Nama', name: 'Nama'},
                {data: 'NIK', name: 'NIK'},
                {data: 'Jabatan', name: 'Jabatan'},
                {data: 'Email', name: 'Email'},
                {data: 'Alamat', name: 'Alamat'},
                {data: 'action', name: 'action', orderable: false},
            ],
            order:[[0, 'desc']]
        });
    });
    function add(){
        $('#form').trigger("reset");
        // $('#create').htm("Add");
        $('#create').modal('show');
        $('#id').val('');
    }
    $('#form').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                     $("#create").modal('hide');

                },
                error: function (data) {
                    console.error(data);
                }
            });
        });
    </script>


</body>
</html>
