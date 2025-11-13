<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index(){ $users = User::with('role')->paginate(20); return view('users.index', compact('users')); }
    public function create(){ $roles = Role::all(); return view('users.create', compact('roles')); }
    public function store(StoreUserRequest $r){
        $data = $r->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('users.index')->with('success','User dibuat.');
    }
    public function edit(User $user){ $roles = Role::all(); return view('users.edit', compact('user','roles')); }
    public function update(Request $r, User $user){
        $data = $r->validate(['name'=>'required','email'=>'required|email','role_id'=>'nullable|exists:roles,id']);
        if($r->filled('password')) $data['password'] = Hash::make($r->password);
        $user->update($data);
        return redirect()->route('users.index')->with('success','User diupdate.');
    }
    public function destroy(User $user){ $user->delete(); return back()->with('success','User dihapus.'); }
}
