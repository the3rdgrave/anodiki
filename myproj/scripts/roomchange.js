$(".roomselect").click(function() {
  var room= $(this).text();
  // alert(sel);
  if (room!="ΟΛΑ"){
  $('#workshoteltable .work:not(.'+room+')').hide();
  $('#workshoteltable .work.'+room).show();
}
else {
  $('#workshoteltable .work').show();
}
});
