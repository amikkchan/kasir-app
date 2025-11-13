@extends($layout)

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">Profil Pengguna</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- FOTO PROFIL -->
        <div class="text-center mb-4">
            <div class="flex flex-col items-center">
                @php
                    $photoPath = $user->photo 
                        ? Storage::url($user->photo) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
                @endphp

                <img src="{{ $photoPath }}" 
                     alt="Foto Profil"
                     class="w-24 h-24 rounded-full object-cover border mb-2 shadow-sm">

                <input type="file" name="photo" accept="image/*" class="mt-2 text-sm">
            </div>
        </div>

        <!-- NAMA -->
        <div>
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="block font-semibold mb-1">Password Baru (opsional)</label>
            <input type="password" name="password" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <!-- SIMPAN -->
        <div class="text-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <hr class="my-6">

    <!-- HAPUS AKUN -->
    <form action="{{ route('profile.destroy') }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus akun ini?')" class="text-center">
        @csrf
        @method('DELETE')
        <button class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
            Hapus Akun
        </button>
    </form>
</div>
@endsection
