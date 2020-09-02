@extends('layouts.app')

@section('content')

<navbar-component></navbar-component>

<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <task-component></task-component>

            <modal-component></modal-component>
        </div>
    </div>
</div>
@endsection
