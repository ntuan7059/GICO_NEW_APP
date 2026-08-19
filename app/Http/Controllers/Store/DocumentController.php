<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        // Sample documents data - in real app, this would come from database
        $documents = [
            (object)[
                'id' => 1,
                'date' => '09/07/2024',
                'name' => 'VECNI TẨM CÁCH ĐIỆN 2376RTU GOLDEN',
                'download_url' => '#',
            ],
            (object)[
                'id' => 2,
                'date' => '10/07/2024',
                'name' => 'DÂY ĐIỆN TỬ CÁCH ĐIỆN',
                'download_url' => '#',
            ],
            (object)[
                'id' => 3,
                'date' => '11/07/2024',
                'name' => 'VẬT LIỆU CÁCH ĐIỆN',
                'download_url' => '#',
            ],
        ];

        return view('themes.xylo.document', compact('documents'));
    }
}
