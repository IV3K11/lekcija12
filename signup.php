<?php include("header.php"); ?>

<div class="auth-container">
    <h1 class="h3">Please sign up</h1>

    <form action="register.php" method="POST">
        <input 
            type="text" 
            name="name" 
            class="form-control" 
            placeholder="Name" 
            required>

        <input 
            type="text" 
            name="surname" 
            class="form-control" 
            placeholder="Surname" 
            required>

        <input 
            type="text" 
            name="username" 
            class="form-control" 
            placeholder="Username" 
            required>

        <input 
            type="email" 
            name="email" 
            class="form-control" 
            placeholder="Email" 
            required>

        <input 
            type="password" 
            name="password" 
            class="form-control" 
            placeholder="Password" 
            required>

        <button 
            type="submit" 
            name="submit" 
            class="btn btn-primary btn-lg">
            Sign up
        </button>
    </form>

    <small>
        Already have an account? 
        <a href="login.php">Log In</a>
    </small>

    <p class="text-muted mt-5">
        Digital School &copy; 2026
    </p>
</div>

<?php include("footer.php"); ?>