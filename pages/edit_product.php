<?php
    $id = intval($_GET['id'] ?? 0);
    $query = "SELECT * FROM tickets WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);
    $ticket = $stmt->fetch();
?>

<form class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_edit_product.php">
    <h3 class="text-center">Редактирай полет</h3>
    <div class="mb-3">
        <label for="start_destination" class="form-label">Начална дестинация:</label>
        <input type="text" class="form-control" id="start_destination" name="start_destination" 
               value="<?php echo $ticket['start_destination'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="arrival_destination" class="form-label">Крайна дестинация:</label>
        <input type="text" class="form-control" id="arrival_destination" name="arrival_destination" 
               value="<?php echo $ticket['arrival_destination'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="start_time" class="form-label">Час на излитане:</label>
        <input type="datetime-local" class="form-control" id="start_time" name="start_time" 
               value="<?php echo date('Y-m-d\TH:i', strtotime($ticket['start_time'])) ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="arrival_time" class="form-label">Час на кацане:</label>
        <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" 
               value="<?php echo date('Y-m-d\TH:i', strtotime($ticket['arrival_time'])) ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Цена:</label>
        <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" 
               value="<?php echo $ticket['price'] ?? '' ?>">
    </div>
    <input type="hidden" name="id" value="<?php echo $ticket['id'] ?>">
    <button type="submit" class="btn btn-success mx-auto">Редактирай</button>
</form>