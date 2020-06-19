@extends('layouts.master')



@section('title')
    Welcome!
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>
                Sign Up
            </h3>

            <form
                action="{{ route('signup') }}"
                method="post"
            >
                @csrf

                <div class="form-group">
                    <label for="">
                        E-Mail
                    </label>

                    <input
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        type="text"
                        name="email"
                        id="email"
                        value="{{ Request::old('email') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="">
                        Pirate Name
                    </label>

                    <input
                        class="form-control {{ $errors->has('piratename') ? 'is-invalid' : '' }}"
                        type="text"
                        name="piratename"
                        id="piratename"
                        value="{{ Request::old('piratename') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="">
                        password
                    </label>

                    <input
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        type="password"
                        name="password"
                        id="password"
                        value="{{ Request::old('password') }}"
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Sign Up
                </button>

                <input
                    type="hidden"
                    type="_token"
                    value="{{ Session::token() }}"
                >
            </form>
        </div>

        <div class="col-md-6">
            <h3>
                Sign In
            </h3>

            <form
                action="{{ route('signin') }}"
                method="post"
            >
                @csrf

                <div class="form-group">
                    <label for="">
                        E-Mail
                    </label>

                    <input
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        type="text"
                        name="email"
                        id="email"
                        value="{{ Request::old('email') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="">
                        password
                    </label>

                    <input
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        type="password"
                        name="password"
                        id="password"
                        value="{{ Request::old('password') }}"
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Sign In
                </button>

                <input
                    type="hidden"
                    type="_token"
                    value="{{ Session::token() }}"
                >
            </form>
        </div>
    </div>

    @include('includes.message-block')
@endsection
