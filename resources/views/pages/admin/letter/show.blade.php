@extends('layouts.admin')

@section('title')
Detail Surat
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
              Detail Surat
            </h1>
          </div>
          <div class="col-12 col-xl-auto mb-3">
            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
              <i class="me-1" data-feather="arrow-left"></i>
              Kembali Ke Semua Surat
            </button>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Main page content-->
  <div class="container-fluid px-4">
    <div class="row gx-4">
      <div class="col-lg-7">
        <div class="card mb-4">
          <div class="card-header">Detail Surat</div>
          <div class="card-body">
            <div class="mb-3 row">
              <table class="table">
                <tbody>
                  <tr>
                    <th>Jenis Surat</th>
                    <td>{{ $item->letter_type }}</td>
                  </tr>
                  <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $item->letter_no }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Surat</th>
                    <td>{{ $item->letter_date }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Diterima</th>
                    <td>{{ $item->date_received }}</td>
                  </tr>
                  <tr>
                    <th>Perihal</th>
                    <td>{{ $item->regarding }}</td>
                  </tr>
                  <tr>
                    <th>Pengirim Surat</th>
                    <td>{{ $item->sender->name }}</td>
                  </tr>
                  <tr>
                    <th>Departemen</th>
                    <td>{{ $item->department->name }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card mb-4">
          <div class="card-header">
            File Surat -
            <a href="{{ route('download-surat', $item->id) }}" class="btn btn-sm btn-primary">
              <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Surat
            </a>
          </div>
          <div class="card-body">
            <div class="mb-3 row">
              <embed src="{{ Storage::url($item->letter_file) }}" width="500" height="375" type="application/pdf">
            </div>
          </div>
        </div>
      </div>
      @if (Auth::user()->isKetua() && $item->letter_type == 'Surat Masuk')
      <div class="col-lg-7">
        <div class="card mb-4">
          <div class="card-header">Disposisi Surat / Tindaklanjuti surat ini</div>
          <div class="card-body">
            {{-- Alert --}}
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('dispositions.store') }}" method="post">
              @csrf
              Pilih alasan:
              <div class="mb-3">
                @foreach (\App\Enum\DispositionReasonEnum::cases() as $reason)
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="reason" value="{{ $reason->value }}"
                    id="{{ $reason->name }}">
                  <label class="form-check-label" for="{{ $reason->name }}">
                    {{ $reason->value }}
                  </label>
                </div>
                @endforeach
              </div>
              <div class="mb-3">
                Pilih tujuan:
                <select name="addressed_to_user_id" class="form-select">
                  <option selected>Pilih Tujuan</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
              </div>
              <input type="hidden" name="letter_id" value="{{$item->id}}" />
              <div>
                <button type="submit" class="btn btn-primary">Buat disposisi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</main>
@endsection
