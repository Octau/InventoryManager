
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="col-sm-12">
                        <form action="{{ route('supplier.update', ['supplier_id' => $supplier->id]) }}" method="POST">
                            @csrf

                            <div class="flex flex-col mb-4">
                                <label>Name</label>
                                <input type="text" class="" name="name" value="{{ $supplier->name }}">
                            </div>
                            <div class="flex flex-col mb-4">
                                <label>Address</label>
                                <input type="text" class="" name="address" value="{{ $supplier->address }}">
                            </div>
                            <div class="flex flex-col mb-4">
                                <label>Status</label>
                                <input type="checkbox" name="supplier_status" {{ (intval($supplier->status) == 1) ? "checked" : "" }}>
                            </div>
                            <button class="block p-2 px-4 rounded text-center no-underline text-sm text-white text-lg bg-blue-500">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
