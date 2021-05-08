<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Billing Address</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($customers as $customer) { ?>
        <tr>
            <td><a href="/orders/show/<?= $customer['customer_id']?>"><?= $customer['customer_id']?></a></td>
            <td><?= $customer['ordered_fullname']?></td>
            <td><?= $customer['ordered_date']?></td>
            <td><?= $customer['billing_address']?></td>
            <td>₱<?= $customer['final_total_price']?></td>
            <td>
            <form action="/admins/update_status/<?= $customer['customer_id'] ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <select class='form-control' name="order_status_id">
                    <option value="<?= $customer['order_status_id']?>" selected>-- <?= $customer['status_name'] ?> --</option>
<?php   foreach($orders_status as $status) { ?>
                    <option value="<?= $status['id'] ?>"><?= $status['status_name'] ?></option>
<?php   } ?>   
                </select>
                <input class='btn btn-info mt-1' type="submit" value="Update">  
            </form>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>
<br>
<p class='pagination'><?= $this->pagination->create_links(); ?></p>