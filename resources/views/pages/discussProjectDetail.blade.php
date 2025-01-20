@extends('layouts.app')

@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2 class="d-block">Project Discussion Details</h2>
            </div>
            <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                <ul class="breadcrumb mb-0 pl-1">
                    <li><a href="/">Home</a></li>
                    <li>Project Discussion Details</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="about-bg w-100 d-block py-md-5 py-3">
    <div class="container">
        <form action="{{ route('discuss-project.index') }}" method="GET" class="mb-3">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" value="{{ old('name', request('name')) }}">
                </div>
                <div class="col-md-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email', request('email')) }}">
                </div>
                <div class="col-md-2">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', request('start_date')) }}">
                </div>
                <div class="col-md-2">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', request('end_date')) }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h4>Project Details</h4>
                <table class="table table-bordered table-hover" id="discussProjectsTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Company Name</th>
                            <th>Website URL</th>
                            <th>Project Budget</th>
                            <th>Services</th>
                            <th>Image</th>
                            <th>Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $index => $project)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $project->full_name }}</td>
                                <td>{{ $project->email }}</td>
                                <td>{{ $project->contact_number }}</td>
                                <td>{{ $project->company_name }}</td>
                                <td>
                                    <a href="{{ $project->website_url }}" target="_blank">{{ $project->website_url }}</a>
                                </td>
                                <td>{{ $project->project_budget }}</td>
                                <td>
                                    @php
                                        $services = is_string($project->services) ? json_decode($project->services, true) : $project->services;
                                    @endphp
                                    @if (!empty($services) && is_array($services))
                                        <ol class="list-unstyled mb-0">
                                            @foreach ($services as $service)
                                                <li><i class="bi bi-check-circle text-success"></i> {{ $service }}</li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <span class="text-muted">No Services</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($project->image)
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="Image" class="img-thumbnail" style="max-width: 100px; height: auto;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($project->created_at)->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#discussProjectsTable').DataTable({
                responsive: true,
                order: [[9, 'desc']], // Sort by 'Sent At' column in descending order
                columnDefs: [
                    { orderable: false, targets: [0, 7, 8] }, // Disable ordering for certain columns
                ],
                language: {
                    search: "Search Projects:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                    },
                },
            });
        });
    </script>
</section>
@endsection
