var shopInfoObj = new Object();
shopInfoObj.shopno = shopno;
shopInfoObj.shopid = shopid;
shopInfoObj.staff_id=$('#staff_id').html();
shopInfoObj.staff_no=$('#staff_no').html();
shopInfoObj.toRetail=$('#shop_list').val();



function get_shopInfoObj(){
	return shopInfoObj;
}

function deleteRow(elem) {
  // 先抓到是哪一個 tr
  var row = $(elem).parent().parent();

  // 移除它
  row.fadeOut('normal', function() {
    row.remove();
  });
}