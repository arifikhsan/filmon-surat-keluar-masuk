@extends('layouts.admin')

@section('title')
Ubah Disposisi
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
              Ubah Disposisi
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
    <form action="{{ route('dispositions.update', $disposition->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row gx-4">
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header">Form Disposisi</div>
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

              <div class="mb-3 row">
                <label for="letter_id" class="col-sm-3 col-form-label">Surat Masuk</label>
                <div class="col-sm-9">
                  <select name="letter_id" class="form-control selectx" required>
                    <option value="">Pilih..</option>
                    @foreach ($incomingLetters as $letter)
                    <option value="{{ $letter->id }}" {{ ($disposition->letter_id == $letter->id)? 'selected':'';
                      }}>{{ $letter->letter_no }}</option>
                    @endforeach
                  </select>
                </div>
                @error('letter_id')
                <div class="invalid-feedback">
                  {{ $message; }}
                </div>
                @enderror
              </div>

              <div class="mb-3 row">
                <label for="letter_type" class="col-sm-3 col-form-label">Alasan</label>
                <div class="col-sm-9">
                  @foreach (\App\Enum\DispositionReasonEnum::cases() as $reason)
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reason" value="{{ $reason->name }}"
                      id="{{ $reason->name }}" {{ $disposition->reason == $reason->name ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $reason->name }}">
                      {{ $reason->value }}
                    </label>
                  </div>
                  @endforeach
                </div>
                @error('reason')
                <div class="invalid-feedback">
                  {{ $message; }}
                </div>
                @enderror
              </div>

              <div class="mb-3 row">
                <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                  <textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Keterangan">{{ $disposition->description }}</textarea>
                </div>
                @error('description')
                <div class="invalid-feedback">
                  {{ $message; }}
                </div>
                @enderror
              </div>

              <div class="mb-3 row">
                <label for="addressed_to_user_id" class="col-sm-3 col-form-label">Ditujukan kepada</label>
                <div class="col-sm-9">
                  <select name="addressed_to_user_id" class="form-control selectx" required>
                    <option value="">Pilih..</option>
                    @foreach ($addressedUsers as $user)
                    <option value="{{ $user->id }}" {{ ($disposition->addressed_to_user_id == $user->id)? 'selected':'';
                      }}>{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>
                @error('addressed_to_user_id')
                <div class="invalid-feedback">
                  {{ $message; }}
                </div>
                @enderror
              </div>


              <div class="mb-3 row">
                <div class="col-sm-9">
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>
@endsection

@push('addon-style')
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(".selectx").select2({
            theme: "bootstrap-5"
        });
</script>
@endpush
