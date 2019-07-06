$('#payment-form').on('submit', function () {
  var self = $(this),
    button = self.find('button[type="button"], button');
  button.attr('disabled', 'disabled').val('Please wait...');
  return false;
});