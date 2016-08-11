<div>
  <a class="hiddenanchor" id="signup"></a>
  <a class="hiddenanchor" id="signin"></a>

  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form method="post" action="<?php echo base_url()."index.php/admin/login" ?>">
          <h1>Admin Login Form</h1>
          <div>
            <input type="text" class="form-control" name="email" placeholder="email" required="" />
          </div>
          <div>
            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
          </div>
          <div>
            <button class="btn btn-default submit" value="submit">Log in</button> 
            <a class="reset_pass" href="#">Lost your password?</a>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link">New to site?
              <a href="#signup" class="to_register"> Create Account </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-paw"></i> Call Customizer!</h1>
              <p>©2016 All Rights Reserved. Call Customizer! Privacy and Terms</p>
            </div>
          </div>
        </form>
      </section>
    </div>

    <div id="register" class="animate form registration_form">
      <section class="login_content">
        <form>
          <h1>Create Account</h1>
          <div>
            <input type="text" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input type="email" class="form-control" placeholder="Email" required="" />
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Password" required="" />
          </div>
          <div>
            <a class="btn btn-default submit" href="index.html">Submit</a>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link">Already a member ?
              <a href="#signin" class="to_register"> Log in </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<style type="text/css">
  
  body {
    background: #F7F7F7;
  }

</style>