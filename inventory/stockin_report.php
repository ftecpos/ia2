<?php include("../check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>貨物入倉報表</title>
</head>
<body>
	
	<style>
	#dialog label, #dialog input { display:block; }
	#dialog label { margin-top: 0.5em; }
	#dialog input, #dialog textarea { width: 95%; }
	#tabs { margin-top: 1em; }
	#tabs li .ui-icon-close { float: left; margin: 0.4em 0.2em 0 0; cursor: pointer; }
	#add_tab { cursor: pointer; }
	.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { color:#FFF;}
	</style>
	<script>
	$(function() {
		var $tab_title_input = $( "#tab_title"),
			$tab_content_input = $( "#tab_content" );
		var tab_counter = 2;

		// tabs init with a custom tab template and an "add" callback filling in the content
		var $tabs = $( "#tabs").tabs({
			tabTemplate: "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'>Remove Tab</span></li>",
			add: function( event, ui ) {
				var tab_content = $tab_content_input.val() || "Tab " + tab_counter + " content.";
				$( ui.panel ).append( "<p>" + tab_content + "</p>" );
			}
		});

		// modal dialog init: custom buttons and a "close" callback reseting the form inside
		var $dialog = $( "#dialog" ).dialog({
			autoOpen: false,
			modal: true,
			buttons: {
				Add: function() {
					addTab();
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			open: function() {
				$tab_title_input.focus();
			},
			close: function() {
				$form[ 0 ].reset();
			}
		});

		// addTab form: calls addTab function on submit and closes the dialog
		var $form = $( "form", $dialog ).submit(function() {
			addTab();
			$dialog.dialog( "close" );
			return false;
		});

		// actual addTab function: adds new tab using the title input from the form above
		function addTab() {
			var tab_title = $tab_title_input.val() || "Tab " + tab_counter;
			$tabs.tabs( "add", "#tabs-" + tab_counter, tab_title );
			tab_counter++;
		}

		// addTab button: just opens the dialog
		$( "#add_tab" )
			.button()
			.click(function() {http://192.168.58.2/ia/main/main.php#tabs-1
				$dialog.dialog( "open" );
			});

		// close icon: removing the tab on click
		// note: closable tabs gonna be an option in the future - see http://dev.jqueryui.com/ticket/3924
		$( "#tabs span.ui-icon-close" ).live( "click", function() {
			var index = $( "li", $tabs ).index( $( this ).parent() );
			$tabs.tabs( "remove", index );
		});
		
		$.ajax({
			url: "../inventory/invGet.php?action=report_num",
    		cache: false,
	    	dataType: 'html',
	        type:'POST',
	        data: {
				report_num:1,
			},
			async: true,
			error: function(xhr) {
				alert('Ajax request Error!!!!!');
			},
			success: function(response){
				$('#tabs-1').append(response);
			}
		});//----End of ajax------
		
		
		
	}); // end for $(function(){

function call_datepicker(){
	$( "#datepicker_from" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:"yy-mm-dd",
		showButtonPanel: true
	});
	$( "#datepicker_to" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:"yy-mm-dd",
		showButtonPanel: true
	});
}
call_datepicker();
	</script>
<style>
	.ui-datepicker-month{border: 1px solid #000000;}
	.ui-datepicker-year{border: 1px solid #000000;}
	.ui-multiselect-filter {height:25px;}
	.ui-multiselect-filter input {height:20px;}
</style>
<div id="si_head">
		<input type="button" value="Reset" class="finIncel"  onclick="call_stockin_report()" style="height:23;"/>
    	<label for="filter" class="gg">Filter : </label>
		<select name="filter" onchange="change_filter($(this).val())">
			<option value="1" selected="selected">日期</option>
			<?php session_start();
				if($_SESSION['retail_no']==1)
					echo '<option value="2">供應商</option>';
			?>
			<option value="3">分類</option>
			<option value="4">產品編號</option>
			<option value="8">開單員工</option>
		</select>
		
		<div style="display:inline" id="filter_menu">From : <input class="stockin_col" id="datepicker_from" type="text">
				To : <input class="stockin_col" id="datepicker_to" type="text">   
				<input type="button" value="Search" class="finIncel"  onclick="filter_but(1)" style="height:23;"/></div>
</div>

<div class="" style="margin: 40px 0 0 0;">

	<div id="dialog" title="Tab data">
		<form>
			<fieldset class="ui-helper-reset">
				<label for="tab_title">Title</label>
				<input type="text" name="tab_title" id="tab_title" value="" class="ui-widget-content ui-corner-all" />
				<label for="tab_content">Content</label>
				<textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all"></textarea>
			</fieldset>
		</form>
	</div>

	<button id="add_tab" style="display:none;">Add Tab</button>

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">貨物入倉報表</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>
		</ul>
		<div id="tabs-1">
			<p></p>
		</div>
	</div>

</div>

<div id="stockin_report_controlPan" title="貨物入倉報表 控制框" style="display:none;">
    	<table cellpadding="5">
        	<tr>
            	<td>進貨數量</td>
                <td>
	               
                </td>
            </tr>
        </table>

</div>
</body>
</html>
<script>
$('#stockin_report_controlPan').dialog('distory');
			var dialogOption70 = {
				autoOpen:false,  //defult must be false
				height: 200,
				width: 220,
				position: ["left",500],
				zIndex: 5000,
				modle:true,
				closeOnEscape: true,
				
				resizable: false,
				async: false,
				beforeOpen: function(){
					
				},
				open: function () {
					
					$(this).dialog(dialogOption70); //initializ the dailog once again to clean the data that saved at before
				},
				close: function () {
					
				},
				beforeClose: function() {
				},
				buttons : {
					"確認": function() {
						
					},
					"取消": function() {
						$( this ).dialog( "close" );
					},
				},
			}; //end of dialogOption70
	
			$('#stockin_report_controlPan').dialog(dialogOption70);
	//---End of stockin_report_controlPan dialog------------------------------
			//$('#stockin_report_controlPan').dialog('open');

</script>

<script type="text/javascript" src="../js/inventory.js"></script>
<link href="../css/inventory.css" type="text/css" link rel="stylesheet" media="screen"/>