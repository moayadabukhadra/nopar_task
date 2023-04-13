@extends('layouts.layout')
@section('content')
    <div class="container my-5">
        <form class="bg-white shadow p-5 rounded-2" method="POST" action="/employee/store/{{ $employee?->id }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" name="first_name" class="form-control"
                       value="{{ old('first_name') ?? $employee?->first_name }}">
                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" name="last_name" class="form-control"
                       value="{{ old('last_name') ?? $employee?->last_name }}">
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control"
                       value="{{ old('email') ?? $employee?->email }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone" class="form-control"
                       value="{{ old('phone') ?? $employee?->phone }}">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <select class="select2 form-control" name="company_id">
                    @foreach($companies as $company)
                        <option
                            @if($employee->company_id == $company->id) selected @endif
                            value="{{ $company->id }}">
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary float-end mb-3" type="submit">
                {{ $employee ? "Update" : "Add" }}
            </button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $('.select2').select2();
    </script>
@endpush
