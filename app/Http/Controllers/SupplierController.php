<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller
{
    public function index(){
        // $suppliers = Supplier::query()
        //                     ->orderBy('id')
        //                     ->paginate(20);

        return view('layouts.supplier.supplier-index')
        ->with('suppliers');
    }

    public function livesearch(Request $request){
        $d_format = 'd-m-Y H:i:s';
        if($request->ajax()){
            $result = array();
            $suppliers = Supplier::where("name","LIKE", "%".$request->name."%")
            ->paginate(20);

            $total_row = $suppliers->count();
            if($total_row>0){
                foreach ($suppliers as $supplier) {
                                    // $x=0;
                // foreach($suppliers as $supplier){
                //     // $x+=1;
                //     // echo($x);
                //     $result .='<tr scope="row">
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'. $supplier->id .'</td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'. $supplier->name .'</td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'. $supplier->address .'</td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" align="center"> <img src="'. ((intval($supplier->status) == 1) ? asset('img/circlecheck.svg') : asset('img/circlex.svg'))  .'" alt=" '.((intval($supplier->status) == 1) ? "active" : "inactive")  .'"></td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">'. $supplier->created_at .'</td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">'. $supplier->updated_at .'</td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><a href="'. route('supplier.edit', ['supplier_id' => $supplier->id]).'" ><img src="'. asset('img/edit.svg') .'" alt="EDIT"></button></td>
                //         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><a href="'. route('supplier.delete', ['supplier_id' => $supplier->id]).'" ><img src="'. asset('img/trash.svg') .'" alt="DELETE"></button></td>
                //     </tr>';
                // }
                    $item = array(
                            "id" => $supplier->id,
                            "name" => $supplier->name,
                            "address" => $supplier->address,
                            "status" => $supplier->status,
                            "created_at" => date_format(date_create($supplier->created_at),$d_format),
                            "updated_at" => date_format(date_create($supplier->updated_at),$d_format),
                        );
                    array_push($result, $item);
                }
            }
        }
        $data = array(
            'table_data' => $result,
            'total_data' => $total_row,
        );
        echo json_encode($data);
    }

    public function singleSupplier($id){
        $supplier = Supplier::find($id)
                    ->first();

        return view('layouts.supplier.supplier-edit')
                ->with('supplier', $supplier);
    }
    public function create(){
        return view('layouts.supplier.supplier-add');
    }

    public function store(Request $request){
        $postData = $this->validate($request,[
            'name' => 'required|min:3',
            'address' => 'required|min:5',
        ]);

        $supplier = Supplier::create($postData);

        return redirect()->back();
    }

    public function delete($id){
        Supplier::where('id', strval($id))->delete();
        // DB::delete('delete from `suppliers` where id = ?', [number_format($id)]);
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $postData = $this->validate($request,[
            'name' => 'required|min:3',
            'address' => 'required|min:5',
        ]);

        $supplier = Supplier::firstWhere('id', strval($id));
        $supplier->name = $postData['name'];
        $supplier->address = $postData['address'];
        $supplier->status = ($request['supplier_status'] == "on") ? 1 : 0;
        $supplier->save();

        return redirect()->route('supplier.index');
        // DB::edit('UPDATE `suppliers`
        //             SET supplier_name = ?, supplier_address = ?
        //             WHERE id = ?'
        //  , [$supplier_name, $supplier_address,$id]);
    }
}
