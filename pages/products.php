<?php


    // страница продукти
    $tickets = [];

    // заявка към базата данни
    if (!empty($search)) {
        $query = "SELECT t.*, 
            CASE WHEN pt.id IS NOT NULL THEN 1 ELSE 0 END as is_purchased 
            FROM tickets t 
            LEFT JOIN purchased_tickets pt 
                ON t.id = pt.ticket_id 
                AND pt.user_id = :user_id 
            WHERE t.start_destination LIKE :search1 
            OR t.arrival_destination LIKE :search2";
        $stmt = $pdo->prepare($query);
        $params = [
            ':search1' => "%$search%",
            ':search2' => "%$search%",
            ':user_id' => $_SESSION['user_id'] ?? 0
        ];
        $stmt->execute($params);
    } else {
        $query = "SELECT t.*, 
            CASE WHEN pt.id IS NOT NULL THEN 1 ELSE 0 END as is_purchased 
            FROM tickets t 
            LEFT JOIN purchased_tickets pt 
                ON t.id = pt.ticket_id 
                AND pt.user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':user_id' => $_SESSION['user_id'] ?? 0]);
    }
    
    while ($row = $stmt->fetch()) {
        $tickets[] = $row;
    }

    /*while ($row = $stmt->fetch()) {
        $fav_query = "SELECT id FROM favorite_products_users WHERE user_id = :user_id AND product_id = :product_id";
        $fav_stmt = $pdo->prepare($fav_query);
        $fav_params = [
            ':user_id' => $_SESSION['user_id'] ?? 0,
            ':product_id' => $row['id']
        ];
        $fav_stmt->execute($fav_params);
        $row['is_favorite'] = $fav_stmt->fetch() ? '1' : '0';

        $tickets[] = $row;
    }*/
?>

<div class="row">
    <form class="mb-4" method="GET">
        <div class="input-group">
            <input type="hidden" name="page" value="products">
            <input type="text" class="form-control" placeholder="Търси полет" name="search" value="<?php echo $search ?? '' ?>">
            <button class="btn btn-primary" type="submit">Търсене</button>
        </div>
    </form>
</div>


<div class="table-responsive">

<?php 
    if (is_admin()) 
    { 
        echo '<a href="?page=add_product" class="btn btn-success w-100 mb-3">
            <i class="bi bi-plus-circle me-2"></i>Добави полет
        </a>';
    } 
?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">От</th>
                <th class="text-center">До</th>
                <th class="text-center">Час на излитане</th>
                <th class="text-center">Час на кацане</th>
                <th class="text-center">Продължителност</th>
                <th class="text-center">Цена</th>
                <th class="text-center">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($tickets) === 0) {
                echo '<tr><td colspan="7" class="text-center">Няма намерени полети</td></tr>';
            } else {
                foreach ($tickets as $ticket) {
                    $start_time = new DateTime($ticket['start_time']);
                    $arrival_time = new DateTime($ticket['arrival_time']);
                    $duration = $arrival_time->diff($start_time);
                    
                    $actions = '';
                    
                    // Favorite button for logged in users
                    // if (isset($_SESSION['user_name'])) {
                    //     if ($ticket['is_favorite'] == '1') {
                    //         $actions .= '
                    //             <button type="button" class="btn btn-sm btn-danger remove-product" data-product="' . $ticket['id'] . '">Премахни от любими</button>
                    //         ';
                    //     } else {
                    //         $actions .= '
                    //             <button type="button" class="btn btn-sm btn-primary add-product" data-product="' . $ticket['id'] . '">Добави в любими</button>
                    //         ';
                    //     }
                    // }

                    if (isset($_SESSION['user_name'])) {
                        if ($ticket['is_purchased'] == '1') {
                            $actions .= '
                                <button type="button" class="btn btn-sm btn-success unbuy-ticket" 
                                        data-ticket="' . $ticket['id'] . '">
                                    Закупен билет
                                </button>
                            ';
                        } else {
                            $actions .= '
                                <button type="button" class="btn btn-sm btn-primary buy-ticket" 
                                        data-ticket="' . $ticket['id'] . '" 
                                        data-price="' . $ticket['price'] . '">
                                    Купи билет
                                </button>
                            ';
                        }
                    }

                    // Admin buttons
                    if (is_admin()) 
                    {
                        $actions .= '
                            <a class="btn btn-sm btn-warning ms-2" href="?page=edit_product&id=' . $ticket['id'] . '">Редактирай</a>
                            <form class="d-inline ms-2" method="POST" action="./handlers/handle_delete_product.php">
                                <input type="hidden" name="id" value="' . $ticket['id'] . '">
                                <button type="submit" class="btn btn-sm btn-danger">Изтрий</button>
                            </form>
                        ';
                    }

                    echo '
                    <tr>
                        <td class="text-center">' . htmlspecialchars($ticket['start_destination']) . '</td>
                        <td class="text-center">' . htmlspecialchars($ticket['arrival_destination']) . '</td>
                        <td class="text-center">' . $start_time->format('d.m.Y H:i') . '</td>
                        <td class="text-center">' . $arrival_time->format('d.m.Y H:i') . '</td>
                        <td class="text-center">' . $duration->format('%H:%I') . ' часа</td>
                        <td class="text-center">' . number_format($ticket['price'], 2) . ' лв.</td>
                        <td class="text-center">' . $actions . '</td>
                    </tr>';
                }
            }
            ?>
        </tbody>
    </table>


<!-- Buy Ticket Modal -->
<div class="modal fade" id="buyTicketModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Купи билет</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Цена: <span id="ticketPrice"></span> лв.</p>
                <div class="mb-3">
                    <label>Промо код:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="promoCode">
                        <button class="btn btn-secondary" type="button" id="validatePromo">Провери</button>
                    </div>
                </div>
                <div id="discountMessage" class="alert d-none"></div>
                <p class="fw-bold mt-3">Крайна цена: <span id="finalPrice"></span> лв.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отказ</button>
                <button type="button" class="btn btn-primary" id="confirmPurchase">Потвърди</button>
            </div>
        </div>
    </div>
</div>
        </div>

        <script>
$(document).ready(function() {
    $('.buy-ticket').click(function() {
        const ticketId = $(this).data('ticket');
        const price = $(this).data('price');
        
        $('#ticketPrice').text(price.toFixed(2));
        $('#finalPrice').text(price.toFixed(2));
        $('#promoCode').val('');
        $('#discountMessage').addClass('d-none');
        $('#confirmPurchase').data('ticket-id', ticketId);
        $('#confirmPurchase').data('original-price', price);
        
        $('#buyTicketModal').modal('show');
    });

    $('#validatePromo').click(function() {
        const code = $('#promoCode').val();
        const originalPrice = $('#confirmPurchase').data('original-price');
        
        if (code) {
            $.post('./ajax/validate_promo.php', {code: code}, function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    const discount = result.data.discount;
                    const finalPrice = originalPrice * (1 - discount/100);
                    $('#discountMessage')
                        .removeClass('d-none alert-danger')
                        .addClass('alert-success')
                        .text('Намерен промо код! Отстъпка: ' + discount + '%');
                    $('#finalPrice').text(finalPrice.toFixed(2));
                } else {
                    $('#discountMessage')
                        .removeClass('d-none alert-success')
                        .addClass('alert-danger')
                        .text('Невалиден промо код!');
                }
            });
        }
    });

    $('#confirmPurchase').click(function() {
        const ticketId = $(this).data('ticket-id');
        const promoCode = $('#promoCode').val();

        $.post('./ajax/add_favorite_product.php', {
            ticket_id: ticketId,
            promo_code: promoCode
        }, function(response) {
            const result = JSON.parse(response);
            $('#buyTicketModal').modal('hide');
            
            if (result.success) {
                location.reload();
            } else {
                alert(result.error);
            }
        });
    });

    $('.unbuy-ticket').click(function() {
        const ticketId = $(this).data('ticket');
        $.post('./ajax/remove_favorite_product.php', {
            ticket_id: ticketId
        }, function(response) {
            const result = JSON.parse(response);
            if (result.success) {
                location.reload();
            } else {
                alert(result.error);
            }
        });
    });
});
</script>