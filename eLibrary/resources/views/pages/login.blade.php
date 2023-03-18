<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css\styles.css')}}" rel="stylesheet" />
    </head>
    <body class="text-center">
        <section class="vh-100" style="background-color: #508bfc;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        
                        <form action="{{ route("login") }}" method="POST">
                        @csrf
                        <h3 class="mb-5">Login</h3>
                            
                        <div class="form-outline mb-4">
                            <input type="email" id="typeEmailX-2" name="email" class="form-control form-control-lg" />
                            <label class="form-label" for="typeEmailX-2">Email</label>
                        </div>
            
                        <div class="form-outline mb-4">
                            <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" />
                            <label class="form-label" for="typePasswordX-2">Password</label>
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>

                        @if (session()->has('error'))
                            <div class="alert alert-danger mt-4" role="alert">
                                {{ session("error")["message"] }}
                            </div>
                        @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
    </body>
</html>
