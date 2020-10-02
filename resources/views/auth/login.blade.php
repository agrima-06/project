@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">Welcome Back!</div>

                <div class="card-body p-0">
                    <div class="container">
                      <div class="row">
                        <div class="col-6" style="padding-left: 30px">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                        <input id="email" type="email" class="form-control mb-2 mt-4 form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address..." autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group row">

                                        <input id="password" type="password" class=" form-control-user mt-2 mb-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" >

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="d-flex flex-column bd-highlight mb-3">
                                      <div class="p-2 bd-highlight">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                      </div>
                                      <div class=" bd-highlight">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                      </div>
                                      <div class="p-2 bd-highlight">
                                          <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                          </button>
                                      </div>
                                    </div>                                    
                                </div>
                            </form>
                        </div>
                        <div class="col-6" style="padding-right: 0px; padding-left: 15px">
                            <img src = "{{ asset('/images/login.png') }}" style="width: 100%" />
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
