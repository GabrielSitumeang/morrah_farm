@extends('layouts.app_LTE')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Halaman Blog Manager</h1>
    </div><!-- /.container-fluid -->

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <a href="{{ route('blog.create') }}">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-user-plus"></i>Tambah
                    Blog</button></a>
            <div class="mt-3"></div>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $blog->judul }}</b></h2>
                                        <p>{{ $blog->isi }}</p>
                                        <p class="text-muted text-sm">{{ $blog->created_at }} <br> {{ $blog->user->name }}
                                        </p>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ url('blogFotos') }}/{{ $blog->gambar }}" alt="Blog-img"
                                            class="img img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    {!! Form::open([
                                        'route' => ['blog.delete', $blog->id],
                                        'method' => 'DELETE',
                                        'id' => 'deleteblog',
                                    ]) !!}
                                    <a href="{{ route('blog.edit', $blog->id) }}"
                                        class="btn btn-success btn-sm text-center"><i class="fas fa-edit"></i></a>

                                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm text-center btndelete', 'id' => 'delete']) }}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on('submit', '#deleteblog', function(e) {
                e.preventDefault();
                var form = $(this);
                var link = form.attr("action");

                Swal.fire({
                    title: 'Yakin Menghapus Blog?',
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
