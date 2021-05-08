$(function () {
  var $stripeForm = $(".form-validation");
  $('form.form-validation').bind('submit', function (e) {
    var $stripeForm = $(".form-validation"),
      inputSelector = ['input[type=email]', 'input[type=password]',
        'input[type=text]', 'input[type=file]',
        'textarea'
      ].join(', '),
      $inputs = $stripeForm.find('.required').find(inputSelector),
      $errorMessage = $stripeForm.find('div.error'),
      valid = true;
    $errorMessage.addClass('hide');

    $('.has-error').removeClass('has-error');
    $inputs.each(function (i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });

    if (!$stripeForm.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }

  });

  function stripeResponseHandler(status, res) {
    if (res.error) {
      $('.error')
        .removeClass('hide')
        .find('.alert')
        .text(res.error.message);
    } else {
      var token = res['id'];
      $stripeForm.find('input[type=text]').empty();
      $stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
      $stripeForm.get(0).submit();
    }
  }

});