$(".roomselect").click(function() {
  var date=this.id;
  var room= $(this).text();
  // alert(sel);
  if (room!="ΟΛΑ"){
  $('#workshoteltable .work.'+date+':not(.'+room+')').hide();
  $('#workshoteltable .work.'+date+'.'+room).show();
}
else {
  $('#workshoteltable .work.'+date).show();
}
});
