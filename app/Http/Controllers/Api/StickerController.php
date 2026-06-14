<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sticker;
use Illuminate\Http\Request;


class StickerController extends Controller
{
    public function bySection($section)
    {
        return response()->json(
            Sticker::where('section', $section)->get()
        );
    }

public function toggle($id)
{
    $sticker = Sticker::findOrFail($id);

    $sticker->is_owned = !$sticker->is_owned;

    $sticker->save();

    return response()->json([
        'success' => true,
        'sticker' => $sticker
    ]);
}

    public function search(Request $request)
{
    $query = $request->query('q');

    if (!$query) {
        return response()->json([]);
    }

    $stickers = Sticker::with('country')
        ->where('name', 'LIKE', "%{$query}%")
        ->orWhere('number', 'LIKE', "%{$query}%")
        ->orWhere('section', 'LIKE', "%{$query}%")
        ->limit(50)
        ->get();

    return response()->json($stickers);
}
}