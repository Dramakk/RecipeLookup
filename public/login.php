<?php 
include "header.html"?>
<body>
<div class="container text-center">
    <h2>Login to existing account</h2>
    <form action="../index.php?action=loginUser" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="userU" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="userP" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
