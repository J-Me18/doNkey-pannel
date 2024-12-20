<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

<div class="loader-container" style="display:none;">
    <div class="loader"></div>
</div>
@php
    $site = App\Models\site::where('id', 1)->first();
@endphp
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    // Function to show the loader
    function showLoader() {
        $('.loader-container').show();
        $('.wrapper').addClass('blur');
    }

    // Function to hide the loader
    function hideLoader() {
        $('.loader-container').hide();
        $('.wrapper').removeClass('blur');
    }

    var options = {
        "key": "rzp_live_kplCTSQUdMA2Gw",
        "amount": "<?php echo $amount * 100; ?>",
        "currency": "INR",
        "name": "{{ $subscriber[0]->name }}",
        "description": "",
        "image": "{{ url('public/site/' . $site->main_logo) }}",
        "callback_url": "https://donkeydeliveries.com/donkey/subscribers/login",
        "handler": function(response) {
            // Hide the loader when payment is completed          

            $.ajax({
                url: "{{ url('successfullypayment') }}/{{ $subscriber[0]->subscriberId }}",
                method: 'get',
                data: {
                    response: response,
                    amount: options.amount
                },
                success: function(Response) {
                    hideLoader();
                    console.log(Response);
                    if (Response.payment_id != "") {
                        // Add a slight delay before showing the alert
                        setTimeout(function() {
                            swal({
                                    title: "Payment Successful",
                                    text: "Payment Successful",
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        window.location = "{{ url('successpay') }}";
                                    } else {
                                        swal(
                                            "Payment Pending. You Cannot Login. Please Contact Admin"
                                        );
                                    }
                                });
                        }, 100); // 100 milliseconds delay
                    }
                }
            });
        },
        "prefill": {
            "name": "Gaurav Kumar",
            "email": "gaurav.kumar@example.com",
            "contact": "9000090000"
        },
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function(response) {
        hideLoader(); // Hide loader on payment failure
        alert("There is some error in proceeding. Please refresh the page and continue.");
    });

    // Show the loader when opening the payment gateway
    showLoader();
    rzp1.open();
</script>

<style>
    /* Loader styles */
    .loader {
        width: 40px;
        height: 20px;
        --c: no-repeat radial-gradient(farthest-side, #000 93%, #0000);
        background: var(--c) 0 0, var(--c) 50% 0, var(--c) 100% 0;
        background-size: 8px 8px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: l4-0 1s linear infinite alternate;
        z-index: 9999;
    }

    .loader:before {
        content: "";
        position: absolute;
        width: 8px;
        height: 12px;
        background: #000;
        left: 0;
        top: 0;
        animation: l4-1 1s linear infinite alternate, l4-2 0.5s cubic-bezier(0, 200, .8, 200) infinite;
    }

    @keyframes l4-0 {
        0% {
            background-position: 0 100%, 50% 0, 100% 0;
        }

        8%,
        42% {
            background-position: 0 0, 50% 0, 100% 0;
        }

        50% {
            background-position: 0 0, 50% 100%, 100% 0;
        }

        58%,
        92% {
            background-position: 0 0, 50% 0, 100% 0;
        }

        100% {
            background-position: 0 0, 50% 0, 100% 100%;
        }
    }

    @keyframes l4-1 {
        100% {
            left: calc(100% - 8px);
        }
    }

    @keyframes l4-2 {
        100% {
            top: -0.1px;
        }
    }

    /* Loader container */
    .loader-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Blur effect */
    .blur {
        filter: blur(5px);
        transition: filter 0.3s ease;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loader = document.getElementById('loader');

        // Hide the loader after the page is fully loaded
        window.addEventListener('load', function() {
            loader.style.display = 'none';
        });

        // Optional: If you want to hide the blur effect on the main content
        const content = document.querySelector('.blur');
        if (content) {
            loader.addEventListener('transitionend', function() {
                content.style.filter = 'none';
            });
        }
    });
</script>
