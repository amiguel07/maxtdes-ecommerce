<!DOCTYPE html>
<html>
<head>
    <title>Voucher de compra</title>
</head>
<body>
    <h2>Gracias por tu compra</h2>
    <p>Adjunto encontrarás detalles de tu compra.</p>
    <h3>Contenido</h3>
    <p>{{ $order->content }}</p>
    <h3>Envio</h3>
    <p>S/. {{ $order->shipping_cost }}</p>
    <p>{{ $order->envio }}</p>
    <h3>Total</h3>
    <p>{{ $order->total }}</p>
    <br>
    <p>Maxtdes</p>
</body>
</html>