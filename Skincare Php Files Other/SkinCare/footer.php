<!-- == FOOTER == -->
<footer>
            <div class="footer-container container ">
                <div class="footer-col col-1 ">
                    <a class="footer-logo" href="#"><img src="assets/img/Skin care footer logo.png" alt="Skin Care logo" width="280px">
                        </a>
                    <p class="col-1-p">Alternative skin care products<br> good for your skin.</p>
                    <div class="footer-social-icons">
                        <a href="#"><i class="fab fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-brands fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-col col-2 ">
                    <h4>COMPANY</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Learn</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col col-3 ">
                    <h4>OTHER MENU</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
                <div class="footer-col footer-col-4 ">
                    <h4>SUPPORT</h4>
                    <ul>
                        <li><i class="fas fa-solid fa-phone"></i> +254 715 925 156</li>
                        <li><i class="fas fa-solid fa-envelope"></i> skincare@info.com</li>
                        <li><i class="fas fa-solid fa-map-marker-alt"></i> Nairobi City</li>
                    </ul>
                </div>
            </div>
            <div class="footer-copyright container ">
                <p>Copyright &copy; 2022 All rights reserved</p>
            </div>
        </footer>
    <!-- == || FOOTER == -->
    <!-- == Cursor == -->
    <!-- <div class="cursor"><i class="fa-solid fa-location-arrow"></i></div> -->

    <!-- == To TOP == -->
        <a class="to-top " onclick="topFunction()" href="#header-top"><i class="fas fa-solid fa-chevron-up"></i></a>
    <!-- == To TOP == -->

    <!-- == Script == -->
    <script src="assets/js/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="assets/js/jquery-2.2.4.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="https://js.stripe.com/v2/"></script>
	<script src="assets/js/megamenu.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="assets/js/owl.animate.js"></script>
	<script src="assets/js/jquery.bxslider.min.js"></script>
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/js/rating.js"></script>
	<script src="assets/js/jquery.touchSwipe.min.js"></script>
	<script src="assets/js/bootstrap-touch-slider.js"></script>
	<script src="assets/js/select2.full.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		function confirmDelete()
		{
			return confirm("Sure you want to delete this data?");
		}
		$(document).ready(function () {
			advFieldsStatus = $('#advFieldsStatus').val();

			$('#paypal_form').hide();
			$('#stripe_form').hide();
			$('#bank_form').hide();

			$('#advFieldsStatus').on('change',function() {
				advFieldsStatus = $('#advFieldsStatus').val();
				if ( advFieldsStatus == '' ) {
					$('#paypal_form').hide();
					$('#stripe_form').hide();
					$('#bank_form').hide();
				} else if ( advFieldsStatus == 'PayPal' ) {
					$('#paypal_form').show();
					$('#stripe_form').hide();
					$('#bank_form').hide();
				} else if ( advFieldsStatus == 'Stripe' ) {
					$('#paypal_form').hide();
					$('#stripe_form').show();
					$('#bank_form').hide();
				} else if ( advFieldsStatus == 'Bank Deposit' ) {
					$('#paypal_form').hide();
					$('#stripe_form').hide();
					$('#bank_form').show();
				}
			});
		});


		$(document).on('submit', '#stripe_form', function () {
			// createToken returns immediately - the supplied callback submits the form if there are no errors
			$('#submit-button').prop("disabled", true);
			$("#msg-container").hide();
			Stripe.card.createToken({
				number: $('.card-number').val(),
				cvc: $('.card-cvc').val(),
				exp_month: $('.card-expiry-month').val(),
				exp_year: $('.card-expiry-year').val()
				// name: $('.card-holder-name').val()
			}, stripeResponseHandler);
			return false;
		});
		Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');
		function stripeResponseHandler(status, response) {
			if (response.error) {
				$('#submit-button').prop("disabled", false);
				$("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
				$("#msg-container").show();
			} else {
				var form$ = $("#stripe_form");
				var token = response['id'];
				form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
				form$.get(0).submit();
			}
		}
	</script>
</body>
</html>