<form id="paymentForm">
    <input type="hidden" id="email-address" value="{{ $email }}">
    <input type="hidden" id="amount" required value="{{ $amount }}" />
    <button class="btn btn-primary mt-3" type="submit" onclick="payWithPaystack()">
        {{__('Make Payment')}}
    </button>
</form>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    function payWithPaystack(e) {
        e.preventDefault();
        let handler = PaystackPop.setup({
            key: '{{ config('app.PK_PUBLIC') }}', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
            // label: "Optional string that replaces customer email"
            onClose: function(){
                alert('Window closed.');
            },
            callback: function(response){
                let message = 'Payment complete! Reference: ' + response.reference;
                alert(message);
                window.location ='/usr/booking/successful-payment/' + response.reference
            }
        });
        handler.openIframe();
    }
</script>
