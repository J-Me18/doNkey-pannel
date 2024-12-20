@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 text-center">
            <div class="maintenance-card">
                <!-- Animated Spinner Icon -->
                <div class="spinner-container mb-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- Maintenance Message -->
                <h1 class="display-4 mb-3">We’re Currently Under Maintenance</h1>
                <p class="lead mb-4">
                    Our website is currently undergoing scheduled maintenance. We apologize for any inconvenience and appreciate your patience.
                </p>
                <p class="text-muted">
                    If you need immediate assistance, please contact our support team at <a href="mailto:support@donkeydeliveries.com">support@donkeydeliveries.com</a>.
                </p>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .spinner-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
    }

    .maintenance-card {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .maintenance-card h1 {
        font-size: 2.5rem;
        color: #333;
    }

    .maintenance-card p {
        font-size: 1.125rem;
        color: #666;
    }

    .maintenance-card a {
        color: #007bff;
        text-decoration: none;
    }

    .maintenance-card a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-5iWj6DO9hGR69E6QJ/fLSVh2KzXkABcaPQ4M1yMxZPob8e8Q1/QF1STUvce2/hnL6RUbebk4AVh6XkGnMbn1xw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-KtH4ZWKjXeNHROytH9JL/UqWFiI2I6Jp43kShC2tNTXIkLg4P3YjWFFMZ2zjfCefx4B+fi4RCUPKT90ctJx3A==" crossorigin="anonymous"></script>
@endsection
@endsection

