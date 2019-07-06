$('#payment-form').on('submit', function () {
  var form = document.getElementById('payment-form');
  var isValid = form.checkValidity();
  console.log(isValid);
  var self = $(this),
    button = self.find('button[type="button"], button');
  button.attr('disabled', 'disabled');
  return false;
});
