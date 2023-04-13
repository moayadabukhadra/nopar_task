@extends('layouts.layout')
@section('content')
    <div class="container my-5 bg-white p-5 rounded-2 shadow">
        <div class="d-flex align-items-center justify-content-between mb-5 flex-column flex-md-row">
            <h3 class="fw-bol mb-3 mb-md-0">Companies</h3>
            <label class="d-flex align-items-center gap-2">
                <form class="d-flex align-items-center" method="GET" action="/companies">
                    @csrf
                    <input class="form-control" type="text" placeholder="search..." name="search"/>
                    <div class="btn btn-dark" onclick="$(this).closest('form').submit()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill=""></path>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                    </div>
                </form>
                <a href="company/show" class="btn btn-primary flex-shrink-0">
                    Add Company
                </a>
            </label>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Website</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <th scope="row">{{ $loop->index }}</th>
                    <td>
                        <div>
                            <img class="rounded-circle" width="50" height="50" alt="company-logo"
                                 src="{{ $company->logo ? "storage/". $company->logo : "/assets/images/placeholder.jpg" }}">
                            <span>{{ $company->name }}</span>
                        </div>
                    </td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-1">
                            <a href="company/show/{{ $company->id }}" class="btn btn-success">
                                Edit
                            </a>
                            <form method="POST" action="/company/destroy/{{ $company->id }}">
                                @csrf
                                <button type="button" class="btn btn-danger delete-company">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="w-100">
            {{ $companies->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.delete-company').on('click', function () {
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this company?",
                icon: "warning",
                dangerMode: true,
            })
                .then(willDelete => {
                    if (willDelete) {
                        $(this).closest('form').submit();
                    }
                });
        });
    </script>

    @if(session()->has('success'))
        <script>
            swal({
                title: "Successful",
                icon: "success",
                dangerMode: false,
            })
        </script>
    @endif
@endpush
