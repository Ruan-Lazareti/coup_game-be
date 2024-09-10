<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Card;
use App\Models\Perk;

class CardController extends Controller
{
    public function index()
    {
        return Card::all();
    }

    public function show($id)
    {
			$card = Card::find($id);
	    $perks = Card::find($id)->perks()->get();
        return [$perks, $card];
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'perks' => 'required|array',
            'image' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        } else {
            $validatedData['image'] = 'f';
        }

        $card = Card::create($validatedData);
        $card->perks()->attach($request->perks);

        return response()->json($card, 201);
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);
        $card->update($request->all());
        return response()->json($card, 200);
    }

    public function destroy($id)
    {
				$path = card::find($id)->image;
				$del = Storage::disk('public')->delete($path);
        Card::destroy($id);
        return response()->json('Carta deletada com sucesso!', 201);
    }

}
