<?php 
    /* Template Name: Woo Checkout Template */
    get_header();
?>
<style>
/* Common Colors */
:root {
    --primary-color: #102E43;
    --primary-color-light: #0055ff30;
    --background-color: #f7f8fa;
    --text-color: #102E43;
}

/*******GLOBAL STRUCTURAL LAYOUT*******/

.checkout-container {
    display: flex;
    margin-top: 2rem;
    flex-direction: column;
}


/* WooCommerce Layout Structure */
@media (min-width: 980px) {

    /* Billing Details Side */
    .checkout-container .woocommerce-checkout .col2-set,
    .checkout-container .woocommerce-checkout .woocommerce-page .col2-set {
        float: left;
        width: 55%;
    }

    /* Order Review Side */
    .checkout-container .woocommerce-checkout #order_review_heading,
    .checkout-container .woocommerce-checkout #order_review,
    .checkout-container .woocommerce-checkout .woocommerce-page #order_review {
        float: left;
        width: 43%;
        margin-left: 2%;
    }
}

@media (max-width: 979px) {

    /* Billing Details Margin */
    .checkout-container .woocommerce-checkout .col2-set,
    .checkout-container .woocommerce-checkout .woocommerce-page .col2-set {
        margin-bottom: 2em;
    }
}

/*******LEFT SIDE DESIGN*******/

/* Form Container Styles */
.checkout-container .woocommerce-checkout .col2-set,
.checkout-container .woocommerce-checkout .woocommerce-page .col2-set {
    background: white;
    padding: 1em 2em;
    border-radius: 1em;
    border: 1px solid #e4e4e4;
}

.checkout-container .col2-set .col-1,
.checkout-container .woocommerce-page .col2-set .col-1,
.checkout-container .col2-set .col-2,
.checkout-container .woocommerce-page .col2-set .col-2 {
    float: left;
    width: 100%;
}

/* Form Field Title Styles */
.checkout-container label,
.checkout-container input,
.checkout-container button,
.checkout-container select,
.checkout-container textarea {
    font-size: 14px;
    line-height: 1.7;
    text-transform: uppercase !important;
    font-weight: 500;
    color: var(--text-color);
    margin-bottom: 0.5em;
}

/* Form Field Styles */
.checkout-container input.text,
.checkout-container input.title,
.checkout-container input[type=email],
.checkout-container input[type=password],
.checkout-container input[type=tel],
.checkout-container input[type=text],
.checkout-container select,
.checkout-container textarea {
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    padding: 0.8rem 1rem;
    background-color: white;
}

.checkout-container .woocommerce-account form .form-row,
.checkout-container .woocommerce-checkout form .form-row {
    margin-bottom: 1em;
}

/* Form Field Dropdown Styles */
.checkout-container .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    height: 2.5em;
}

.checkout-container .select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 2.5em;
}

.checkout-container .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
    position: absolute;
    top: 1px;
    right: 5px;
    width: 25px;
}

.checkout-container .woocommerce-account form .payment_methods label,
.checkout-container .woocommerce-checkout form .payment_methods label {
    padding-left: 0px;
}

/* Form Field Focus Color Style */
.checkout-container textarea:focus,
.checkout-container input[type=text]:focus,
.checkout-container input[type=password]:focus,
.checkout-container input[type=datetime]:focus,
.checkout-container input[type=datetime-local]:focus,
.checkout-container input[type=date]:focus,
.checkout-container input[type=month]:focus,
.checkout-container input[type=time]:focus,
.checkout-container input[type=week]:focus,
.checkout-container input[type=number]:focus,
.checkout-container input[type=email]:focus,
.checkout-container input[type=url]:focus,
.checkout-container input[type=search]:focus,
.checkout-container input[type=tel]:focus,
.checkout-container input[type=color]:focus,
.checkout-container .uneditable-input:focus {
    border-color: var(--primary-color) !important;
    box-shadow: none;
    outline: 0;
}

.checkout-container .radio input[type=radio],
.checkout-container .checkbox input[type=checkbox] {
    top: 0px;
}

/*******RIGHT SIDE DESIGN*******/

/* Order Review Headline Removal */
.checkout-container h3#order_review_heading {
    display: none;
    /*Remove This if You Want The Order Review Heading*/
}

/* Order Review Container Styles */
.checkout-container div#order_review {
    background: white;
    padding: 2em;
    border-radius: 1em;
    box-shadow: 0 0.5em 2em rgba(0, 0, 0, 0.1);
    position: sticky;
    /*Remove This if You Don't Want Order Review To Be Sticky*/
    top: 100px;
    /*Remove This if You Don't Want Order Review To Be Sticky*/
}

/*Order Review Order*/

.checkout-container div#order_review {
    display: flex;
    flex-direction: column;
    /*Change this to column-reverse to reverse the order*/
}

/*Hide Cart Contents and Only Show Total + Shipping*/

.checkout-container .woocommerce-checkout-review-order tbody {
    display: table-row-group;
    /*Set to "none" if you'd like to hide */
}

/* Remove Product and Subtotal Headlines */
.checkout-container table.shop_table.woocommerce-checkout-review-order-table thead {
    display: none;
    /*Remove This if You Want Headlines*/
}

.checkout-container table.shop_table.woocommerce-checkout-review-order-table {
    color: var(--text-color);
    text-transform: Capitalize;
    font-size: 16px;
    /*Adjust This To Adjust Order Review Font Size*/
}

.checkout-container table.shop_table {
    border: none;
}

.checkout-container .woocommerce-info {
    background: white !important;
    margin-bottom: 1rem;
}

