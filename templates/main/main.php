<?php include __DIR__ . '/../header.php'; ?>

<div class="main">
    <div class="container">
        <div class="heading">
            <h1>Терминал заказа пиццы</h1>
        </div>
        <form id="pizzaTerminal" method="post">
            <label for="pizza">Пиццы</label>
            <select id="pizza" name="pizza">
                <?php foreach ($pizzas as $pizza): ?>
                    <option value="<?= $pizza->getId() ?>"><?= $pizza->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="size">Размер</label>
            <select id="size" name="size">
                <?php foreach ($sizes as $size): ?>
                    <option value="<?= $size->getId() ?>"><?= $size->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="sauce">Соус</label>
            <select id="sauce" name="sauce">
                <?php foreach ($sauces as $sauce): ?>
                    <option value="<?= $sauce->getId() ?>"><?= $sauce->getName() ?></option>
                <?php endforeach; ?>
            </select>
            <div id="receipt"></div>
            <input class="btn" type="submit" name="send" value="Заказать">
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#pizzaTerminal').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/order/create',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.error) {
                        alert('Ошибка при заказе: ' + response.error);
                    } else {
                        $('#receipt').html(response.receipt);
                    }
                },
                error: function(xhr, status, error) {
                    let errorMsg = 'Неизвестная ошибка';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMsg = response.error || 'Неизвестная ошибка';
                    } catch (e) {
                        errorMsg = 'Не удалось обработать ответ сервера';
                    }
                    alert('Ошибка при заказе: ' + errorMsg);
                }
            });

        });
    });
</script>
<?php include __DIR__ . '/../footer.php'; ?>