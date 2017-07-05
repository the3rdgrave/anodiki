$(".roomselect").click(function() {
  var date=this.id;
  var room= $(this).text();
  rowspan=$(this).closest("td").attr("id");
  // alert(sel);
  if (room!="ΟΛΑ"){
  $('#workshoteltable .work.'+date+':not(.'+room+')').hide();
  $('#workshoteltable .work.'+date+'.'+room).show();

  hidden=$('#workshoteltable tr:hidden').length;
  // alert(hidden);
  rowspan-=hidden;
  $(this).closest("td").attr('rowspan', rowspan);
}
else {
  $('#workshoteltable .work.'+date).show();
  $(this).closest("td").attr('rowspan', rowspan);

}
});
