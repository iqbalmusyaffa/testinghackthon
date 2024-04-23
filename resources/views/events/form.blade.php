<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($event) ? 'Edit' : 'Create' }} Event
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    <form method="post" action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($event)
                            @method('put')
                        @endisset

                        <!-- Judul Event -->
                        <div class="mb-4">
                            <label for="judul_events" class="block text-gray-700 text-sm font-bold mb-2">Judul Event:</label>
                            <input type="text" name="judul_events" id="judul_events" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($event) ? $event->judul_events : '' }}" required autofocus>
                        </div>

                        <!-- Nama Event -->
                        <div class="mb-4">
                            <label for="nama_events" class="block text-gray-700 text-sm font-bold mb-2">Nama Event:</label>
                            <input type="text" name="nama_events" id="nama_events" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($event) ? $event->nama_events : '' }}" required>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                            <select name="kategori_id" id="kategori_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ isset($event) && $event->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gambar Event -->
                        <div>
                            <label for="gambar_events" class="block text-gray-700 text-sm font-bold mb-2">Gambar Event</label>
                            <input type="file" id="gambar_events" name="gambar_events" class="form-input">
                            @if(isset($event) && $event->gambar_events)
                                <img src="{{ asset(Storage::url($event->gambar_events)) }}" alt="Gambar Event" class="mt-2 max-w-full h-auto">
                            @endif
                        </div>

                        <!-- Tanggal Event -->
                        <div class="mb-4">
                            <label for="tanggal_events" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Event:</label>
                            <input type="date" name="tanggal_events" id="tanggal_events" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Deskripsi Event -->
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Event:</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-textarea rounded-md shadow-sm mt-1 block w-full" required>{{ isset($event) ? $event->deskripsi : '' }}</textarea>
                        </div>

                        <!-- Lokasi Event -->
                        <div class="mb-4">
                            <label for="lokasi_events" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Event:</label>
                            <input type="text" name="lokasi_events" id="lokasi_events" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($event) ? $event->lokasi_events : '' }}" required>
                        </div>

                        <!-- Harga Event -->
                        <div class="mb-4">
                            <label for="harga_events" class="block text-gray-700 text-sm font-bold mb-2">Harga Event:</label>
                            <input type="number" name="harga_events" id="harga_events" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($event) ? $event->harga_events : '' }}" required>
                        </div>

                        <!-- Penulis Event -->
                        <div class="mb-4">
                            <label for="author_events" class="block text-gray-700 text-sm font-bold mb-2">Penulis Event:</label>
                            <input type="text" name="author_events" id="author_events" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ isset($event) ? $event->author_events : '' }}" required>
                        </div>

                        <!-- Tanggal Mulai Event -->
                        <div class="mb-4">
                            <label for="tanggal_mulai" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai Event:</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Tanggal Berakhir Event -->
                        <div class="mb-4">
                            <label for="tanggal_berakhir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Berakhir Event:</label>
                            <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                @if(isset($event))
                                    {{ __('Update') }}
                                @else
                                    {{ __('Create') }}
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // create onchange event listener for gambar_events input
        document.getElementById('gambar_events').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                // if there is an image, create a preview in gambar_events_preview
                document.getElementById('gambar_events_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>
