@extends('layouts.layout')
@section('content')
    <div class="container my-5">
        <form class="bg-white shadow p-5 rounded-2" method="POST" action="/company/store/{{ $company?->id }}" enctype="multipart/form-data">
            @csrf
            <div class="image-input mb-5">

                <label class=" image-input-edit">
                    <i class="fa fa-edit text-white"></i>
                    <input type="file" hidden name="logo" class="input-image">
                </label>
                <div class="image-input-preview"
                     style="background-image:url({{ $company?->logo ? '/storage/' . $company->logo : '/assets/images/placeholder.jpg' }})">
                </div>
                <label class="image-input-delete">
                    <i class="fa fa-times text-white"></i>
                    <input type="checkbox" hidden name="remove_logo">
                </label>
            </div>
            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror

            <div class="mb-5">
                <label for="name">Company Name</label>
                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') ?? $company?->name }}">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') ?? $company?->email }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <label for="website">Website</label>
                <input id="website" type="text" name="website" class="form-control" value="{{ old('website')  ?? $company?->website}}">
                @error('website') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button class="btn btn-primary float-end mb-3" type="submit">
                {{ $company ? "Update" : "Add" }}
            </button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $('input[name="logo"]').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-input-preview').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('input[name="remove_logo"]').on('change', function () {
            $('.image-input-preview').css('background-image', 'url(/assets/images/placeholder.jpg)');
        });
    </script>
@endpush
