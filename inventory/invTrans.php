<?php

require ("../conn/db_include.php");
require_once('lib.php');

//must set timezone on the top	
$timezone = "Asia/Hong_Kong";
if (function_exists('date_default_timezone_set'))
    date_default_timezone_set($timezone);
//must set timezone on the top	

global $db;
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'addTrans': //last update at 2012-11-01
            $shopInfoObj = (isset($_POST['shopInfoObj'])) ? $_POST['shopInfoObj'] : $_GET['shopInfoObj'];
            $transferGoodsOjbArrList = (isset($_POST['transferGoodsOjbArrList'])) ? $_POST['transferGoodsOjbArrList'] : $_GET['transferGoodsOjbArrList'];

            $transferGoodsOjbArrList_de = json_decode($transferGoodsOjbArrList);

            //print_r ($transferGoodsOjbArrList_de);

            $DATE2 = date("Y-m-d");
            $create_date = date("Y-m-d H:i:s");
            $fromRetail_no = $shopInfoObj['shopno'];
            $toRetail_no = $shopInfoObj['toRetail'];
            $staff_no = $shopInfoObj['staff_no'];
            $ftec_dnno = $shopInfoObj['ftecdnno'];

            $sql = "INSERT INTO transfer (`transDate`, `fromRetail_no`, `toRetail_no`, `staff_no`, `transState_no`, `tranReson`, `ftec_dnno`) 
                   VALUES ('$create_date', '$fromRetail_no', '$toRetail_no', $staff_no, 1, '普通轉貨', '$ftec_dnno')";
            //echo $sql;
            //print_r ($shopInfoObj);
            $db->query($sql);
            $last_insert_id = $db->insert_id();
            //print_r($transferGoodsOjbArrList_de);
            $arrlen = count($transferGoodsOjbArrList_de);
            echo '1<br>';
            for ($r = 0; $r < $arrlen; $r++) {
                echo '2<br>';
                $qty = (int) ($transferGoodsOjbArrList_de[$r]->qty);
                if ($transferGoodsOjbArrList_de[$r]->is_acc == 1) { //if 電話
                    $imei = $transferGoodsOjbArrList_de[$r]->imei;
                    $z = getMobileDetail($imei);
                    print_r($z['poDetail_no']);
                    //getMobilePoNo
                    $po_date = getMobilePoDate($z['poDetail_no']);
                    $sql = "INSERT INTO transdetail (`trans_qty`, `IMEI`, `transfer_no`,`po_date`) 
                            VALUES ($qty, $imei, $last_insert_id,'$po_date')";
                    $db->query($sql);
                    $sql = "UPDATE phone SET retailShop_no=9999 WHERE IMEI='$imei'";
                    $db->query($sql);

                    //editing
                } else { //if not 電話
                    $bcode = $transferGoodsOjbArrList_de[$r]->bcode;
                    $acc_no = getAccNo($bcode);
                    //2013-10-30
                    //because is normal transfer, use 0 or it isforshop = self shop code
                    $isforshop = array($_SESSION['retail_no'], 0); // 0=not point to any shop, 1= point to a retailshop
                    $stockin_arr = getStockin($acc_no, $fromRetail_no, $isforshop);
                    
                    
                    $stockin_arr_length = count($stockin_arr);
                    if ($stockin_arr_length == 1) { //無交接
                        $stockIn_no = $stockin_arr->stockIn_no;
                        $ava_bal = $stockin_arr->ava_bal;
                        $po_date = $stockin_arr->po_date;

                        if ($ava_bal - $qty >= 0) {
                            //$po_date = $db->getOne("select po_date from stockin where stockIn_no=$stockIn_no");



                            $sql = "INSERT INTO transdetail (`trans_qty`, `acc_no`, `transfer_no`,`stockIn_no`,`po_date`) 
                                                    VALUES ($qty, $acc_no, $last_insert_id,$stockIn_no,'$po_date')";
                            $db->query($sql);
                            $sql = "UPDATE stockin SET trans_qty=trans_qty+$qty WHERE stockIn_no='$stockIn_no';";
                            $db->query($sql);
                            $sql = "UPDATE stockin SET ava_bal=ava_bal-$qty WHERE stockIn_no='$stockIn_no';";
                            $db->query($sql);
                        } else {
                            echo'f';
                            //must delete transfer table record
                        }
                    } else { //有交接
                        printf($qty);
                        (int) $temp_qty = (int) $qty;
                        $stock_total = $stockin_arr['stock_total'];
                        array_pop($stockin_arr);
                        print_r($stockin_arr);
                        print_r($stock_total);
                        if ((int) $stock_total >= $temp_qty) {
                            echo"t\n";
                            foreach ($stockin_arr as $stockin_r) {
                                $stockIn_no = $stockin_r->stockIn_no;
                                (int) $ava_bal = (int) $stockin_r->ava_bal;
                                $po_date = $stockin_r->po_date;

                                if ($temp_qty > 0) {
                                    if ((int) ($stockin_r->ava_bal) >= $temp_qty) {
                                        $stockin_r->ava_bal = $ava_bal - $temp_qty;


                                        $sql = "INSERT INTO transdetail (`trans_qty`, `acc_no`, `transfer_no`,`stockIn_no`,`po_date`) 
                                                    VALUES ($temp_qty, $acc_no, $last_insert_id,$stockIn_no,'$po_date')";
                                        $db->query($sql);
                                        $sql = "UPDATE stockin SET trans_qty=trans_qty+$temp_qty WHERE stockIn_no='$stockIn_no';";
                                        $db->query($sql);
                                        $sql = "UPDATE stockin SET ava_bal=ava_bal-$temp_qty WHERE stockIn_no='$stockIn_no';";
                                        $db->query($sql);

                                        $temp_qty = $temp_qty - $temp_qty;

                                        break;
                                    } else {
                                        $temp_qty = ($temp_qty - (int) ($stockin_r->ava_bal));
                                        $stockin_r->ava_bal = 0;
                                        $sql = "INSERT INTO transdetail (`trans_qty`, `acc_no`, `transfer_no`,`stockIn_no`,`po_date`) 
                                                    VALUES ($ava_bal, $acc_no, $last_insert_id,$stockIn_no,'$po_date')";
                                        $db->query($sql);
                                        $sql = "UPDATE stockin SET trans_qty=trans_qty+$ava_bal WHERE stockIn_no='$stockIn_no';";
                                        $db->query($sql);
                                        $sql = "UPDATE stockin SET ava_bal=ava_bal-$ava_bal WHERE stockIn_no='$stockIn_no';";
                                        $db->query($sql);
                                    }
                                }
                            }
                        } else {
                            echo"f\n";
                        }
                        echo"\n///////\n";
                        print_r($stockin_arr);
                        echo"\n///////\n";
                    }
                }
            }
            break;
        case 'upTrans':

            //echo strlen($_GET['stringToken']);
            //echo trim($_GET['stringToken']);
            $transfer_no = $_GET['transfer_no'];
            $retailShop_no = $_GET['retailShop_no'];
            $userLoginId = $_GET['userLoginId'];
            $userno = getuserno($userLoginId);
            $DATE2 = date("Y-m-d");
            $create_date = date("Y-m-d H:i:s");

            $row1 = $db->getrow("select * from transfer where transfer_no = $transfer_no");

            $sql2 = "select * from transdetail where transfer_no = $transfer_no
						and trans_qty>0";
            $result2 = $db->query($sql2);
            if ($result2) {
                while ($row2 = $db->fetch_array($result2)) {
                    //echo $row['acc_no'];
                    $acc_no = $row2['acc_no'];
                    $po_date = $row2['po_date'];
                    $trans_qty = $row2['trans_qty'];
                    $stockIn_no = $row2['stockIn_no'];

                    //$sql = "select * from stockin where retailShop_no = $retailShop_no ".
                    //	   "and acc_no = '$acc_no' and po_date = '$po_date'";

                    if ($row2['IMEI'] == null) {  //acc
                        $sql5 = "insert into stockin(poDetail_no,staff_no,acc_no,retailShop_no,po_date,iprice,ava_bal,rec_qty,rec_date,transDetail_no)" .
                                "values(" . getPoDetailNoByStockIn($stockIn_no) . ", $userno, $acc_no, $retailShop_no,'$po_date'," .
                                getCost(getPoDetailNoByStockIn($stockIn_no)) . ",$trans_qty,$trans_qty,'$create_date'," . $row2['transDetail_no'] . ")";
                        echo $sql5;
                    } else {  //phone
                        echo 2;
                        $sql5 = "UPDATE phone SET retailShop_no=$retailShop_no WHERE IMEI='" . $row2['IMEI'] . "' ";
                    }
                    $db->query("UPDATE  transfer
												SET  transState_no =  '2', confirmBy='$userLoginId', receiveDate='$create_date'
												WHERE  transfer_no =$transfer_no");
                    $db->query($sql5);
                }
            }



            break;
        case 'getTransList':
            $retailShop_list = get_retailshop_list();
            $transfer_state = array(1 => '未收貨',
                2 => '已收貨',
                3 => '無效');
            $shopno = '';
            if (isset($_GET['shopno'])) {
                $shopno = $_GET['shopno'];
                $sql = "SELECT transfer_no,transDate, fromRetail_no, toRetail_no,staff_id,transState_no,tranReson
                        FROM transfer tr
                        LEFT JOIN staff as st on tr.staff_no=st.staff_no";
                
                if(isset($_GET['filter_transfer_state'])){
                    $transState_no = $_GET['filter_transfer_state'];
                    switch($transState_no){
                        case 0 : 
                            $sql_transfer_state_and = " ";
                            $sql_transfer_state_where = " ";
                            break;
                        default : 
                            $sql_transfer_state_and   = " AND transState_no = $transState_no";
                            $sql_transfer_state_where = " WHERE transState_no = $transState_no";     
                    }
                    
                }
                if ($shopno != 1){
                    $AND_sql = '';
                    $sql .= " WHERE toRetail_no = $shopno
                              OR    fromRetail_no = $shopno
                              $sql_transfer_state_and
                            ";
                } else {
                    $sql .= "$sql_transfer_state_where";
                }
                
                if(isset($_GET['filter_short_type'])){
                    $sort_no = $_GET['filter_short_type'];
                    $transfer_state_arr = array(1 => 'DESC',2 => 'ASC');
                    $sql.=" ORDER BY transfer_no $transfer_state_arr[$sort_no]";
                } else {
                    $sql.=" ORDER BY transfer_no DESC";
                }
            }
            //add limit to the sql
            $sql.=" LIMIT 0, 200";

            $dataobject = $db->records_sql($sql);
            if ($dataobject) {
                foreach ($dataobject as $data) {
                    $data->transfer_no = getTrNo($data->transfer_no);

                    $data->fromshop = $retailShop_list[$data->fromRetail_no]->retail_id;
                    $data->toshop = $retailShop_list[$data->toRetail_no]->retail_id;
                    $data->transfer_state = $transfer_state[$data->transState_no];
                    unset($data->fromRetail_no);
                    unset($data->toRetail_no);
                }
            }

            //output to table content
            $all_row = array();
            
            foreach ($dataobject as $data) {
                $row = array();
                $row[] = $data->transfer_no;
                $row[] = $data->fromshop;
                $row[] = $data->toshop;
                $row[] = $data->staff_id;
                $row[] = $data->transfer_state;
                $row[] = $data->transDate;
                $row[] = $data->tranReson;
                $all_row[] = $row;
            }
            //print_object($all_row);

            $html = '';
            $html .= '<div ><table rules="all" border="1"  class="trTable" style=" width:100%; align=left;" >' .
                            '<thead>' .
                                '<th style="width: auto;">轉貨 No.</th>' .
                                '<th style="width: auto;">分店(由)</th>' .
                                '<th style="width: auto;">分店(至)</th>' .
                                '<th>Create By</th>' .
                                '<th>轉貨狀態</th>' .
                                '<th style="width: auto;">Create Date</th>' .
                                '<th style="width: auto;">轉貨原因</th>' .
                            '</thead>' .
                            '<tbody>';
            foreach ($all_row as $columns) {
                $html .="<tr>";
                $html .='<td><a href="#" style="color:#0019FF;" onclick="findTrDetail(\'' . $columns[0] . '\');">' . $columns[0] . '</a></td>';
                $html .="<td>$columns[1]</td>";
                $html .="<td>$columns[2]</td>";
                $html .="<td>$columns[3]</td>";
                $html .="<td>$columns[4]</td>";
                $html .="<td>$columns[5]</td>";
                $html .="<td>$columns[6]</td>";
                $html .="</tr>";
            }
            echo $html;
            echo '</tbody></table></div>';
            //echo "<input type=\"hidden\" name=\"totalRow\" id=\"totalRow\" value=\"$result3\" />";
            break;
            
        case 'getTransDetail':
            if (isset($_GET['trNo'])) {
                $transfer_no = $_GET['trNo'];
                $sql1 = "select transfer_no,transDate, rsA.retail_id as fromshop,rsB.retail_id as toshop,staff_id,transState_no,tranReson, ftec_dnno, with_po
                         from transfer tr
                         left join retailShop as rsA on tr.fromRetail_no=rsA.retailShop_no
                         left join retailShop as rsB on tr.toRetail_no=rsB.retailShop_no
                         left join staff as st on tr.staff_no=st.staff_no
                         where tr.transfer_no = $transfer_no";
                $row1 = $db->getrow($sql1);
                $trNo = getTrNo($row1['transfer_no']);
                $o_trNo = $row1['transfer_no'];
                $createBy = $row1['staff_id'];
                $fromshop = $row1['fromshop'];
                $toshop = $row1['toshop'];
                $createDate = $row1['transDate'];
                $transState_no = $row1['transState_no'];
                $ftec_dnno = $row1['ftec_dnno'];
                switch ($row1['transState_no']) {
                    case 1: $stateName = '未收貨';
                        break;
                    case 2: $stateName = '已收貨';
                        break;
                    case 3: $stateName = '無效';
                        break;
                }
                $tranReson = $row1['tranReson'];
                $detail_of_tr_inTable = '<table border=\"1\" width=\"100%\">' .
                        '<tr>';
                $detail_of_tr_inTable .= '<td>transDetail_no</td>' .
                        '<td>貨品編號</td>' .
                        '<td>貨品名稱</td>' .
                        '<td>數量</td>' .
                        '<td>poDetail_no</td>' .
                        '<td>po_date</td>' .
                        '</tr>';
                $sql2 = "select transDetail_no,trans_qty,acc_no,IMEI,po_date
					  from transdetail
					  where transfer_no = $transfer_no";

                $result2 = $db->query($sql2);
                $phone_qty = 0;
                if ($result2) {
                    while ($row2 = $db->fetch_array($result2)) {
                        $detail_of_tr_inTable .= "<tr>";
                        $detail_of_tr_inTable .="<td>" . $row2['transDetail_no'] . "</td>";

                        if ($row2['IMEI'] == null) {  //acc
                            //$detail_of_tr_inTable .= "<td>".$row2['acc_no']."</td>";
                            $sql3 = "select acc_id as pd_id, accName as pd_name from accessories where acc_no=" . $row2['acc_no'];
                            $row3 = $db->getrow($sql3);
                            $pd_id = $row3['pd_id'];
                            $pd_name = $row3['pd_name'];
                        } else {
                            $sql4 = "select phoneType_no from phone where IMEI = '" . $row2['IMEI'] . "'";
                            $phonetype_no = $db->getOne($sql4);
                            $sql3 = "select phonetype_id as pd_id, phone_name as pd_name from phonetype where phoneType_no=$phonetype_no";
                            $row3 = $db->getrow($sql3);
                            $pd_id = $row3['pd_id'] . ' (' . $row2['IMEI'] . ')';
                            $pd_name = $row3['pd_name'];
                            $phone_qty++;
                        }
                        $detail_of_tr_inTable .= "<td>" . $pd_id . "</td>";
                        $detail_of_tr_inTable .= "<td>" . $pd_name . "</td>";
                        $detail_of_tr_inTable .= "<td>" . $row2['trans_qty'] . "</td>";
                        $detail_of_tr_inTable .= "<td>" . " " . "</td>";
                        $detail_of_tr_inTable .= "<td>" . $row2['po_date'] . "</td>";

                        $detail_of_tr_inTable .= "</tr>";
                    }
                }
                $detail_of_tr_inTable .= "</table>";
                
                //edit 2012-12-12
                if($phone_qty!=0){
                    $detail_of_tr_inTable.= '<p>電話總數：'.$phone_qty.'</p>';
                }

                $button_inTable = '';
                $delete_tr_but = '';
                if ($transState_no == 1) {

                    if ($_SESSION['retail_no'] == getShopno($fromshop)){
                        $button_inTable = '';
                    } else if ($_SESSION['retail_no'] == getShopno($toshop)){
                        $button_inTable = '<input type="button" value="收貨" onclick="recTransfer('.$o_trNo.')"/>';
                    }
                    //有直接連PO的TR唔handle住, with_po = 0 等如無直接連
                    if(require_office() && check_office_staff($_SESSION['staff_no']) && $row1['with_po'] ==0 ){
                        $delete_tr_but = '<input type="button" value="刪除轉貨單" class="finIncel"  onclick="deleteTrans('.$o_trNo.');" />';
                    }
                }
                
                //echo $_SESSION['retail_no'];

                $numOfRow = 1;

                $printbut = '<input type="button" value="重印轉貨單" class="finIncel"  onclick="printTrans('.$o_trNo.');" />';
                
                $msgarray = array();
                $msgarray["trNo"] = $trNo;
                $msgarray["createDate"] = $createDate;
                $msgarray["createBy"] = $createBy;
                $msgarray["stateName"] = $stateName;
                $msgarray["fromshop"] = $fromshop;
                $msgarray["toshop"] = $toshop;
                $msgarray["detail_of_tr_inTable"] = $detail_of_tr_inTable;
                $msgarray["button_inTable"] = $button_inTable;
                $msgarray["printbut"] = $printbut.$delete_tr_but;
                $msgarray["ftec_dnno"] = $ftec_dnno;
                $msgarray["ok"] = 1;
                echo tojson($msgarray);
/*                
                echo "var tr =new Array(\"$numOfRow\",
                                        \"$trNo\",
                                        \"$createDate\",
                                        \"$createBy\",
                                        \"null\",
                                        \"$stateName\",
                                        \"$fromshop\",
                                        \"$toshop\",
                                        \"$detail_of_tr_inTable\",
                                        \"$button_inTable\",
                                        \"$printbut\",
                                        \"$ftec_dnno\");";
 * 
 */
            }
            break;
        case'getTransferGdInfo':
            $price = 0;
            $total = 0;
            $qty = 1;
            $goodsType = 0;
            $shopno = $_GET['shopno'];

            $sql = "SELECT accName, barcode,acc_id, sum(ava_bal) as ava_bal, typeName, sprice,oprice
                    FROM accessories acc,stockin si, acctype act
                    WHERE si.retailShop_no = $shopno
                    AND acc.acc_no = si.acc_no
                    AND acc.accType_no = act.accType_no
                    AND si.isforshop in ($shopno ,0)";

            if (isset($_GET['bcode']) && isset($_GET['qty'])) {
                $bcode = $_GET['bcode'];
                $qty = $_GET['qty'];
                $sql .=" AND si.acc_no =(select acc_no from accessories where barcode='$bcode' or acc_id = '$bcode')";
            } else
            if (isset($_GET['accNo'])) {
                $accNo = $_GET['accNo'];
                $sql .=" AND acc.acc_no = $accNo";
            }
            $sql .=" group by acc.acc_no";

            $result = $db->query($sql);
            if ($result) {
                while ($row = $db->fetch_array($result)) {
                    if (($row['ava_bal'] - $qty) < 0)
                        die(error_msg1());
                    if ($_GET['osarea'] == 0)
                        $price = $row['sprice'];
                    else if ($_GET['osarea'] == 1)
                        $price = $row['oprice'];


                    if ($row['barcode'] != null && $row['barcode'])
                        $bcode = $row['acc_id'];
                    //$bcode = $row['barcode'];
                    else
                        $bcode = $row['acc_id'];

                    $accName = $row['accName'];
                    $total = ($price * $qty);
                    $discount = 0;
                    $ava_bal = $row['ava_bal'];
                }
            }// End of if $result
            echo ' transObj = { "accName" : "' . $accName . '",
										   "bcode" : "' . $bcode . '",
											 "price" : "' . $price . '",
									   "ava_bal" : "' . $ava_bal . '",
											  } ';
            break;
    }//end of switch
} //end of isset	

