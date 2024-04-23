<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ isset($kategori) ? 'Edit' : 'Create' }} Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ isset($kategori) ? route('kategoris.update', $kategori->id) : route('kategoris.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @isset($kategori)
                            @method('put')
                        @endisset

                        <div>
                            <x-input-label for="name" value="Category Name" />
                            <x-text-input id="name" name="nama_kategori" type="text" class="mt-1 block w-full" :value="$kategori->nama_kategori ?? old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_kategori')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Category Description" />
                            <textarea id="description" name="deskripsi_kategori" class="mt-1 block w-full" rows="4">{{ $kategori->deskripsi_kategori ?? old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi_kategori')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
