@extends('layouts.app')

@section('content')
@if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">you must verify you email address</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Resend email') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection