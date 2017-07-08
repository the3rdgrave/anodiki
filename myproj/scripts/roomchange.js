$(".roomselect").click(function() {
  var date=this.id;
  // var room= $(this).text();
  var room = $(this).text().replace(/\s/g, '');
  rowspan=$(this).closest("td").attr("id");
  // alert(sel);
  if (room!="ΟΛΑ"){
  $('#workshoteltable .work.'+date+':not(.'+room+')').hide();
  $('#workshoteltable .work.'+date+'.'+room).show();

  hidden=$('#workshoteltable .'+date+':hidden').length;
  // alert(hidden);
  rowspan-=hidden;
  $(this).closest("td").attr('rowspan', rowspan);
}
else {
  $('#workshoteltable .work.'+date).show();
  $(this).closest("td").attr('rowspan', rowspan);

}
});

$("#clearfields").click(function() {
  $('.workfield').val('');
});
