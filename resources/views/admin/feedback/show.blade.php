@extends('layouts.master')
@section('content')
    <style>
        .firstrow {
            color: #0a335c !important;
        }

        .secondrow {
            color: #1a1a2c !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10">
               
                
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('feed.index') }}"> Back</a>
                        </div>
                        {{ $feedback->message }}
                      </div>
                   







            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>
@endsection
@section('scripts')
@endsection
