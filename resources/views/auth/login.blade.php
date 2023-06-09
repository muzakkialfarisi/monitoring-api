@include('_layout._single.header')

<div class="card">
    <div class="card-body">
        <div class="m-sm-4">
            <div class="row">
                <div class="col-12 text-center">
                    {{-- <img src="~/img/logo/wms_logo.png" alt="Linda Miller" class="img-fluid" width="150" height="40" /> --}}
                </div>
            </div>
            <br />
            <form method="post" action="{{ route('login_process') }}">
                @csrf

                <div class="form-floating mb-3">
				    <input class="form-control" name="email" placeholder="email">
				    <label for="email">Email</label>
			    </div>

                <div class="input-group mb-3">
                    <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="password" placeholder="password">
                        <label for="password">Password</label>
                    </div>
                    <span class="input-group-text "><i toggle="#password-field" class="fas fa-fw fa-eye-slash toggle-password"></i></span>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary ">Sign in</button>
                </div>
               
            </form>
        </div>
    </div>

</div>

@include('_layout._single.footer')