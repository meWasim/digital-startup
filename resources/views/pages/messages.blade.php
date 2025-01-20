@extends('layouts.app')

@section('title', 'Messages - Admin')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2>Messages</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Messages</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Messages List</h3>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('contacts.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $name) }}">
                    </div>
                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $email) }}">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $start_date) }}">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $end_date) }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Messages Table -->
            <div class="table-responsive">
                <table class="table table-bordered" id="contactTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Sent On</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No messages found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{-- <div class="d-flex justify-content-center">
                {{ $messages->links() }}
            </div> --}}
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#contactTable').DataTable({
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
@endsection
