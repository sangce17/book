@extends('book.layout')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Admin Book</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('book/create') }}" class="btn btn-success btn-sm" title="Add New Book">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ten</th>
                                    <th>gia</th>
                                    <th>soluong</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($book as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->ten }}</td>
                                        <td>{{ $item->gia }}</td>
                                        <td>{{ $item->soluong }}</td>
                                        <td>
                                            <a href="{{ url('book/' . $item->id) }}" title="View Book"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('book/' . $item->id . '/edit') }}" title="Edit Book"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('book' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete book" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('admin') }}" class="btn btn-danger btn-sm" title="Back To Admin">
                            <i class="fa fa-plus" aria-hidden="true"></i> Back
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
