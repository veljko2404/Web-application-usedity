$(document).ready(function () {
  $("#modelcar").change(function () {
    var valModel = $(this).val();
    $("#model").text(valModel);
  });
});
$(document).ready(function () {
  $("#year_s").change(function () {
    var valYear = $(this).val();
    $("#year").text(valYear);
  });
});
$(document).ready(function () {
  $("#price_s").change(function () {
    var valPrice = $(this).val();
    $("#price").text(valPrice);
  });
});
$(document).ready(function () {
  $("#desc_s").change(function () {
    var valDesc = $(this).val();
    $("#desc").text(valDesc);
  });
});
$(document).ready(function () {
  $("#fuel_s").change(function () {
    var valFuel = $(this).val();
    $("#fuel").text(valFuel);
  });
});
$(document).ready(function () {
  $("#mileage_s").change(function () {
    var valMileage = $(this).val();
    $("#mileage").text(valMileage);
  });
});
$(document).ready(function () {
  $("#doors_s").change(function () {
    var valDoors = $(this).val();
    $("#doors").text(valDoors);
  });
});
$(document).ready(function () {
  $("#state_s").change(function () {
    var valState = $(this).val();
    $("#tip").text(valState);
  });
});
