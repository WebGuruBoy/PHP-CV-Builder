<div class="row">
	<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
    <div class="card card-signin my-5">
		<?php if(isset($error) && $error!=''):?>
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Warning!</h4>
        <p><?php echo $error;?></p>

      </div>
    <?php endif;?>
    	<div class="card-body">
				<h5 class="card-title text-center">Sign In</h5>
				<form method="post" action="<?php echo $this->baseurl?>cvedit/cvlogin">
					<div class="form-label-group">
						<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
						<label for="inputEmail">Email address</label>
					</div>

					<div class="form-label-group">
						<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
						<label for="inputPassword">Password</label>
					</div>

					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="customCheck1">
						<label class="custom-control-label" for="customCheck1">Remember password</label>
					</div>
					<button class="btn btn-primary btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
          <hr>
          <a href="<?php echo $this->baseurl,'cvedit/cvheader/';?>" class="btn btn-success btn-block" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</a>
				</form>
			</div>
		</div>
	</div>
</div>