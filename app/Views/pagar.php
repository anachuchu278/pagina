<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/pay.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal</title>
</head>
<body>
    <div>
        <h1>Pague el turno</h1>
        <p>El total a pagar es de U$D 5</p> 
        <p>El costo del turno es sujeto a cambios basado en cuestiones de aumentos inflacionarios.</p>
    </div>
    <div id="paypal-button-container" class="pay"> 
    <div class="volver-container">
        <a href="pagina"class="volver">Volver</a>
    </div>
    <script src="https://sandbox.paypal.com/sdk/js?client-id=AWTpQqOfv58jLKzJ9VI8kpiN16ppP9ZVEORnY2M56R8gUe3Wyt4iHAez5ORX8p31PmKkzdz0SZEbxTwa"></script> 
    <script>
paypal.Buttons({
    style:{
    color:'blue',
    shape: 'pill',
    label: 'pay',
    tagline: 'false',
    layout: 'horizontal'
    },
    createOrder: function(data, actions){
    return actions.order.create({
        purchase_units: [{
        amount: {
            value: 5
        }
        }]
    })
    },
    onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    window.location.href = 'successpay';
                });
            },
            onCancel: function(data) {
                window.location.href = 'errorP';
            }
}).render('#paypal-button-container');
    </script>
</body>
</html>