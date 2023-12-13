<?php

namespace App\Models;


class comment
{
    private static $blog_comments=[
        [
            "judul" => "Komentar Pertama",
            "tanggal" => "06/09/2023",
            "slug" => "judul-tulisan-pertama",
            "body" => "ini adalah komentar"
    ],[
            "judul" => "Komentar Kedua",
            "tanggal" => "09/10/2023",
            "slug" => "judul-tulisan-kedua",
            "body" => "ini adalah komentar 2"
    ]];

    public static function all()
    {
        return collect(self::$blog_comments);
    }

    public static function find($slug)
    {
        $comment = static::all();
        return $comment->firstWhere('slug',$slug);
    }
}

