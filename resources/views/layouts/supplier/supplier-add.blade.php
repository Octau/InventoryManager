@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ url('/story') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="title">
                    </div>

                    <button class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
