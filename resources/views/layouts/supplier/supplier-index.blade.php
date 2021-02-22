
<x-app-layout>
    <x-slot name="header">
        <div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Supplier List') }}

                </h2>

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pt-2 relative mx-auto text-gray-600 ml-auto flex justify-end mb-2 items-center">
                        <a href="{{route('supplier.add')}}" :active="request()->routeIs('supplier.add')" class="text-gray-600 fill-current mx-5">
                            <img src="{{ asset('img/circleplus.svg') }}" alt="add item" height="25" width="25">
                        </a>
                        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                          type="search" name="search" placeholder="Search" id="input_search">
                          <svg class="text-gray-600 h-4 w-4 fill-current absolute right-0 top-0 mt-5 mr-4" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                            width="512px" height="512px">
                            <path
                              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                          </svg>
                      </div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Id
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Address
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center" align="center">
                                                    status
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                    Created At
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                    Updated At
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="table_content">
                                            {{-- @foreach ($suppliers as $supplier)
                                                {{-- <tr scope="row">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $supplier->address }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" align="center"> <img src="{{ (intval($supplier->status) == 1) ? asset('img/circlecheck.svg') : asset('img/circlex.svg')  }}" alt=" {{(intval($supplier->status) == 1) ? "active" : "inactive"  }}"></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $supplier->created_at }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $supplier->updated_at }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><a href="{{ route('supplier.edit', ['supplier_id' => $supplier->id])}}" ><img src="{{ asset('img/edit.svg') }}" alt="Edit"></a></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><a href="{{ route('supplier.delete', ['supplier_id' => $supplier->id])}}">DELETE</a></td>
                                                </tr> --}}
                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetch_data();
            function fetch_data(name=''){
                $.ajax({
                    url:"{{ route('supplier.livesearch') }}",
                    method: 'GET',
                    data:{name:name},
                    dataType:'json',
                    success:function(data){
                        var table = "";
                        data.table_data.forEach(table_data => {
                            var status_src = (String(table_data.status) === "1") ? "{{asset('img/circlecheck.svg')}}" : "{{asset('img/circlex.svg')}}";
                            var status = (String(table_data.status) === "1") ? "active" : "inactive";

                            table += '<tr scope="row"><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + String(table_data.id) + '</td><td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + String(table_data.name) + '</td>';
                            table += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' + String(table_data.address) + '</td>';
                            table += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" align="center"> <img src="' +  status_src + '" alt="' + status +  '"></td>';
                            table += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">' + String(table_data.created_at) + '</td>';
                            table += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">' + String(table_data.updated_at) + '</td>';
                            table += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><a href="/supplier/edit/"' + String(table_data.id) + '" ><img src=" {{asset("img/edit.svg")}}" alt="EDIT"></button></td>';
                            table += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><a href="/supplier/delete/"  ' + table_data.id + ' ><img src=" {{asset('img/trash.svg')}}" alt="DELETE"></button></td></tr>"';
                        });

                        $('#table_content').html(table);
                        $('#total_record').text(data.total_data);
                    }
                });
            }
            $(document).on('keyup', '#input_search', function(){
                var name = $(this).val();
                fetch_data(name);
            });
        });
    </script>

</x-app-layout>
