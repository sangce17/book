@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Danh Mục</th>
            <th>Giá Gốc</th>
            <th>Giá Khuyến Mãi</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($book as $key => $books)
            <tr>
                <td>{{ $books->id }}</td>
                <td>{{ $books->name }}</td>
                <td>{{ $books->menu->name }}</td>
                <td>{{ $books->price }}</td>
                <td>{{ $books->price_sale }}</td>
                <td>{!! \App\Helpers\Helper::active($books->active) !!}</td>
                <td>{{ $books->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/books/edit/{{ $books->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $books->id }}, '/admin/books/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $book->links() !!}
    </div>
@endsection


