<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ 'Events' }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">ADD</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 overflow-x-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="p-4 pl-8 pr-12 text-left">Judul Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Nama Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Kategori</th>
                                <th class="p-4 pl-8 pr-12 text-left">Gambar Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Tanggal Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Deskripsi</th>
                                <th class="p-4 pl-8 pr-12 text-left">Lokasi Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Harga Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Author Event</th>
                                <th class="p-4 pl-8 pr-12 text-left">Tanggal Mulai</th>
                                <th class="p-4 pl-8 pr-12 text-left">Tanggal Berakhir</th>
                                <th class="p-4 pl-8 pr-12 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->judul_events }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->nama_events }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $event->kategoris->nama_kategori ?? '-' }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        @if($event->gambar_events)
                                            <a href="{{ Storage::url($event->gambar_events) }}" download>
                                                <img src="{{ Storage::url($event->gambar_events) }}" alt="Gambar Event" width="1000" height="1000">
                                            </a>
                                        @else
                                            No Image
                                        @endif
                                    </td>


                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->tanggal_events }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->deskripsi }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->lokasi_events }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->harga_events }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->author_events }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->tanggal_mulai }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $event->tanggal_berakhir }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('events.show', $event->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-2 py-1">
                                                Show
                                            </a>
                                            <a href="{{ route('events.edit', $event->id) }}" class="bg-red-500 hover:bg-yellow-600 text-white rounded-full px-2 py-1 mr-2">
                                                Edit
                                            </a>
                                            <form method="post" action="{{ route('events.destroy', $event->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white rounded-full px-2 py-1">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
