<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Card;

class CardController extends Controller
{
    public function index()
    {
        return Card::all();
    }

    public function show($id)
    {
        return Card::findOrFail($id);
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
            $validatedData['image'] = $path; // Salva o caminho da imagem no banco de dados
        } else {
            $validatedData['image'] = 'f'; // Certifique-se de que 'image' pode ser nulo
        }

        $card = Card::create($validatedData);
        $card->perks()->sync($request->perks);

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
        Card::destroy($id);
        return response()->json(null, 204);
    }
}
