$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(".product-create").click(function (e) {
  e.preventDefault();
  $('.alert-danger').hide();
  $('.error').html('');
  $(".form-control").css("border-color", "green");
  $('.alert-danger').html('');
  var name = $("input[name=name]").val();
  var description = $("textarea[name=description]").val();
  var image = $("input[name=image]").val();
  var price = $("input[name=price]").val();
  var discount = $("input[name=discount]").val();
  var is_active = $("input[name=is_active]").val();

  $.ajax({
    type: 'POST',
    url: '/admin/products/create',
    data: {
      _token: "{{ csrf_token() }}",
      name: name,
      description: description,
      image: image,
      price: price,
      discount: discount,
      is_active: is_active
    },
    success: function (data) {
      alert(data.success);
    },
    error: function (request, status, error) {
      json = $.parseJSON(request.responseText);
      console.log(json);
      $.each(json.errors, function (key, value) {
        $('.alert-danger').show();
        if (key !== null && key == 'name') {
          $(".form-control").css("border-color", "red");
          $('.error').html(key.value).css('color', 'red');
        }
        $('.alert-danger').append('<p>' + value + '</p>');
      });
      $("#result").html('');
    }
  });
});