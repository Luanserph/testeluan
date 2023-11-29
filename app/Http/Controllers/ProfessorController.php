<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $professores = Professor::all();
        return response()->json($professores);
    }

    public function show($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado.'], 404);
        }

        return response()->json($professor);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nome' => 'required',
            'turma' => 'required',
            'data_nascimento' => 'required',
            'nomeescola' => 'required',
            'turno' => 'required',
        ]);

        $professor = Professor::create($data);

        return response()->json($professor, 201);
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);
        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado'], 404);
        }

        $data = $request->validate([
            'nome' => 'required',
            'turma' => 'required',
            'data_nascimento' => 'required',
            'nomeescola' => 'required',
            'turno' => 'required',
        ]);

        $professor->update($data);
        return response()->json($professor);
    }

    public function destroy($id)
    {

        $professor = Professor::find($id);
        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado'], 404);
        }

        $professor->delete();
        return response()->json(['message' => 'Professor excluído']);
    }
}