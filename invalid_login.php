<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/admin-login.css">
<title>Admin Login</title>
</head>
<body>
  <body>
    <div class="login-page">
      <div class="form">
        <div class="login">
          <div class="login-header">
            <h1 style="color: red">Invalid Login! Please Try Again</h1>
            <h3>ADMIN LOGIN</h3>
            <p>Please enter your credentials to login.</p>
          </div>
        </div>
        <form class="login-form" action="admin_login_2.php" method="post">
          <input type="email" class="form-control "
                       id="userId" name="userId" placeholder="use your email address">
          <input type="password" class="form-control "
                      id="password" name="password" placeholder="use a strong password">
          <button>login</button>
        </form>
      </div>
    </div>
</body>
</body>
</html>