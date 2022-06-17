@extends('components.main')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-4 fw-normal text-center">Registration</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>  
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>  
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="new-password">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>  
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password_confirmation" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password-confirm" placeholder="Password" required autocomplete="new-password">
                    <label for="password-confirm">Confirm Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>  
                    @enderror
                </div>

              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>

            </form>
            <small class="d-block text-center mt-3">Already login? <a href="{{ route('login') }}">Login now!</a></small>
          </main>
    </div>
</div>

@endsection