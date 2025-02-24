<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stripe Checkout</title>
</head>
<body>
    <script src="http://js.stripe.com/v3"></script>
    <script>
        var session_id = '{{ $session_id }}';
        var stripe = Stripe('{{ $setPublickey }}');
            stripe.redirectToCheckout({
                sessionId: session_id
            }).then(function(result){
        });
    </script>
</body>
</html>
