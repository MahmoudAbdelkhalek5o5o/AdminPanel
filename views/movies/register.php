<h1 style="width:50%; position:relative; left:550px">Welcome to Movies</h1>
<form method = "POST" action="/register">
  <div class="mb-3"style="width:50%; position:relative; left:550px">
    <label class="form-label"><h4>username</h4></label>
    <input type="text" class="form-control" name="username" style="width:50%" >
  </div>
  <div class="mb-3"style="width:50%; position:relative; left:550px">
    <label class="form-label"><h4>password</h4></label>
    <input type="password" class="form-control" name="password" style="width:50%">
  </div>
  <div class="mb-3"style="width:50%; position:relative; left:550px">
    <label class="form-label"><h4>Confirm password</h4></label>
    <input type="password" class="form-control" name="cfdPassword" style="width:50%">
  </div>
<form style ="display:inline-block">
  <button type="submit" class="btn btn-primary" style="width:10%; position:relative; left:550px">Sign Up</button>
</form>
</form>

<?php if (!empty($errors)){?>
  <div class = "alert alert-danger">
    <?php foreach ($errors as $error){?>
    <div><?php echo $error?></div>
    <?php } ?> <?php }?>
</div>