.checkout-container .woocommerce-info a {
    color: var(--bs-heading-color);
}

.checkout-container .woocommerce-billing-fields h3:first-child {
    display: none;
}

/* Target every other cart item and set background color */
.checkout-container tr.cart_item:nth-child(odd) {
    background-color: #fff !important;
}

.checkout-container tr.cart_item:nth-child(even) {
    background-color: white !important;
}

.checkout-container span.woocommerce-Price-amount.amount {
    font-weight: bold;
}


.checkout-container strong.product-quantity {
    background: var(--primary-color-light);
    padding: 0.1em 0.5em;
    border-radius: 0.5em;
    font-size: 14px;
}

.checkout-container td.product-name .wc-item-meta p,
.checkout-container td.product-name .wc-item-meta:last-child,
.checkout-container td.product-name dl.variation p,
.checkout-container td.product-name dl.variation:last-child {
    margin-bottom: 0;
    text-transform: capitalize;
    font-size: 14px;
    font-weight: normal;
    color: var(--text-color);
}

.checkout-container td.product-name {
    width: 100%;
    font-weight: bold;
}

.checkout-container td.product-total {
    justify-content: flex-start;
    display: flex;
}

.checkout-container table th,
.checkout-container table td {
    border: none !important;
}

.checkout-container tr.cart-subtotal {
    display: none;
    /*Remove this if you'd like to display the subtotal*/
}

.checkout-container tr.woocommerce-shipping-totals.shipping {
    display: flex;
    margin-top: 2em;
    margin-bottom: 2em;
    border-top: 1px solid var(--primary-color-light);
    border-bottom: 1px solid var(--primary-color-light);
    flex-direction: column;
    align-content: stretch;
    align-items: flex-start;
}

.checkout-container ul#shipping_method li input {
    margin: 5px 5px 0 0;
    vertical-align: top;
}

/* Order Total Line Item Styles */
.checkout-container tr.order-total {
    color: var(--primary-color);
    background-color: var(--primary-color-light);
}

.checkout-container #add_payment_method #payment,
.checkout-container .woocommerce-cart #payment,
.checkout-container .woocommerce-checkout #payment {
    background: var(--background-color);
    border-radius: 5px;
}

.checkout-container #add_payment_method #payment div.payment_box,
.checkout-container .woocommerce-cart #payment div.payment_box,
.checkout-container .woocommerce-checkout #payment div.payment_box {
    background-color: var(----primary-color);
    color: black;
}

.checkout-container #add_payment_method #payment div.payment_box::before,
.checkout-container .woocommerce-cart #payment div.payment_box::before,
.checkout-container .woocommerce-checkout #payment div.payment_box::before {
    display: none;
}

/* Stripe Form Field Styles */
.checkout-container .wc-stripe-elements-field,
.checkout-container .wc-stripe-iban-element-field {
    border: 1px solid #d9d9d9;
    border-radius: 5px;
    background-color: #fff;
    padding: 15px;
}

.checkout-container input#wc-stripe-new-payment-method {
    margin-right: 1em;
}

.checkout-container fieldset#wc-authnet-cc-form .input-text {
    height: 2em;
}

/* Place Order Button Styles */
.checkout-container #place_order {
    width: 100%;
    color: #fff;
    border: none;
    box-shadow: rgba(0, 0, 0, 0.28) 0px 2px 8px 0px;
    padding: 1.5em;
    background: var(--primary-color);
    /* Change This to Change Button Color */
}

.checkout-container #place_order:hover {
    color: rgba(255, 255, 255, 0.5);
}

/*******COUPON & ALERT STYLES*******/

.checkout-container .woocommerce-info,
.checkout-container .woocommerce-message {
    background-color: var(--background-color);
    color: var(--text-color);
    border: none;
}

.checkout-container .checkout_coupon p.form-row.form-row-last {
    float: none;
}

.checkout-container .checkout_coupon button.button {
    background-color: var(--primary-color);
    color: white;
}

/* Coupon Icon */
.checkout-container .woocommerce-info::before,
.checkout-container .woocommerce-error::before {
    display: none;
}

.checkout-container .woocommerce-error,
.checkout-container .woocommerce-info,
.checkout-container .woocommerce-message {
    padding: 1em;
}

.checkout-container form.checkout_coupon.woocommerce-form-coupon {
    padding: 3em;
    background: white;
    border-radius: 1em;
    margin-top: 0em;
    margin-bottom: 2em;
}

/* Error Alert */
.checkout-container .woocommerce-error {
    background-color: #ff7e7e;
    border: none;
    color: #761f1f;
}

.checkout-container .woocommerce-error,
.checkout-container .woocommerce-info,
.checkout-container .woocommerce-message {
    text-shadow: none;
}

@media screen and (max-width: 550px) {

    .woo-checkout-container .title h1 {
        font-size: 30px;
    }

    .checkout-container .woocommerce-checkout .col2-set,
    .checkout-container .woocommerce-checkout .woocommerce-page .col2-set {
        padding: 1em;
    }

    .checkout-container div#order_review {
        padding: 1em;
    }
}
</style>

<section class="woo-login-container woo-checkout-container ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title text-align-center">
                    <h1>
                        <?php 
                        if (is_order_received_page()) {
                            echo 'ORDER RECEIVED';
                        } else {
                            echo 'CHECKOUT';
                        }
                        ?>
                    </h1>
                </div>
            </div>
            <div class="checkout-container">
                <?php echo do_shortcode('[woocommerce_checkout]'); ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>