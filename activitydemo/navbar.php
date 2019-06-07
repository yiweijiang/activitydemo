<header role="banner">

	<div id="cd-logo"><a href="index.php"><img src="123.png" alt="Logo"></a></div>

	<nav class="main-nav">
		<ul>
			<li><a class="cd-signup" href="#">Sign up</a></li>
			<li><a class="cd-signin" href="#">Sign in</a></li>
		</ul>
	</nav>
</header>

<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
	<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
		<ul class="cd-switcher">
			<li><a href="#">Sign in</a></li>
			<li><a href="#">New account</a></li>
		</ul>

		<div id="cd-login"> <!-- log in form -->
			<form class="cd-form" method="post" action="login.php">
				<p class="fieldset">
					<label class="image-replace cd-email" for="signin-email">E-mail</label>
					<input class="full-width has-padding has-border" id="signin-email" type="email"
					name="Login_email" placeholder="E-mail" required>
				</p>

				<p class="fieldset">
					<label class="image-replace cd-password" for="signin-password">Password</label>
					<input class="full-width has-padding has-border" id="signin-password" type="text"
					name="Login_password"  placeholder="Password" required>
				</p>

				<p class="fieldset">
					<input type="checkbox" id="remember-me" checked>
					<label for="remember-me">Remember me</label>
				</p>

				<p class="fieldset">
					<input class="full-width" type="submit" value="Login">
				</p>
			</form>

			<p class="cd-form-bottom-message"><a href="#">Forgot your password?</a></p>
			<!-- <a href="#0" class="cd-close-form">Close</a> -->
		</div> <!-- cd-login -->

		<div id="cd-signup"> <!-- sign up form -->
			<form class="cd-form" method="post" action="signup.php">
				<p class="fieldset">
					<label class="image-replace cd-username" for="signup-username">Name</label>
					<input class="full-width has-padding has-border" id="signup-name" type="text"
					name="Register_name" placeholder="Name" required>
				</p>

				<p class="fieldset">
					<label class="image-replace cd-email" for="signup-email">E-mail</label>
					<input class="full-width has-padding has-border" id="signup-email" type="email"
					name="Register_email" placeholder="E-mail" required>
				</p>

				<p class="fieldset">
					<label class="image-replace cd-email" for="signup-phone">Phone</label>
					<input class="full-width has-padding has-border" id="signup-phone" type="phone"
					name="Register_phone" placeholder="Phone" required>
				</p>

				<p class="fieldset">
					<label class="image-replace cd-password" for="signup-password">Password</label>
					<input class="full-width has-padding has-border" id="signup-password" type="text"
					name="Register_password"  placeholder="Password" required>
					<a href="#" class="hide-password">Hide</a>
				</p>

				<p class="fieldset">
					<input type="checkbox" id="accept-terms">
					<label for="accept-terms">I agree to the <a href="#">XXX</a></label>
				</p>

				<p class="fieldset">
					<input class="full-width has-padding" type="submit" value="Create account">
				</p>
			</form>

			<!-- <a href="#0" class="cd-close-form">Close</a> -->
		</div> <!-- cd-signup -->

		<div id="cd-reset-password"> <!-- reset password form -->
			<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

			<form class="cd-form" method="get" action="index.php">
				<p class="fieldset">
					<label class="image-replace cd-email" for="reset-email">E-mail</label>
					<input class="full-width has-padding has-border" id="reset-email" type="email"
					name="Reset_password" placeholder="E-mail" required>
				</p>

				<p class="fieldset">
					<input class="full-width has-padding" type="submit" value="Reset password">
				</p>
			</form>

			<p class="cd-form-bottom-message"><a href="#">Back to log-in</a></p>
		</div> <!-- cd-reset-password -->
		<a href="#" class="cd-close-form">Close</a>
	</div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->