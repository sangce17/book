<?php


namespace App\Http\Controllers;


use App\Http\Services\Book\BookService;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;

class MainController
{
    protected $menu;
    protected $book;

    public function __construct(MenuService $menu,
                                BookService $book)
    {
        $this->menu = $menu;
        $this->book = $book;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Shop Nước Hoa ABC',
            'menus' => $this->menu->show(),
            'books' => $this->book->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->book->get($page);
        if (count($result) != 0) {
            $html = view('books.list', ['books' => $result])->render();

            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => '']);
    }
}
