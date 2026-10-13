<?php include("header.php"); ?>

<!-- Top navigation -->
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Digital School</a>
        
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="login.php">Sign out</a>
        </div>
    </div>
</nav>

<!-- Main layout -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar p-0">
            <a href="dashboard.php" class="fw-bold">Dashboard</a>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 col-lg-10 dashboard-content">
            <h1>Dashboard</h1>
            <p>Welcome to Digital School!</p>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Welcome!</h5>
                    <p class="card-text">This is our Bootstrap dashboard.</p>
                    <a href="signup.php" class="btn btn-primary">Create Account</a>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include("footer.php"); ?>