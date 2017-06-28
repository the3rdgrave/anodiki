$("#roomselect").change(function() {
  var sel=$("#roomselect option:selected" ).text();
  // alert(sel);
  if (sel!="ΟΛΑ"){
  $('#workshoteltable .work:not(.'+sel+')').hide();
  $('#workshoteltable .work.'+sel).show();
}
else {
  $('#workshoteltable .work').show();
}
});
