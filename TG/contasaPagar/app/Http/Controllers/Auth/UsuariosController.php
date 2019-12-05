<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('tipo_usuario', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(7);

        return view('usuarios.index', compact('usuarios'));
    }

    public function edit($id)
    {
        $usuario = User::FindOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        if(($request->password == null || $request->password == '') || ($request->confirm_password == null || $request->confirm_password == '')){
            return redirect()->route('usuarios.edit', ['id'=>$id])
                ->with('error', 'Informe as senhas.');
        } else if($request->password != $request->confirm_password) {
            return redirect()->route('usuarios.edit', ['id'=>$id])
                ->with('error', 'Senhas informadas não são iguais.');
        } else if(strlen($request->password) < 8) {
            return redirect()->route('usuarios.edit', ['id'=>$id])
                ->with('error', 'A senha deve possuir mais de 8 caracteres.');
        }

        $usuario = User::FindOrFail($id);
        $usuario->name = $request->name;
        $usuario->tipo_usuario = $request->tipo_usuario;
        $usuario->matricula = $request->matricula;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->updated_at = Carbon::now();
        $usuario->update();

        return redirect()->route('usuarios.edit', ['id'=>$id])
            ->with('message', 'Usuário alterado com sucesso.');
    }

    public function destroy($id)
    {
        $usuario = User::FindOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('message', 'Usuário excluido com sucesso.');
    }
}
