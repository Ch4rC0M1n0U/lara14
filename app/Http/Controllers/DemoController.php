<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function voir($id): string
    {
        // Pour l’instant pas de vue, nous verrons ça plus tard.
        return $todos = Cell::where('CellType','=', 'Normale')->orderBy('id', 'asc')->take(5)->get();
        
    }

}
