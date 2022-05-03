
<h1 style="width:50%; position:relative; left:550px">Welcome to Movies</h1>
<form method = "POST" action="/">
  <div class="mb-3"style="width:50%; position:relative; left:550px">
    <label class="form-label"><h4>username</h4></label>
    <input type="text" class="form-control" name="username" style="width:50%" >
  </div>
  <div class="mb-3"style="width:50%; position:relative; left:550px">
    <label class="form-label"><h4>password</h4></label>
    <input type="password" class="form-control" name="password" style="width:50%">
  </div>
<div style ="display:inline-block">
  <button type="submit" class="btn btn-primary" style="position:relative; left:550px">Login</button>
  <p></p>
  <a href ="/register"  class="btn btn-primary" style="position:relative; left:550px">new? Sign Up</a>
</div>
</form>
<?php if (!empty($errors)){?>
  <div class = "alert alert-danger">
    <?php foreach ($errors as $error){?>
    <div><?php echo $error?></div>
    <?php } ?> <?php }?>
</div>


<?php if(!$success){?>
    <div class = "alert alert-danger">
        <?php echo "Invalid username or password"?>
    <?php } ?>
</div>