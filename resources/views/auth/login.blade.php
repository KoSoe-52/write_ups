<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Write Up Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="{{asset('images/logo4.png')}}" rel="icon">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>
    {{Auth::logout()}}
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                    <form method="POST" action="{{ url('mylogin') }}">
                        @csrf
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <!-- <a href="index.html" class=""> -->
                                    <h3 class="text-success"> <img src="{{asset('images/logo4.png')}}" alt="logo" style="width:80px;height:80px;"> CTF TRAINER</h3>
                                <!-- </a> -->
                                <!-- <h3>Crypto-2D</h3> -->
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="floatingInput" value="{{ old('username') ?: old('username') }}"  name="username" placeholder="Enter username"  autocomplete="off" 
                                      autofocus>
                                    <label for="floatingInput">Enter username</label>
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('username') ?: $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" autocomplete="off">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            <div>
                                @if(session('status'))
                                 <p class="text-danger">{{session('status')}}</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success py-3 w-100 mb-4 mt-4"> Sign In</button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
    <!-- JavaScript Libraries -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>