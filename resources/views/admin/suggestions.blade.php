@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Admin - Saran Pelanggan</h2>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Pesan</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suggestions as $suggestion)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $suggestion->name }}</td>
                    <td class="py-3 px-4">{{ $suggestion->email }}</td>
                    <td class="py-3 px-4">{{ $suggestion->message }}</td>
                    <td class="py-3 px-4">
                        <span
                            class="px-2 py-1 rounded text-sm {{ $suggestion->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $suggestion->status ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $suggestion->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="py-3 px-4 flex space-x-2">
                        @if(!$suggestion->status)
                        <form action="{{ route('suggestions.markAsRead', $suggestion->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="text-green-600 hover:text-green-800 text-sm">Tandai sebagai
                                Dibaca</button>
                        </form>
                        @endif
                        <form action="{{ route('suggestions.destroy', $suggestion->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-3 px-4 text-center text-gray-600">Belum ada saran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection