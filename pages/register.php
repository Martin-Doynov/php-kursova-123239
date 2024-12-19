<style>
.register-wrapper {
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
    background: url('./uploads/airportplanes.jpg') no-repeat center;
    background-size: cover;
}

.register-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 0;
}

.register-form {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.41);
}
</style>

<div class="register-wrapper">
    <form class="register-form border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_register.php">
        <h3 class="text-center">Регистрация</h3>
        <div class="mb-3">
            <label for="names" class="form-label">Имена</label>
            <input type="names" class="form-control" id="names" name="names" value="<?php echo $flash['data']['names'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Имейл</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $flash['data']['email'] ?? '' ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Парола</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="repeat_password" class="form-label">Повтори парола</label>
            <input type="password" class="form-control" id="repeat_password" name="repeat_password">
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin" id="user_radio" value="1" checked>
                <label class="form-check-label" for="user_radio">Потребител</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_admin" id="admin_radio" value="2">
                <label class="form-check-label" for="admin_radio">Администратор</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mx-auto">Регистрирай се</button>
    </form>
</div>