function getTrNo($tr_no) {
    $tempTrNo = $tr_no;
    $tempTrNo_length = strlen($tempTrNo);
    $i = 7;
    $zeroNeedToAdd = $i - $tempTrNo_length;
    $tempZero = '';
    while ($zeroNeedToAdd != 0) {
        $tempZero .='0';
        $zeroNeedToAdd--;
    }
    return $finalToNo = 'TR-' . $tempZero . $tempTrNo;
}

function getAccNo($bcode) {
    global $db;
    $sql = "select acc_no from accessories where acc_id='$bcode'";
    $_bcode = $db->getOne($sql);
    return $_bcode;
}

function getPoDetailNo($acc_no, $po_date) {
    global $db;
    $sql = "select poDetail_no from po,podetail where po.po_no = podetail.po_no and acc_no = $acc_no and createDate = '$po_date'";
    $result = $db->query($sql);
    while ($row = $db->fetch_array($result)) {
        $podeno = $row['poDetail_no'];
    }
    return $podeno;
}

function getMobilePoNo($podetail_no) {
    global $db;
    $sql = "SELECT po_no FROM podetail left join po on podetail.po_no = po.po_no where podetail_no = $podetail_no";
    $po_no = $db->getOne($sql);
    return $po_no;
}

function getMobileDetail($imei) {
    global $db;
    $sql = "SELECT * FROM phone where IMEI = '$imei' ";
    $row = $db->getrow($sql);
    return $row;
}

