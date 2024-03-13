<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\CursoRepository;
use App\Models\User;

class UserController extends Controller {
    
    protected $repository;

    public function __construct(){
        $this->repository = new UserRepository();
    }

    public function index() {
        $data = $this->repository->selectAllWith(['role', 'curso']);
        return $data;
    }

    public function create() {
        // retorna, para o usuário, a view de criação do Usuário
    }

    public function store(Request $request) {
        
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objRole = (new RoleRepository())->findById($request->role_id);
        
        if(isset($objCurso) && isset($objRole)) {
            $obj = new User();
            $obj->name = mb_strtoupper($request->nome, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password); 
            $obj->curso()->associate($objCurso);
            $obj->role()->associate($objRole);
            $this->repository->save($obj);
            return redirect()->route('users.role', $objRole->nome);
        }
        
        return view('message')
                    ->with('template', "main")
                    ->with('type', "danger")
                    ->with('titulo', "OPERAÇÃO INVÁLIDA")
                    ->with('message', "Não foi possível efetuar o procedimento!")
                    ->with('link', "home");
    }

    public function show(string $id){

        $data = $this->repository->findByIdWith(['curso'], $id);

        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll();
            $roles = (new RoleRepository())->selectAll();
            $nome = (new RoleRepository())->findById($data->role_id)->nome;
            return view('user.show', compact(['data', 'cursos', 'roles', 'nome']));
        } 
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "curso.index");
    }

    public function edit(string $id) {
        
        $data = $this->repository->findByIdWith(['curso'], $id);

        if(isset($data)) {
            $cursos = (new CursoRepository())->selectAll();
            $roles = (new RoleRepository())->selectAll();
            $nome = (new RoleRepository())->findById($data->role_id)->nome;
            $role_id = $data->role_id;
            return view('user.edit', compact(['data', 'cursos', 'roles', 'nome', 'role_id']));
        } 

        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "curso.index");   
    }

    public function update(Request $request, string $id) {

        $nome = (new RoleRepository())->findById($this->repository->findById($id)->role_id)->nome;
        $obj = $this->repository->findById($id);
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objRole = (new RoleRepository())->findById($request->role_id);
        
        if(isset($obj) && isset($objCurso) && isset($objRole)) {
            $obj->name = mb_strtoupper($request->nome, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password); 
            $obj->curso()->associate($objCurso);
            $obj->role()->associate($objRole);
            $this->repository->save($obj);
            return redirect()->route('users.role', $nome);
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "curso.index");
    }

    public function destroy(string $id) {

        $nome = (new RoleRepository())->findById($this->repository->findById($id)->role_id)->nome;
        if($this->repository->delete($id))  {
            return redirect()->route('users.role', $nome);
        }
        
        return view('message')
            ->with('template', "main")
            ->with('type', "danger")
            ->with('titulo', "OPERAÇÃO INVÁLIDA")
            ->with('message', "Não foi possível efetuar o procedimento!")
            ->with('link', "home");
    }

    /* 
        NEW METHODS - GIL EDUARDO
    */

    public function getUsersByRole($role) {

        $role = mb_strtoupper($role, 'UTF-8');
        $objRole = (new RoleRepository())->findFirstByColumn("nome", $role);
        $data = $this->repository->findByColumn('role_id', $objRole->id);
        $route = "users.role.create";
        $id = $objRole->id;
        // return $data;
        return view('user.index', compact('data', 'role', 'route', 'id'));
    }

    public function createUsersByRole($role_id) {

        $cursos = (new CursoRepository())->selectAll();
        $nome = (new RoleRepository())->findById($role_id)->nome;
        $roles = (new RoleRepository())->selectAll();
        return view('user.create', compact(['cursos', 'roles', 'role_id', 'nome']));
    }
}
