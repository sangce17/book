<?php


namespace App\Helpers;


use Illuminate\Support\Str;

class Helper
{


    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function menus($menus): string
    {
        $html = '';
        foreach ($menus as $key => $menu) {

            $html .= '
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            ' . $menu->name . '
                        </a>';

            unset($menus[$key]);

            if (self::isChild($menus, $menu->id)) {
                $html .= '<ul class="sub-menu">';
                $html .= self::menus($menus, $menu->id);
                $html .= '</ul>';
            }

            $html .= '</li>';
        }


        return $html;
    }

    public static function isChild($menus, $id): bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }

    public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) return number_format($priceSale);
        if ($price != 0) return number_format($price);
        return '<a href="/lien-he.html">Liên Hệ</a>';
    }
}
