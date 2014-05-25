<?php 
require_once  'core/init.php';

if (Input::exists()){
	
	if (Token::check(Input::get('token')))
	{
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				
				'username' => array('required' =>true),
				'password' => array('required' =>true)
				
				));
		
		
		if ($validation->passed())
		{
			//Log user in
			$user = new User();
			
			$login =$user->login(Input::get('username'), Input::get('password'));
			
			
			
			if ($login)
			{
				echo 'success';
			}
			else 
			{
				echo '<p>Sorry , logging in faild.</p>';
			}
			
		}
		else 
		{
			//log in error
			foreach ($validation->errors() as $error){
				echo $error, '<br>';
			}
			
		}
		
	}
}
?>
<form action="" method="POST">
<div class="field">
		<label for="username">Username</label>
		<input type="text" id="username" name="username" value="<?=escape(Input::get('username'));?>" autocomplete="off">
	
	</div> 
	
	<div class="field">
		<label for="password">password</label>
		<input type="password" id="password" name="password" value="" autocomplete="off">
	
	</div>
	
	<input type="hidden" name="token" value="<?=Token::generate();?>" >
	<input type="submit" value="Log in">
</form>