@extends('layouts.main')
@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah User</h2>

<form action="{{ route('users.store') }}" method="POST" class="space-y-3 max-w-md">
    @csrf
    <input type="text" name="name" placeholder="Nama" class="border p-2 w-full" required>
    <input type="email" name="email" placeholder="Email" class="border p-2 w-full" required>
    <input type="password" name="password" placeholder="Password" class="border p-2 w-full" required>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
