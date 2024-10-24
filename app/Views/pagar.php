<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal</title>
</head>
<body>
    <div>
        <h1>Pague el turno</h1>
        <p>El total es de: U$D 5</p>
    </div>
    <div id="paypal-button-container" class="pay">
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
                    window.location.href = 'pagina';
                });
            },
            onCancel: function(data) {
                window.location.href = '';
            }
}).render('#paypal-button-container');
    </script>
</body>
</html>