$(document).ready(function() {
    $price = $('#price').val();
})

paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
        sandbox: 'ATdLwCnmk4QOjLGuyaPvBVsdw7-4VZD550fppzEUzW7vvEta_qzDG8uAbC1euta2_KO_OSgyCzC0Axva',
        production: 'AbYjwkg8azsxsMkKr4g0FhrSked9Y-YpKU-8DqKXTgeERmHcHOI7gaJ3TKarghJqC3kGtii2m09v412A'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
        size: 'medium',
        color: 'gold',
        shape: 'pill',
        label: 'paypal',
        responsive: 'Dynamic'
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
        return actions.payment.create({

            redirect_urls: {
                return_url: 'http://cellorecording-local.test/execute_payment'
            },

            transactions: [{
                amount: {
                    total: $price,
                    currency: 'EUR'
                }
            }]
        });
    },


    // Execute the payment
    onAuthorize: function(data, actions) {
        // console.log(actions.redirect);

        return actions.redirect();
    }


}, '#paypal_button');