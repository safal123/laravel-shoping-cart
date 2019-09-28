$('#payment-form').on('submit', function () {
  var form = document.getElementById('payment-form');
  var isValid = form.checkValidity();
  console.log(isValid);
  var self = $(this),
    button = self.find('button[type="button"], button');
  button.attr('disabled', 'disabled');
  return false;
});

// $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });

// $(".product-create").click(function(e) {
//   e.preventDefault();
//   alert('I am clicked.');
// });


