<?php 
include("../../check_login_global.php");

$timezone = "Asia/Hong_Kong";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
global $db;
function get_acc(){
    global $db;
    $shopInfoObj = $_SESSION['SHOP'];
    //$keywords = (isset($_POST['keywords']))? $_POST['keywords'] : $_GET['keywords'];
    $shopno = $shopInfoObj->retailno;
    $sql = "SELECT si.acc_no,acc_id,manufacturer,accName,typeName,color,
                oprice,sprice,stateName,retail_id,sum(ava_bal) as ava_bal
            FROM stockin si, accessories acc, retailShop rs, acctype act ,productstate pd
            WHERE si.acc_no = acc.acc_no
            AND si.retailShop_no = rs.retailShop_no
            AND acc.productState_no = pd.productState_no
            AND acc.accType_no = act.accType_no";
    $sql .=" and si.retailShop_no = $shopno ";
    //$sql .=" and acc.acc_id like '$keywords%' ";

    $sql .=" group by si.retailShop_no,si.acc_no";
    //$result = $db->selectLimit($sql, '14',$pageNo);
    $result = $db->query($sql);

    $data_arr = array();
    if ($result) {
        while ($row = $db->fetch_array($result)) {
            $data_arr[] = $row;
        }
    }
    return json_encode($data_arr);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- just for IE -->
    <title>DOA Function</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- style for DOA dialog -->
    <style>
        #doafindacc>.modal-dialog {
            width : 90%;
        }
    </style>
  </head>
  <body style="padding: 1em;">
    <h1>DOA</h1>
    <br>
    <div><button type="button" aria-label="Close" onclick="dialog_doa_open()"><span>Find Accessories</span></button></div>
    <br>
    <div>
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>配件 id</th>
                <th>配件名稱</th>
                <th>配件種類</th>
                <th>Color</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
    
    <div style="padding-top: 30%">
        <!-- change the style later -->
        <div><button type="button"  onclick="retuen false;"><span>Create DOA</span></button></div>
    </div>
    
    
<div id ="doafindacc" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Find Accessories</h4>
            </div>
        <div class="modal-body">
            <div class="bootstrap-dialog-message">
                <input id="doa_search_acc_text" type="text" class="form-control" placeholder="Enter accessories id here..."></textarea>
            </div>
            <div id="doa_search_acc_results" class="bootstrap-dialog-message"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>   
  </body>
</html>

<script>
    function dialog_doa_open(){
        //dialog_doa_reset();
        $("#doafindacc .modal-header").css("background-color","antiquewhite");
        $("#doafindacc .modal-header").css("border-top-left-radius","4px");
        $("#doafindacc .modal-header").css("border-top-right-radius","4px");
        
        var data = <?php echo get_acc(); ?> ;
        var html_a=''; var html_b=''; var html_c='';
        html_a+='<table rules="all" border="1" class="finAcc" style="width:100%;" >'+
                    '<thead>'+
                        '<th style="width: 110px">Action</th>'+
                        '<th style="width: 110px;">配件 id</th>'+
			'<th>配件製造商</th>'+
			'<th style="">配件名稱</th>'+
			'<th style="width: 100px">配件種類</th>'+
			'<th style="width: 100px">Color</th>'+
			//'<th>oprice</th>'+
			//'<th>sprice</th>'+
			//'<th>配件狀態</th>'+
			//'<th>店舖</th>'+
			'<th>QTY</th>'+
                    '</thead>'+
                '<tbody>';
			
        var numOfData = data.length;
        for(var i = 0; i<numOfData; i++){
            html_b+='<tr><td><a href="#" style="color:#0019FF;"'+
                            //"onclick=\"addAccToInvoice('"+data[i].acc_no+"')\">加到Invoice</a></td>"+
                            ">Add to list</a></td>"+
                        '<td style="font-size:2em;">'+data[i].acc_id+'</td>'+
                        '<td>'+data[i].manufacturer+'</td>'+
                        '<td>'+data[i].accName+'</td>'+
                        '<td style="font-size:2em;">'+data[i].typeName+'</td>'+
                        '<td>'+data[i].color+'</td>'+
                        //'<td>'+data[i].oprice+'</td>'+
                        //'<td>'+data[i].sprice+'</td>'+
                        //'<td>'+data[i].stateName+'</td>'+
                        //'<td>'+data[i].retail_id+'</td>'+
                        '<td style="font-size:2em;">'+data[i].ava_bal+'</td>'+
                    '</tr>';
        }
        html_c += '</tbody></table>';
        $("#doa_search_acc_results").html(html_a+html_b+html_c);
        $('#doafindacc').modal('show');
        //console.log(data);100%
    }
    function dialog_doa_reset(){
        //origin html
        var static_dialog_html = 
            '<div class="modal-dialog">'+
            '   <div class="modal-content">'+
            '       <div class="modal-header">'+
            '           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '           <h4 class="modal-title">Find Accessories</h4>'+
            '       </div>'+
            '       <div class="modal-body">'+
            '           <p>One fine body&hellip;</p>'+
            '       </div>'+
            '       <div class="modal-footer">'+
            '           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
            '       </div>'+
            '   </div>'+
            '</div>';

        $('#doafindacc').html(static_dialog_html);
    }
</script>