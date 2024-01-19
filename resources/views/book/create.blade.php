@extends('book.layout')
@section('content')

    <div class="card">
        <div class="card-header">Book Page</div>
        <div class="card-body">

            <form action="{{ url('book') }}" method="post">
                {!! csrf_field() !!}
                <label>ten</label></br>
                <input type="text" name="ten" id="ten" class="form-control"></br>
                <label>gia</label></br>
                <input type="text" name="gia" id="gia" class="form-control"></br>
                <label>soluong</label></br>
                <input type="text" name="soluong" id="soluong" class="form-control"></br>
                <input type="submit" value="Save" class="btn btn-success"></br>
            </form>

        </div>
    </div>

@stop
