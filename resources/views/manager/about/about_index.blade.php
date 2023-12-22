@include('sweetalert::alert')
@extends('layouts.app_LTE')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('about.create') }}" class="btn btn-primary">Tambah Tentang</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abouts as $about)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $about->judul }}</td>
                                    <td>{{ $about->isi }}</td>
                                    <td>
                                        <img src="{{ Storage::url($about->gambar) }}" alt="Gambar"
                                            style="max-width: 100px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('about.show', $about->id) }}" class="btn btn-info"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ route('about.edit', $about->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('about.destroy', $about->id) }}" method="POST"
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.delete-about', function(e) {
                e.preventDefault();
                var form = $(this).closest('.delete-about-form');
                var link = form.attr("action");

                Swal.fire({
                    title: 'Yakin Ingin menghapus?',
                    text: "Jika anda menghapus maka data tidak akan bisa kembali",
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
                });
            });
        });
    </script>
@endsection
