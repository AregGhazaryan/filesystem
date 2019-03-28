// minor scripts fixing the pagination problem and file upload filename shortening
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  $(".custom-file-label").text(function(index, currentText) {
return currentText.substr(0, 25)+"...";
});
});
 $('.page-item').not(':hidden').last().addClass("hide");
//alert close button
 $("#close").click(function(){
   $('.alert').fadeOut("fast");
 });
