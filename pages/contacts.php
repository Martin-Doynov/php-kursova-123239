<?php
// страница контакти

if (isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty(trim($name)) || empty(trim($email)) || empty(trim($message))) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Грешка!',
                text: 'Моля попълнете всички полета',
                confirmButtonColor: '#3085d6'
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Успешно изпратено!',
                text: 'Благодарим за вашето съобщение, " . $name . "! Ще получите отговор на " . $email . ".',
                confirmButtonColor: '#3085d6'
            });
        </script>";

        $name = '';
        $email = '';
        $message = '';
    }
}



?>
<div class="container py-4">
    <div class="row justify-content-center align-items-center gap-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title mb-4 text-dark">Свържете се с нас</h2>
                <form method="POST" action="./handlers/handle_contact_us.php">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="mb-3">
                            <label for="name" class="form-label text-secondary">Имена</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary">Имейл</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?? '' ?>">
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="message" class="form-label text-secondary">Съобщение</label>
                        <textarea class="form-control" id="message" rows="4" name="message"><?php echo $message ?? '' ?></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Изпрати</button>
                </form>
            </div>
        </div>
    </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="card border-0 shadow-sm p-0" style="height: 400px;">
                <img src="uploads/contactus.jpg" alt="Contact Us" class="card-img h-100 w-100 object-fit-cover">
            </div>
        </div>

    </div>
</div>