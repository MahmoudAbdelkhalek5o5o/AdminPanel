<h1>Movies</h1>
    <div style = "display:inline-block; width:100%;">
    <p>
    <a href="/movies/create" class="btn btn-dark">Add movie</a>
    <a href="/" class="btn btn-dark"style="position:relative; left:1200px; bottom:80px">logout</a>
    </p>
    <form calss = "myForm" style = "display:inline-block" method = "GET">
    <div class="input-group mp-3">
      <input type="text" class="form-control" name = "search" placeholder="Search for a movie" aria-describedby="button-addon2">
      <button class="btn btn-outline-secondary" type="submit" id="search">Search</button>
    </div></form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Rating</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   <?php
      foreach ($movies as $i=>$film){?>
        <tr>
        <th scope="row"><?php echo $i+1?></th>
        <td> <img style = "width:15 0px; height:150px" src = "<?php echo $film['image'] ? $film['image']: "../images/large_movie_poster.png" ?>" class = "thump-image"></td>
        <td><?php echo $film['title']?></td>
        <td><?php echo $film['rating']?></td>

        <td>
          <a href = "/movies/update?id=<?php echo $film['id']?>" class="btn btn-dark"> EDIT </a>
        <form style ="display:inline-block" action="/movies/delete" method = "POST">
          <input type="hidden" name="id" value ="<?php echo $film['id']?>">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </td>
      </tr>
      <?php  };?>
  </tbody>
</table>