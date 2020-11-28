<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Name') !!}
		
			{!! Form::myInput('email', 'email', 'Email') !!}
	
			{!! Form::myInput('password', 'password', 'Password') !!}
	
			{!! Form::myInput('password', 'password_confirmation', 'Password again') !!}

			{!! Form::mySelect('department_name', 'Department Name', $departments, null, ['class' => 'form-control select2','required']) !!}
	
			{!! Form::mySelect('role', 'Role', config('variables.role'), null, ['class' => 'form-control select2']) !!}
	
			{!! Form::myFile('avatar', 'Avatar') !!}
	
			{!! Form::myTextArea('bio', 'Bio') !!}
		</div>  
	</div>
</div>