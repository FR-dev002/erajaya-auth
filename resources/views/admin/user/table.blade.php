<div class="card">
    <div class="card-header">
        <h5 class="card-title">Data User</h5>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body talbe-responsive">
        <table id="example1" class="table  table-sm table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>EMail</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@push('fileCSSCustom')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

@endpush

@push('fileJsCustome')
<!-- Data Table -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}">
</script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">
</script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">
</script>

<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $(function() {
            $("#example1").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('get_all_user') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data": {
                        _token: "{{csrf_token()}}"
                    }
                },
                "columns": [{
                        "data": "id",
                        "width": "2%"
                    },
                    {
                        "data": "name",
                        "width": "40%"
                    },
                    {
                        "data": "email",
                        "width": "10%"
                    },
                    {
                        "data": "role",
                        "width": "10%"
                    },
                    {
                        "data": "actions",
                        "width": "18%"
                    },
                ],
                "drawCallback": function(setting) {
                    $('.btn-danger').on('click', function() {
                        let id = $(this).attr('code');
                        Swal.fire({
                            title: 'Yakin akan menghapus data ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ok',
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: "{{ route('delete_user') }}",
                                    "data": {
                                        _token: "{{csrf_token()}}",
                                        id: id
                                    },
                                    success: function(data) {
                                        if (data.status == 'success') {
                                            Swal.fire({
                                                title: 'Data berhasil dihapus',
                                            })
                                            $('#example1').DataTable().ajax.reload();
                                        }
                                    }
                                })
                            }
                        })
                    })
                    $('.btn-info').on('click', function() {
                        let id = $(this).attr('code');
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('admin/user') }}" + "/" + id,
                            success: function(data) {
                                if (data.status == 'success') {
                                    const obj = data.data;
                                    const role = obj.roles[0];
                                    $('#form_name').prop('value', obj.name)
                                    $('#form_email').prop('value', obj.email)
                                    $('#form_id').prop('value', obj.id)

                                    $("#form_role").val(role.id);
                                }
                            }
                        })
                    })
                }
            });
        });
    })
</script>
@endpush