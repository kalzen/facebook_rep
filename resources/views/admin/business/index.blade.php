@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Business Management</h3>
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBusinessModal">
                            Add New Business
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Business ID</th>
                                <th>Telegram Bot Token</th>
                                <th>Telegram Chat ID</th>
                                <th>Data Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($businesses as $business)
                            <tr>
                                <td>{{ $business->business_id }}</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control bot-token-input" 
                                            value="{{ $business->tele_bot_token }}" 
                                            data-business-id="{{ $business->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control chat-id-input" 
                                            value="{{ $business->tele_chat_id }}" 
                                            data-business-id="{{ $business->id }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success btn-sm save-telegram" 
                                                data-business-id="{{ $business->id }}">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $business->data->count() }}</td>
                                <td>
                                    <form action="{{ route('admin.business.delete', $business->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Business Modal -->
<div class="modal fade" id="addBusinessModal" tabindex="-1" aria-labelledby="addBusinessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.business.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusinessModalLabel">Add New Business</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Telegram Bot Token</label>
                        <input type="text" name="tele_bot_token" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telegram Chat ID</label>
                        <input type="text" name="tele_chat_id" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.save-telegram').on('click', function() {
        var button = $(this);
        var businessId = button.data('business-id');
        var row = button.closest('tr');
        var botToken = row.find('.bot-token-input').val();
        var chatId = row.find('.chat-id-input').val();
        
        button.prop('disabled', true).text('Saving...');
        
        $.ajax({
            url: "{{ route('admin.business.updateTelebot') }}",
            type: 'POST',
            data: {
                id: businessId,
                tele_bot_token: botToken,
                tele_chat_id: chatId
            },
            success: function(response) {
                if (response.success) {
                    alert('Telegram settings updated successfully');
                } else {
                    alert('Error updating settings');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                alert('Error updating settings: ' + (xhr.responseJSON?.message || error));
            },
            complete: function() {
                button.prop('disabled', false).text('Save');
            }
        });
    });
});
</script>
@endpush
