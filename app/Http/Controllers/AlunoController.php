<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $alunos = Aluno::all();
        return response()->json($alunos);
    }

    public function show($id)
    {
        $aluno = Aluno::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado.'], 404);
        }

        return response()->json($aluno);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nome' => 'required',
            'turma' => 'required',
            'data_nascimento' => 'required',
            'nomemae' => 'required',
            'nomepai' => 'required',
            'turno' => 'required',
        ]);

        $aluno = Aluno::create($data);

        return response()->json($aluno, 201);
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);
        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }

        $data = $request->validate([
            'nome' => 'required',
            'turma' => 'required',
            'data_nascimento' => 'required',
            'nomemae' => 'required',
            'nomepai' => 'required',
            'turno' => 'required',
        ]);

        $aluno->update($data);
        return response()->json($aluno);
    }

    public function destroy($id)
    {

        $aluno = Aluno::find($id);
        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }

        $aluno->delete();
        return response()->json(['message' => 'Aluno excluído']);
    }
}