@extends('layouts.main')
@section('content')
<h2 class="text-2xl font-bold mb-4">Edit User</h2>

<form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-3 max-w-md">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $user->name }}" class="border p-2 w-full">
    <input type="email" name="email" value="{{ $user->email }}" class="border p-2 w-full">
    <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
