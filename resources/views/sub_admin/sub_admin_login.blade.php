@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
          <div class="col-md-12">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">DesiLudo</a>
              <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
              <form class="forms-sample" method="post" action="{{ url('subadminlogin/login') }}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    
                    <?php 
                      if($error==1){
                          ?>
                            <span class="invalid-feedback" role="alert" style="display:block">
                                <strong>{{ $message }}</strong>
                            </span>
                          <?php
                      }
                        
                    ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="password">
                   
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection