<?php


namespace App\Http\Services\Book;


use App\Models\Book;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class BookAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            Book::create($request->all());

            Session::flash('success', 'Thêm Sản phẩm thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Sản phẩm lỗi');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function get()
    {
        return Book::with('menu')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $book)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice == false) return false;

        try {
            $book->fill($request->input());
            $book->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $book = Book::where('id', $request->input('id'))->first();
        if ($book) {
            $book->delete();
            return true;
        }

        return false;
    }
}
