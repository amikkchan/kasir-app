@extends('layouts.main')
@section('content')
<h2 class="text-2xl font-bold mb-4">Manajemen User</h2>

<a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-3 inline-block">+ Tambah User</a>

<table class="w-full border text-sm">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">Email</th>
            <th class="p-2">Role</th>
            <th class="p-2 w-32">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $u)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-2">{{ $u->name }}</td>
            <td class="p-2">{{ $u->email }}</td>
            <td class="p-2">{{ $u->role->name ?? '-' }}</td>
            <td class="p-2">
                <a href="{{ route('users.edit', $u->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
