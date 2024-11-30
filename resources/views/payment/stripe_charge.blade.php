<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
</head>

<body>
    <script src="https://js.stripe.com/v3"></script>
    <script type="text/javascript">
        var session_id = '{{ $session_id }}';
        var stripe = Stripe('{{ $setPublicKey }}');
        stripe.redirectToCheckout({
            sessionId: session_id
        }).then(function(result) {});
    </script>

    <!-- You can customize this view further with additional information or a thank you message. -->
</body>

</html>
