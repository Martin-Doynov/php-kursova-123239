<?php
if (!is_admin()) {
    header('Location: index.php');
    exit;
}
?>

<form class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_add_product.php">
    <h3 class="text-center">Добави полет</h3>
    <div class="mb-3">
        <label for="start_destination" class="form-label">Начална дестинация:</label>
        <input type="text" class="form-control" id="start_destination" name="start_destination" required>
    </div>
    <div class="mb-3">
        <label for="arrival_destination" class="form-label">Крайна дестинация:</label>
        <input type="text" class="form-control" id="arrival_destination" name="arrival_destination" required>
    </div>
    <div class="mb-3">
        <label for="start_time" class="form-label">Час на излитане:</label>
        <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
    </div>
    <div class="mb-3">
        <label for="arrival_time" class="form-label">Час на кацане:</label>
        <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Цена:</label>
        <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" required>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto">Добави</button>
</form>