<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEWA - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="home.php">BEWA</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      </nav>
      <br>
      <br>
      <br>
      <br>

    <div class="mx-auto fs-2 fw-bolder mb-4 " style="width: 400px;">
        Create An Account
    </div>

    <form class="mx-auto" style="width: 400px;">
        <div class="mb-4">
          <label class="form-label">First Name</label>
          <input class="form-control">
          <div class="form-text"></div>
        </div>
        <div class="mb-4">
            <label class="form-label">Last Name</label>
            <input class="form-control">
            <div class="form-text"></div>
          </div>
        <div class="mb-4">
            <label for="exampleInputEmail1" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text"></div>
          </div>
        <div class="mb-4">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
        <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Manager Account?</label>
            <label class="fw-light text-muted mb-4">Only check this if you plan on creating and managing Businesses within the BEWA App.</label>
          </div>
        <button type="submit" class="btn btn-primary">Create Account</button>
      </form>

      <br>
      <br>

      <div class="mx-auto fw-light text-muted mb-5" style="width: 400px;">
        Already have an account? Log in <a href="login.php">here.</a>
      </div>

</body>
</html>