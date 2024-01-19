@extends('book.layout')
@section('content')


    <div class="card">
        <div class="card-header">Book Page</div>
        <div class="card-body">


            <div class="card-body">
                <p class="card-text">ten : {{ $book->ten }}</p>
                <p class="card-text">gia : {{ $book->gia }}</p>
                <p class="card-text">soluong : {{ $book->soluong }}</p>
            </div>

            </hr>

        </div>
    </div>
