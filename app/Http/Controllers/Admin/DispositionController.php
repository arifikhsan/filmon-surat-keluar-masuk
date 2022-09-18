<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DispositionController extends Controller
{
  public function index()
  {
    return view('pages.admin.disposition.index', [
      'dispositions' => Disposition::with(['letter', 'createdByUser', 'addressedToUser'])->get(),
    ]);
  }

  public function data()
  {
    $dispositions = Disposition::with(['letter', 'createdByUser', 'addressedToUser'])->get();
    return DataTables::of($dispositions)
      ->addColumn('letter_no', function ($disposition) {
        return $disposition->letter->letter_no;
      })
      ->addColumn('sender', function ($disposition) {
        return $disposition->letter->sender->name;
      })
      ->addColumn('department', function ($disposition) {
        return $disposition->letter->department->name;
      })
      ->addColumn('created_by_user_name', function ($disposition) {
        return $disposition->createdByUser->name;
      })
      ->addColumn('addressed_to_user_name', function ($disposition) {
        return $disposition->addressedToUser->name;
      })
      ->addColumn('action', function ($disposition) {
        return view('pages.admin.disposition.action', [
          'disposition' => $disposition,
        ]);
      })
      ->rawColumns(['action'])
      ->addIndexColumn()
      ->make(true);
  }

  public function show($id)
  {
    $disposition = Disposition::with(['letter', 'createdByUser', 'addressedToUser'])->findOrFail($id);
    return view('pages.admin.disposition.show', ['disposition' => $disposition]);
  }

  public function edit($id)
  {
    $disposition = Disposition::with(['letter', 'createdByUser', 'addressedToUser'])->findOrFail($id);
    $addressedUsers = User::all()->except(Auth::id());
    $incomingLetters = Letter::where('letter_type', 'Surat Masuk')->get();

    return view('pages.admin.disposition.edit', [
      'disposition' => $disposition,
      'addressedUsers' => $addressedUsers,
      'incomingLetters' => $incomingLetters,
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'reason' => 'required',
      'description' => 'max:255',
      'addressed_to_user_id' => 'required',
      'letter_id' => 'required',
    ]);
    $disposition = Disposition::findOrFail($id);
    $disposition->update($request->all());

    return back()->with('success', 'Disposisi berhasil diubah');
  }

  public function store(Request $request)
  {
    $request->validate([
      'letter_id' => 'required',
      'addressed_to_user_id' => 'required',
      'description' => 'max:255',
      'reason' => 'required',
    ]);

    $disposition = $request->all();
    $disposition['created_by_user_id'] = Auth::user()->id;
    Disposition::create($disposition);

    return back()->with('success', 'Berhasil menambahkan disposisi');
  }

  public function destroy($id)
  {
    $disposition = Disposition::findOrFail($id);
    $disposition->delete();

    return back()->with('success', 'Berhasil menghapus disposisi');
  }
}
