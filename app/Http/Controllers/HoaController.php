<?php

namespace App\Http\Controllers;

use App\Models\Hoa;
use Illuminate\Http\Request;

class HoaController extends Controller
{
    public function getList(Request $request)
    {
        $query = Hoa::with([
            'chi.ho.bo',   // Eager load Chi, Ho, và Bo liên quan
            'beMat',
            'phan',
            'khauDo',
            'model'
        ])
            ->orderBy('id', 'desc');

        $datas = $query->paginate(10);

        return view('pages.index', compact('datas'));
    }
}