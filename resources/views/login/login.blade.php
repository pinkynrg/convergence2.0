<!DOCTYPE html>
<html>
<head>
	@include('includes.head')
</head>
<body>

	<div id="login_wrapper">

		@include('includes.debug')

		@include('includes.header')
		
		<div id="form_wrapper">

			<img id="login_img" src="/images/style/login.png">

			{!! Form::open(array('method' => 'POST', 'route' => array('login.login'))) !!}

				@include('includes.errors')
			
				<div class="form-group">
					<input class="form-control" name="username" type="text" id="username" placeholder="username">
				</div>
				<div class="form-group">
					<input class="form-control" name="password" type="password" id="password" placeholder="password">
				</div>
				<div id="remember" class="checkbox">
	                <label>
	                    <input type="checkbox" value="remember-me"> Remember me
	                </label>
	            </div>
				
				<div class="form-group">
	            	{!! Form::BSSubmit("Sign in",["id" => "login_btn"]) !!}
	            </div>

	            <a href="#" class="forgot-password">
	                Forgot the password?
	            </a>

	        {!! Form::close() !!}

		</div>
	</div>

	@include('includes.footer')

</body>
</html>