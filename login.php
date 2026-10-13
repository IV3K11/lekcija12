<?php include("header.php"); ?>

<div class="auth-container">
    <h1 class="h3">Please sign in</h1>

    <form action="loginlogic.php" method="POST">
        <label for="username" class="form-label">Username</label>
        <input 
            type="text" 
            id="username" 
            name="username" 
            class="form-control" 
            placeholder="Username" 
            required>

        <label for="password" class="form-label">Password</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            class="form-control" 
            placeholder="Password" 
            required>

        <button 
            type="submit" 
            name="submit" 
            class="btn btn-primary btn-lg">
            Sign in
        </button>
    </form>

    <small>
        Don't have an account? 
        <a href="signup.php">Sign Up</a>
    </small>

    <p class="text-muted mt-5">
        Digital School &copy; 2026
    </p>
</div>

<?php include("footer.php"); ?>