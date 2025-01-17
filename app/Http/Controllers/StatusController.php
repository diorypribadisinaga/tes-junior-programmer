<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    public function viewStatus():Response
    {
        $status = Status::all();

        return \response()->view('status',[
            'title'=>'Status',
            'status'=>$status
        ]);
    }

    public function saveStatus(StatusRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $status = new Status($data);
        $status->save();

        return response()->redirectTo('/status')
            ->with('success','Status berhasil ditambahkan');
    }

    public function editStatus(StatusRequest $request, $id):RedirectResponse
    {
        //Check status
        $status = Status::query()->find($id);
        if (!$status) {
            return \response()->redirectTo('/status')
                ->with('error','Status tidak ditemukan');
        }

        $data = $request->validated();

        $status->nama_status = $data['nama_status'];
        $status->save();

        return response()->redirectTo('/status')
            ->with('success','Status berhasil diubah');
    }


    public function deleteStatus($id):RedirectResponse
    {
        //Check status
        $status = Status::query()->find($id);
        if (!$status) {
            return \response()->redirectTo('/status')
                ->with('error','Status tidak ditemukan');
        }
        $status->delete();

        return response()->redirectTo('/status')
            ->with('success','Status berhasil dihapus');
    }
}
