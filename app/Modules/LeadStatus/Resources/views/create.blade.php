@extends('layouts.app')
@section('title')
    Add Lead Status
@endsection
@section('page_css')

@endsection
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add New Lead Status</h5>
            </div>
            <form id="addNewForm" class="needs-validation" novalidate>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                    <div class="alert alert-danger d-none" id="validationErrorsForColor"></div>

                    @include('LeadStatus::createFields')
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" id="btnSave"
                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                        Save
                    </button>
                    <a href="{{ route('lead.status.index') }}">
                        <button type="button" id="btnCancel" class="btn btn-info ml-1">
                            Cancel
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
