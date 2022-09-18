@extends('layouts.admin')

@section('title')
Detail Disposisi
@endsection

@section('container')
<main>
  <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
      <div class="page-header-content">
        <div class="row align-items-center justify-content-between pt-3">
          <div class="col-auto mb-3">
            <h1 class="page-header-title">
              <div class="page-header-icon"><i data-feather="file-text"></i></div>
              Detail Disposisi
            </h1>
          </div>
          <div class="col-12 col-xl-auto mb-3">
            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
              <i class="me-1" data-feather="arrow-left"></i>
              Kembali Ke Semua Disposisi
            </button>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Main page content-->
  <div class="container-fluid px-4">
    <div class="row gx-4">
      <div class="col-lg-6">
        <div class="card mb-4">
          <div class="card-header">Detail Disposisi</div>
          <div class="card-body">
            <div class="mb-3 row">
              <table class="table">
                <tbody>
                  <tr>
                    <th>Pembuat Disposisi</th>
                    <td>{{ $disposition->createdByUser->name }}</td>
                  </tr>
                  <tr>
                    <th>Ditujukan Kepada</th>
                    <td>{{ $disposition->addressedToUser->name }}</td>
                  </tr>
                  <tr>
                    <th>Deskripsi</th>
                    <td>{{ $disposition->description }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card mb-4">
          <div class="card-header">Detail Surat</div>
          <div class="card-body">
            <div class="mb-3 row">
              <table class="table">
                <tbody>
                  <tr>
                    <th>Jenis Surat</th>
                    <td>{{ $disposition->letter->letter_type }}</td>
                  </tr>
                  <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $disposition->letter->letter_no }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Surat</th>
                    <td>{{ $disposition->letter->letter_date }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Diterima</th>
                    <td>{{ $disposition->letter->date_received }}</td>
                  </tr>
                  <tr>
                    <th>Perihal</th>
                    <td>{{ $disposition->letter->regarding }}</td>
                  </tr>
                  <tr>
                    <th>Pengirim Surat</th>
                    <td>{{ $disposition->letter->sender->name }}</td>
                  </tr>
                  <tr>
                    <th>Departemen</th>
                    <td>{{ $disposition->letter->department->name }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header">
            File Surat -
            <a href="{{ route('download-surat', $disposition->id) }}" class="btn btn-sm btn-primary">
              <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Surat
            </a>
          </div>
          <div class="card-body">
            <div class="mb-3 row">
              <embed src="{{ Storage::url($disposition->letter->letter_file) }}" width="500" height="375" type="application/pdf">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
