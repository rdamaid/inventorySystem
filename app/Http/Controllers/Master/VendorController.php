<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Model\Master\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Vendor();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->cp = $request->contactPerson;
        $data->phone = $request->phone;
        $data->active = $request->status;
        $data->user_modified = Auth::user()->id;

        if ($data->save()) {
            toastr()->success('Vendor Created Successfully', 'Success');
            return redirect()->route( 'vendor.index' );
        } else {
            toastr()->error('Vendor Cannot be Created Successfully', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Vendor::with(['user_modify'])->where('id', $id)->get();
        if ($data->count() > 0) {
            return view('vendor.view', compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Vendor::where('id', $id)->where('active', '!=', 2)->get();
        if ($data->count() > 0) {
            return view('vendor.update', compact('data'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Vendor::find($id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->cp = $request->contactPerson;
        $data->phone = $request->phone;
        $data->active = $request->status;
        $data->user_modified = Auth::user()->id;

        if ($data->save()) {
            toastr()->success('Vendor Updated Successfully', 'Success');
            return redirect()->route( 'vendor.index' );
        } else {
            toastr()->error('Vendor Cannot be Updated Successfully', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Vendor::find($id);
        $data->active = 2;
        $data->user_modified= Auth::user()->id;
        if ($data->save()) {
            Toastr::success('Vendor Deleted Successfully', 'Success');
            return new JsonResponse(["status"->true]);
        } else {
            Toastr::error('Vendor cannot be Deleted Successfully', 'Error');
            return new JsonResponse(["status"->false]);
        }
    }

    public function datatable() {
        $data = Vendor::where('active', '!=', 2);
        return Datatables::of($data)
            ->addColumn('action', function($data) {
                $url_edit = url('master/vendor/'.$data->id.'/edit');
                $url = url('master/vendor/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i> </a>";
                $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i> </a>";
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>";

                return $view."".$edit."".$delete;
            })
            ->editColumn('address', function($data) {
                return str_ireplace("\r\n", ',', $data->address);
            })
            ->editColumn('phone', function($data) {
                return str_ireplace("\r\n", ',', $data->phone);
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID:{{$id}}')
            ->make(true);
    }
}
