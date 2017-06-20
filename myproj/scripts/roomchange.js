$("#roomselect").change(function() {
  var sel=$("#roomselect option:selected" ).text();
  // alert(sel);
  $('#maintaintable .work:not(.'+sel+')').hide();
  $('#maintaintable .work.'+sel).show();
});

$("#tablegone").click(function() {

    $('.maintaintable tr').hide();
    $('#tablegone').hide();

});
