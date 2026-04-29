<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - <?= esc($order['order_no']) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Inter", sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        .receipt {
            width: 320px;
            margin: auto;
            background: #fff;
            padding: 18px;
            color: #111;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 1px dashed #999;
            padding-bottom: 12px;
            margin-bottom:12px;
        }

        .receipt-header img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }

        .receipt-header h2 {
            margin: 0 0 2px;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
        }

        .receipt-header p {
            margin: 2px 0;
            font-size: 12px;
        }

        .receipt-info {
            font-size: 12px;
            border-bottom: 1px dashed #999;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .receipt-info div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th {
            text-align: left;
            border-bottom: 1px dashed #999;
            padding-bottom: 6px;
        }

        td {
            padding: 6px 0;
            border-bottom: 1px dashed #ddd;
        }

        td:last-child,
        th:last-child {
            text-align: right;
        }

        .summary {
            margin-top: 10px;
            font-size: 12px;
        }

        .summary div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .grand-total {
            font-size: 15px;
            font-weight: bold;
            border-top: 1px dashed #999;
            padding-top: 8px;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            border-top: 1px dashed #999;
            margin-top: 14px;
            padding-top: 10px;
            font-size: 12px;
        }

        .print-btn {
            display: block;
            width: 320px;
            margin: 15px auto;
            border: none;
            background: #2B1B17;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .print-btn {
                display: none;
            }

            .receipt {
                width: 80mm;
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
</head>

<body>

<button class="print-btn" onclick="window.print()">Print Receipt</button>

<div class="receipt">
    <div class="receipt-header">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Kofi Co.">
        <h2><?= esc($appSettings['restaurant_name']) ?></h2>
<p><?= esc($appSettings['address']) ?></p>
<p><?= esc($appSettings['phone']) ?></p>
        <p>Thank you for your order</p>
    </div>

    <div class="receipt-info">
        <div>
            <span>Order No:</span>
            <strong><?= esc($order['order_no']) ?></strong>
        </div>

        <div>
            <span>Date:</span>
            <strong><?= date('d M Y h:i A', strtotime($order['created_at'])) ?></strong>
        </div>

        <div>
            <span>Cashier:</span>
            <strong><?= esc($order['cashier_name'] ?? 'N/A') ?></strong>
        </div>

        <div>
            <span>Payment:</span>
            <strong><?= esc($payment['payment_method'] ?? 'N/A') ?></strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['item_name']) ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td><?= esc($appSettings['currency']) ?> <?= number_format($item['price'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <div>
            <span>Subtotal</span>
            <strong><?= number_format($order['subtotal'], 2) ?></strong>
        </div>

        <div>
            <span>Discount</span>
            <strong><?= number_format($order['discount'], 2) ?></strong>
        </div>

        <div>
            <span>Tax</span>
            <strong><?= number_format($order['tax'], 2) ?></strong>
        </div>

        <div class="grand-total">
            <span>Total</span>
            <strong><?= number_format($order['grand_total'], 2) ?></strong>
        </div>
    </div>

    <div class="footer">
        <p>Powered by Kofi Co.</p>
        <p>Visit again ☕</p>
    </div>
</div>

</body>
</html>