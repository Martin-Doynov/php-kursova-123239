<?php
if (isset($_GET['error'])) {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Грешка!',
            text: 'Грешен имейл или парола!',
            confirmButtonColor: '#3085d6'
        });
    </script>";
}
?>

<style>
.login-wrapper {
    position: relative;
    height: calc(101vh - 136px); /* Assuming header+footer = 136px */
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    margin-top: -1.5rem;  /* Remove py-3 spacing */
    margin-bottom: -1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: url('./uploads/planeparked.jpg') no-repeat center;
    background-size: cover;
}

.login-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 0;
}

.login-form {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.41);
}
</style>

<div class="login-wrapper">
    <form class="login-form border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_login.php">
    <h3 class="text-center">Вход в системата</h3>
    <div class="mb-3">
        <label for="email" class="form-label">Имейл</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_COOKIE['user_email'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Парола</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary mx-auto">Вход</button>
</form>