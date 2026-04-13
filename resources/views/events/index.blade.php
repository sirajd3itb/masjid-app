<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Event Masjid
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <a href="/events/create" class="bg-blue-500 text-white px-4 py-2 rounded">
            Tambah Event
        </a>

        <div class="mt-4">
            @foreach($events as $event)
                <div class="border p-4 mb-2 rounded">
                    <h3 class="font-bold">{{ $event->judul }}</h3>
                    <p>{{ $event->deskripsi }}</p>
                    <p>{{ $event->tanggal }}</p>
                    <p>{{ $event->lokasi }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>