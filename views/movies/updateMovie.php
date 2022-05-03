<p>
    <a href = "/movies" class = "btn btn-primary">Go back to Movies List</a>
</p>
<h1>Update <?php echo $data['title']?></h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <img style = "width:250px;height:300px;"src="../../<?php echo $data['image']?>" class="img-fluid" alt="...">
    <form method = 'POST' enctype="multipart/form-data">
    <input type="hidden" name="id" value ="<?php echo $data['id']?>">
    <input type="hidden" name="image" value ="<?php echo $data['image']?>"?>
  <div class="mb-3">
    <label >Movie Title</label>
    <input type="text" class="form-control" name="Title" value="<?php echo $data['title']?>">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label >Movie Description</label>
    <input type="text" class="form-control" name="Description" value="<?php echo $data['Description']?>">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label >Rating</label>
    <input type="number"  step = '0.1' min = '0' max = '10'class="form-control" name = "rating" value ="<?php echo $data['rating']?>">
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
      <div class = "success"><h3>Movie updated successfully</h3></div>
  <?php } ?>
  <button type="submit" class="btn btn-primary">Update</button>