<p>
    <a href = "/movies" class = "btn btn-primary">Go back to Movies List</a>
</p>
<h1>Add a new Movie</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <form method = 'POST' enctype="multipart/form-data">
  <div class="mb-3">
    <label >Movie Title</label>
    <input type="text" class="form-control" name="Title" placeholder="movie name">
  </div>
  <div class="mb-3">
    <label >Description</label>
    <input type="text" class="form-control" name="Description" placeholder="Tell us about it..">
  </div>
  <div class="mb-3">
    <label >Rating</label>
    <input type="number"  step = '0.1' min = '0' max = '10'class="form-control" name = "Rating" placeholder ="ex. 7.5">
  </div>
  <div class="mb-3">
    <label>Upload movie poster</label>
    <br>
    <input type="file" name = "Image">
  </div>
  <?php if (!empty($errors)){?>
  <div class = "alert alert-danger">
    <?php foreach ($errors as $error){?>
    <div><?php echo $error?></div>
    <?php } ?> <?php }?>
  </div>
  <?php if($success){?>
      <div class = "success"><h3>Movie Add successfully</h3></div>
  <?php } ?>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>