function getMobilePoDate($podetail_no) {
    global $db;
    $sql = "SELECT createDate FROM podetail
				left join po on podetail.po_no = po.po_no where podetail_no = '$podetail_no' ";
    $po_date = $db->getOne($sql);
    return $po_date;
}

function getPoDetailNoByStockIn($stockIn_no) {
    global $db;
    $sql = "select poDetail_no from stockin where stockIn_no = $stockIn_no";
    $poDetail_no = $db->getOne($sql);
    return $poDetail_no;
}

function getuserno($userLoginId) {
    global $db;

    $sql = "select staff_no from staff where staff_id='$userLoginId'";

    $staff_no = $db->getOne($sql);
    return $staff_no;
}

function getCost($poDetail_no) {
    global $db;
    //$sql = "select * from po,podetail where po.po_no = podetail.po_no and acc_no = $acc_no and createDate = '$po_date'";
    $sql = "SELECT cost FROM 3shop.podetail where poDetail_no = $poDetail_no";
    $cost = $db->getOne($sql);
    return $cost;
}

function getStockin($acc_no, $shopno, $isforshop) {
    global $db;
    if(!is_array($isforshop)){
        $isforshop = $isforshop;
    } else {
        $isforshop = implode(",", $isforshop);
    }
    $sql = "SELECT * 
            FROM stockin 
            WHERE acc_no ='$acc_no' 
            AND ava_bal>0 
            AND retailShop_no = $shopno
            AND isforshop in ( $isforshop )
            ORDER BY po_date";
    
    $result = $db->query($sql);

    $arr_obj = array();
    (int) $total_qty = 0;
    while ($row = $db->fetch_array($result)) {
        $stockIn_no = $row['stockIn_no'];
        $data_obj = new stdClass();
        $data_obj->stockIn_no = $stockIn_no;
        $data_obj->ava_bal = $row['ava_bal'];
        $data_obj->po_date = $row['po_date'];
        $arr_obj[$stockIn_no] = $data_obj;

        $total_qty = $total_qty + (int) ($row['ava_bal']);
    }
    $arr_obj['stock_total'] = $total_qty;
    return $arr_obj;
}

function getShopno($shopid) {
    global $db;

    $sql = "select retailShop_no from retailShop where retail_id='$shopid'";
    $shopno = $db->getOne($sql);

    return $shopno;
}

