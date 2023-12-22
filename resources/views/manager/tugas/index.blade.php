@extends('layouts.app_LTE')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Halaman Tugas Karyawan</h1>
    </div><!-- /.container-fluid -->

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <a href="{{ route('tugas.create') }}">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-user-plus"></i>Tambah Tugas Karyawan</button></a>
            <div class="mt-3"></div>
            <div class="row">
                
                <!-- /.card-header -->
                <div class="card-body" style="display: flex;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tugas</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($tugass as $tugas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tugas->nama_tugas }}</td>
                                    <td>{{ $tugas->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('tugas.show', $tugas->id) }}" class="btn btn-info"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ route('tugas.edit', $tugas->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('tugas.destroy', $tugas->id) }}" method="POST"
                                            class="d-inline delete-about-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-about"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>

                    </table>

                    <table class="table table-hover" style="width: fit-content;">
                        <thead>
                            <tr class="text-center">
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($tasks as $task)
                                <tr>
                                    
                                    <td style="color: green;">{{ $task->status}}</td>
                                    
                                </tr>

                                @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on('submit', '#deletetugas', function(e) {
                e.preventDefault();
                var form = $(this);
                var link = form.attr("action");

                Swal.fire({
                    title: 'Yakin Menghapus Tugas?',
                    text: "Jika anda menghapus maka data tidak akan bisa kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: link,
                            type: 'POST',
                            data: {
                                '_method': 'DELETE',
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(() => {
                                    // Reload or redirect to another page
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the file.',
                                    'error'
                                );
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
