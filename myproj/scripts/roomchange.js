

$("#roomselect").change(function() {
  var sel=$("#roomselect option:selected" ).text();
  // alert(sel);
  if (sel!="ΟΛΑ"){
  $('#maintaintable .work:not(.'+sel+')').hide();
  $('#maintaintable .work.'+sel).show();
}
else {
  $('#maintaintable .work').show();
}
});
