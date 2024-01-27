<?php


namespace App\Http\Services\Book;


use App\Models\Book;

class BookService
{
    const LIMIT = 16;

    public function get($page = null)
    {
        return Book::select('id', 'name', 'price', 'price_sale')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Book::where('id', $id)
            ->where('active', 1)
            ->with('menu')
            ->firstOrFail();
    }

    public function more($id)
    {
        return Book::select('id', 'name', 'price', 'price_sale')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }
}
