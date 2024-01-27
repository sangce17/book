<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequest;
use App\Http\Services\Book\BookAdminService;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookAdminService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return view('admin.books.list', [
            'title' => 'Danh Sách Sản Phẩm',
            'book' => $this->bookService->get()
        ]);
    }

    public function create()
    {
        return view('admin.books.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $this->bookService->getMenu()
        ]);
    }


    public function store(BookRequest $request)
    {
        $this->bookService->insert($request);

        return redirect()->back();
    }

    public function show(Book $book)
    {
        return view('admin.books.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm',
            'books' => $book,
            'menus' => $this->bookService->getMenu()
        ]);
    }


    public function update(Request $request, Book $book)
    {
        $result = $this->bookService->update($request, $book);
        if ($result) {
            return redirect('/admin/books/list');
        }

        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $result = $this->bookService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
