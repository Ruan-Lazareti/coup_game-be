<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perk;

class PerkController extends Controller
{
    public function index() {
        return Perk::all();
    }
}
