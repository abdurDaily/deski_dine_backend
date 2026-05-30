@extends('dashboard')
@section('title', 'Members')
@section('content')
    <x-breadcrumb></x-breadcrumb>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Members</h4>
                    <form method="GET" class="d-flex align-items-center" action="{{ route('members.index') }}">
                        <input type="search" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="Search by card number, name, phone" />
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Card Number</th>
                                    <th>Type</th>
                                    <th>Student</th>
                                    <th>Total Purchase</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>{{ $member->id }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->phone }}</td>
                                        <td>{{ $member->unique_card_number }}</td>
                                        <td>{{ ucfirst($member->type) }}</td>
                                        <td>{{ $member->is_student ? 'Yes' : 'No' }}</td>
                                        <td>৳ {{ number_format($member->total_purchase, 2) }}</td>
                                        <td>{{ ucfirst($member->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No members found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $members->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
