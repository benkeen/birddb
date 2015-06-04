$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();

  $(".numBirdsBtn").on("click", function (e) {
    var selected = $(e.target).data("value");
    if (selected === 'single') {
      $("#single-bird").removeClass("hidden");
      $("#multiple-birds").addClass("hidden");
      $("#numBirds-single-btn").removeClass("btn-unselected").addClass("btn-info");
      $("#numBirds-multiple-btn").removeClass("btn-info").addClass("btn-unselected");
      $("#species").focus();
    } else {
      $("#single-bird").addClass("hidden");
      $("#multiple-birds").removeClass("hidden");
      $("#numBirds-single-btn").addClass("btn-unselected").removeClass("btn-info");
      $("#numBirds-multiple-btn").addClass("btn-info").removeClass("btn-unselected");
    }
    $("#numBirds").val(selected);
  });

  // initialize the species typeahead field, and supply the onSelect callback
  utils.speciesTypeahead("#species", function (item) {
    $("#speciesId").val(item.value);
    $("#speciesName").val(item.text);
    $("#single-birds-extra-questions,#extra-questions").removeClass("hidden");
  });
});
