<?php
include "includes/inc.php";
##################
########################
  if(isset($_GET['cat_show'])){
mysqli_query($con, "UPDATE ".$prefix."_config SET cat_items_show=".$_GET['cat_show']." where id=".$get_db_id."");
header("refresh:0;url=receivings_returns.php");
	  }
##########################
if(isset($_GET['unsuspend'])){
								if(mysqli_query($con, "INSERT INTO ".$prefix."_receivings_temporary(item, Price, Quantity, unit, Discount, Total, SupplierID, BuyPrice, date, type, subqty, size, color, user_id)
SELECT item,Price,Quantity,unit,Discount,Total,SupplierID,BuyPrice,date,type,subqty,size,color,user_id from ".$prefix."_receivings_suspended")){
	if(mysqli_query($con,"DELETE FROM ".$prefix."_receivings_suspended")){

$report_suspend='0';

	}	
}
								}
#######################
mysqli_query($con, "UPDATE ".$prefix."_receivings_temporary SET type='2' where user_id='$user_id' type='1'");
mysqli_query($con, "UPDATE ".$prefix."_receivings_temporary SET Quantity=Quantity*-1 where user_id='$user_id' and Quantity>0");
mysqli_query($con, "UPDATE ".$prefix."_receivings_temporary SET Total=Total*-1 where user_id='$user_id' and Total>=0");
if(isset($_POST['date'])){
$_POST['date']=str_replace("/", "-", $_POST['date']);
$DueDate=Trim(date('Y-m-d',strtotime($_POST['date'])));
								##################
																if(mysqli_query($con, "UPDATE ".$prefix."_receivings_temporary SET  date='$DueDate' where user_id='$user_id'")){
									}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
<script>
function popupCenter(pageURL, title, w, h) {
    var left = (screen.width / 2)  - (w / 2);
    var top  = (screen.height / 2) - (h / 2);
    var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<script>
			function showResults(str) {
				if(str.length == 0) {
					document.getElementById("livesearchcl").innerHTML = "";
					document.getElementById("livesearchcl").style.border = "0px";
					return;
				}
				if(window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("livesearchcl").innerHTML = xmlhttp.responseText;
						document.getElementById("livesearchcl").style.border = "0px solid #A5ACB2";
					}
				}
				xmlhttp.open("GET", "suppliers_search.php?q=" + str, true);
				xmlhttp.send();
			}
		</script>
		<script>
			function showResultsOfItems(str) {
				if(str.length == 0) {
					document.getElementById("livesearch").innerHTML = "";
					document.getElementById("livesearch").style.border = "0px";
					return;
				}
				if(window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
						document.getElementById("livesearch").style.border = "0px solid #A5ACB2";
					}
				}
				xmlhttp.open("GET", "items_search.php?q=" + str, true);
				xmlhttp.send();
			}
		</script>
				<title><?php echo"".$get_db_CompanyName.""; ?></title>
                   <?php include"includes/css.php"; ?>
                                 <?php include"includes/js.php"; ?>
	</head>
	<body  class="cmenu1 example-target">
		
			<div>
				<div>
                  <?php
  if(isset($_GET['receivings_cat'])){
mysqli_query($con, "UPDATE ".$prefix."_config SET receivings_cat_items_show=".$_GET['receivings_cat']." where id=".$get_db_id."");
header("refresh:0;url=receivings_returns.php");
	  }
  ?>
					<?php
					if ($get_db_isLogo == 1) {
						if ($get_db_Logo == "") {
							echo '<img src="images/yourLogoHere.png" style="float:left; border:0px;"/>';
						} else {
							echo '<img src="uploads/'.$get_db_Logo.'" style="float:left; border:0px;"/>';
						}
					} else {
						//echo"<div class='logodiv'>$get_db_CompanyName</div>";
					}
					?>
				</div>
<?php
include"includes/buttons.php";
?>
			</div>
	
		<div id='main'>
			<article style="margin-bottom:70px;">
                        <?php
				if($user_purchasesReturns!=="1" and $user_IsAdmin!=1){
				echo"<div style='margin-top:200px;text-align:center;font-family:Tahoma, Geneva, sans-serif;color:#666; font-weight:bold; font-size:14px;'>'.$not_have_permission_lang.'</div>";
				}else{ ?>
				<div>
					<div style="width:60%;border:1px solid #CCC; border-radius:5px; float:right;">
						<div>
							<img src="images/Client.png" style="width:5%; border:0px; float:right; vertical-align:middle;" />
							<input type="search" name="code" value="" id="searchcl" onkeyup="showResults(this.value)"  autocomplete="off" style="float:right; text-align:center; padding-left:0px; margin-left:0px;  height:25px; width:40%; background-color:#CCC;"/>
							<div id="livesearchcl" style="z-index:1000000000; width:45%;  text-align:right; margin-top:30px;  float:right; position:fixed; border:0px; "></div>
							<div style="width:100%; padding-top:10px; text-align:center; margin:0 auto;border:0px solid #CCC; border-radius:5px;"">
<?php
if(isset($_GET['suspend'])){
								if(mysqli_query($con, "INSERT INTO ".$prefix."_receivings_suspended(item, Price, Quantity, unit, Discount, Total, SupplierID, BuyPrice, date, type, subqty, size, color, user_id)
SELECT item,Price,Quantity,unit,Discount,Total,SupplierID,BuyPrice,date,type,subqty,size,color,user_id from ".$prefix."_receivings_temporary")){
	if(mysqli_query($con,"DELETE FROM ".$prefix."_receivings_temporary where user_id='$user_id'")){

$report_suspend='1';

	}	
}
								}
?>

        <?php
$result_receivings_suspended = mysqli_query($con, "SELECT id FROM ".$prefix."_receivings_suspended");
if (@mysqli_num_rows($result_receivings_suspended)>=1) {
echo'<a href="receivings_returns.php?unsuspend"><img src="images/unsuspend.png" style="width:30px; height:30px; border:0px; float:left;" title="'.$unsuspend_lang.'" /></a>';
}else{
echo'<a href="receivings_returns.php?suspend"><img src="images/suspend.png" style="width:30px; height:30px; border:0px; float:left;" title="'.$suspense_lang.'"  /></a>';
}
?>
        <a href="receivings_returns.php?q=d"><img src="images/c.png" style="width:30px; height:30px; float:left; border:0px;"  title="<?php echo"$Returns_Purchases_lang"; ?>" /></a> <a href="receivings.php"><img src="images/Sales.png" style="width:30px; height:30px; float:left; border:0px;" title="<?php echo"$Purchases_lang"; ?>" /></a>
                                    <?php
							if($_GET['print_inv']!==null){ 
																							##############
							$result_Get_supplier = mysqli_query($con, "SELECT  supplier  FROM ".$prefix."_receivings_inv where  inv_id=".$_GET['print_inv']."");
							while ($row_Get_supplier = mysqli_fetch_array($result_Get_supplier)) {
								$GsupplierID=$row_Get_supplier['supplier'];
							}
								##############
							?>
<a href="#" onclick="javascript:void window.open('invoice.php?id=<?php echo"".$_GET['print_inv'].""; ?>&type=receivings_returns','1390937502641','width=700,height=600,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0,menubar=0');return false;"><img src="images/print_icon.gif" style="width:30px; height:30px; float:left; border:0px;" title="<?php echo"$Print_previous_bill_lang"; ?>" /></a>
<?php if($GsupplierID==null){}else{ ?>
<a href="#" onclick="javascript:void window.open('statement_of_account_suppliers.php?id=<?php echo"".$GsupplierID.""; ?>&from=<?php echo"".date("Y-m-01").""; ?>&to=<?php echo"".date("Y-m-d").""; ?>','1390937502641','width=1024,height=600,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0,menubar=0');return false;"><img src="images/arrears_list.gif" style="float:left; border:0px; margin-top:10px;" title="<?php echo"$client_statement_lang"; ?>" /></a>
<?php } ?>
 <?php } ?>
         <?php echo"$Returns_Purchases_lang"; ?></div>
              <div style="width:100%; padding-top:0px; text-align:center; margin:0 auto;border:0px dashed #CCC; border-radius:5px; height:290px; overflow:auto;">
                            <?php
							if($report_suspend=="1"){
								echo'<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$suspended_bill_lang.'
							</div>';
							header("refresh:1;url=receivings_returns.php");
								}
							if(is_numeric($_POST['submit'])==1 and $_POST['submit']!=null){
								
								#############
								$result_upt = mysqli_query($con, "SELECT * FROM ".$prefix."_receivings_temporary where user_id='$user_id' order by id DESC");
							while ($row_upt = mysqli_fetch_array($result_upt)) {
								//echo $row_up['id'];
								$itemt=round($_POST[item.$row_upt['id']]);
								$quantityt=round($_POST[quantity.$row_upt['id']]);
								$Pricet=$_POST[price.$row_upt['id']];
								$Discountt=round($_POST[discount.$row_upt['id']]);
								if ($Discount_type==1) {
									$DiscountValuet=$Discountt;
								} else if ($Discount_type==2) {
									if($Discount==0){$DiscountValuet=$Discountt;}else{
									$DiscountValuet=($quantityt * $Pricet) * ($Discountt/100);
									}
								} else {
									$DiscountValuet=$Discountt;
								}
								$Totalt= ($quantityt*$Pricet)-$DiscountValuet;
								$inv_Totalt+=($quantityt*$Pricet)-$DiscountValuet;
							}
								#############
								$pay=$_POST['pay'];
$_POST['date']=str_replace("/", "-", $_POST['date']);
$DueDate=Trim(date('Y-m-d',strtotime($_POST['date'])));
$paid=trim($_POST['paid']);

								$alldiscount=$_POST['alldiscount'];
								$CheckNumber='';
								##########مدفوعات الموردين############
													if($_POST['SupplierID']=="" and $paid!=abs($inv_Totalt+$alldiscount))	{
						//print $paid;
														echo'<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/close.png" style="border:0px;" /></span>
						'.$must_choose_Supplier.'
							</div>';
					}else  if ($_POST['safe_id'] == ""  and  $paid > 0) {
                                                        echo'<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/close.png" style="border:0px;" /></span>
							'.$must_choose_safe.'
							</div>';
                                                    }
//													else  if ($_POST['branch_id'] == "" ) {
//                                                        echo'<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
//							<span style="float:left; padding-left:20px;"><img src="images/close.png" style="border:0px;" /></span>
//							'.$must_choose_branch.'
//							</div>';
//                                                    }
													else  if ($_POST['store_id'] == "" ) {
                                                        echo'<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/close.png" style="border:0px;" /></span>
							'.$must_choose_store.'
							</div>';
                                                    }else{
								if($paid<0 or $paid==null or $paid==""){}else{
$sqlpayments_suppliers="INSERT INTO ".$prefix."_receivings_inv (safe_id,branch_id,store_id,supplier, Total, date, PaymentMethod, DueDate, notes, type, discount)
VALUES ('".$_POST['safe_id'] . "','". $_POST['branch_id'] . "','". $_POST['store_id']."','".$_POST['SupplierID']."','".$paid."','".$DueDate."','".$pay."','','".$notes."','2','".$alldiscount."')";
if (!mysqli_query($con,$sqlpayments_suppliers))
  {
	  echo"$Error_lang";
  }else{
	  }
							
								}

								############################
mysqli_query($con, "UPDATE ".$prefix."_config SET  LastreceivingsInvoiceNo= LastreceivingsInvoiceNo + 1 where id=".$get_db_id."");
$result_LastInvoiceNo = mysqli_query($con,"SELECT LastreceivingsInvoiceNo FROM ".$prefix."_config where id='1'");
while($row_LastInvoiceNo = mysqli_fetch_array($result_LastInvoiceNo))
  {
$get_LastInvoiceNo=$row_LastInvoiceNo['LastreceivingsInvoiceNo'];
  }

                                                        $pp=1;
                                                        if($alldiscount<=0){}else{
                                                            $sqlpayments="INSERT INTO ".$prefix."_receivings_inv (safe_id,branch_id,store_id,supplier,inv_id, Total, date, PaymentMethod, DueDate, notes, type, discount)
VALUES ('".$_POST['safe_id'] . "','". $_POST['branch_id'] . "','". $_POST['store_id']."','".$_POST['SupplierID']."','".$get_LastInvoiceNo."','".$alldiscount."','".$DueDate."','".$pay."','','خصم نقدى','3','".$alldiscount."')";
                                                            if (!mysqli_query($con,$sqlpayments))
                                                            {
                                                                echo"$Error_lang";
                                                            }else{
                                                                $pp=1;
                                                            }
                                                        }
######################
if($pp==1){
$sqlt="INSERT INTO ".$prefix."_treasury (type, Amount, date, notes)
VALUES ('9','".($paid)."','".$DueDate."','مرتجعات مشتريات ".$get_LastInvoiceNo."')";

	if (!mysqli_query($con,$sqlt))
  {
	 // die($paid);
  }
}
######################
								$result_up = mysqli_query($con, "SELECT * FROM ".$prefix."_receivings_temporary where user_id='$user_id' order by id DESC");
							while ($row_up = mysqli_fetch_array($result_up)) {
								//echo $row_up['id'];
								$item=round($_POST[item.$row_up['id']]);
								$quantity =round($_POST[quantity.$row_up['id']]);
								$unit=round($_POST[unit.$row_up['id']]);
								if($Retail_allow==1){}else{$unit="1";}
								$Price=$_POST[price.$row_up['id']];
                                                                 $size=$_POST[size.$row_up['id']];
                                                                $color=$_POST[color.$row_up['id']];
								$Discount=round($_POST[discount.$row_up['id']]);
								if ($Discount_type==1) {
									$DiscountValue=$Discount;
								} else if ($Discount_type==2) {
									if($Discount==0){$DiscountValue=$Discount;}else{
									$DiscountValue=($quantity * $Price) * ($Discount/100);
									}
								} else {
									$DiscountValue=$Discount;
								}
								$Total= ($quantity*$Price)-$DiscountValue;
								$inv_Total+=($quantity*$Price)-$DiscountValue;
if(mysqli_query($con, "UPDATE ".$prefix."_receivings_temporary SET   inv_id='".$get_LastInvoiceNo."',Quantity='".$quantity."',Price=(select price from items where id='".$item."'),Discount='".$Discount."',Total='".$Total."',type='1',BuyPrice='".$Price."',color='".$color."',size='".$size."',user_id='".$user_id."' where  id='".$row_up['id']."'")){
#############التأثير على المخزون###########
//if(mysqli_query($con, "UPDATE items SET Quantity=Quantity+$quantity where  id='".$row_up['item']."'")){}
###########################################	
	}
								//echo"<br />";
							}
								######################
							 $sql ="INSERT INTO ".$prefix."_receivings_inv(safe_id,branch_id,store_id,inv_id, date, Total, supplier, PaymentMethod, DueDate, CheckNumber, notes, type, paid, discount)
VALUES ('".$_POST['safe_id'] . "','". $_POST['branch_id'] . "','". $_POST['store_id']."','".$get_LastInvoiceNo."','".$DueDate."','".$inv_Total."','".$_POST['SupplierID']."','".$pay."','','".$CheckNumber."','".$notes."','2','".$paid."','".$alldiscount."')";
if(mysqli_query($con, $sql)){
$Report_Create_Invoice=1;
	##############
if(mysqli_query($con, "INSERT INTO ".$prefix."_receivings(inv_id, item, Price, Quantity, unit, Discount, Total, SupplierID, BuyPrice, date, type, subqty, size, color, user_id)
SELECT inv_id,item,Price, IF(unit = '2', (Quantity/subqty),Quantity) ,unit,Discount,Total,SupplierID,BuyPrice,date,type,subqty,size,color,user_id from ".$prefix."_receivings_temporary")){
$Report_Record_purchases=1;
}else{$Report_Record_purchases=0;}
	###############
	}else{$Report_Create_Invoice=0;}
################
	################################
if(mysqli_query($con,"DELETE FROM ".$prefix."_receivings_temporary where user_id='$user_id'")){
	header("refresh:0;url=receivings_returns.php?print_inv=".$get_LastInvoiceNo."");
	}
								//echo $inv_Total;
								######################
					}
								}	
															
							if($_GET['del']!==null){
if(mysqli_query($con,"DELETE FROM ".$prefix."_receivings_temporary where user_id='$user_id' and id=".$_GET['del']."")){
													echo '<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
						'.$Item_deleted_lang.'
							</div>';
							header("refresh:0;url=receivings_returns.php");
	}
}
							if(isset($_POST['submit'])){
								
							$result_up = mysqli_query($con, "SELECT * FROM ".$prefix."_receivings_temporary where user_id='$user_id' order by id DESC");
							while ($row_up = mysqli_fetch_array($result_up)) {
//								echo $row_up['id'];
								$quantity=round($_POST[quantity.$row_up['id']]);
								$Price=$_POST[price.$row_up['id']];
								$Discount=round($_POST[discount.$row_up['id']]);
								$item=round($_POST[item.$row_up['id']]);
								$unit=round($_POST[unit.$row_up['id']]);
								if($Retail_allow==1){}else{$unit="1";}

								$BuyPrice=$_POST[price.$row_up['id']];
                                                                 $size=$_POST[size.$row_up['id']];
                                                                $color=$_POST[color.$row_up['id']];
								if ($Discount_type==1) {
									$DiscountValue=$Discount;
								} else if ($Discount_type==2) {
									if($Discount==0){$DiscountValue=$Discount;}else{
									$DiscountValue=($quantity * $Price) * ($Discount/100);
									}
								} else {
									$DiscountValue=$Discount;
								}
								$Total= ($quantity*$Price)-$DiscountValue;
								if($quantity!=0){

 $sql = "UPDATE ".$prefix."_receivings_temporary SET  Quantity=".$quantity.",unit=".$unit.",Price=".$BuyPrice.",Discount=".$Discount.",Total=".$Total.",type='1',BuyPrice=".$Price.",color='".$color."',size='".$size."',user_id='$user_id' where  id='".$row_up['id']."'" ;
mysqli_query($con, $sql);
								}else{
									//
									$error_reports=1;
									}
								//echo"<br />";
							}
							}
							###########################################
							if($error_reports=="1"){
								echo '<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/close.png" style="border:0px;" /></span>
							'.$quantity_not_zero_lang.'
							</div>';
								}
                            ?>
							<?php
							if(isset($_GET['SupplierID']) and $_GET['SupplierID']!==null){
							$SupplierID=$_GET['SupplierID'];
 if(mysqli_query($con,"UPDATE ".$prefix."_receivings_temporary SET SupplierID=".$SupplierID." where user_id='$user_id'")){
	 header("refresh:0;url=receivings_returns.php");
		  }else{
			  echo"$Please_try_again_lang";
			  }
							}
							if(isset($_GET['barcode']) and $_GET['barcode']!==null and $_GET['barcode']!=="'.$barcode_lang.'" ){
                                                                            $get_barcode= explode("-", $_GET['barcode']);
                                        $get_barcode_code=$get_barcode[0];
                                        $get_barcode_size=$get_barcode[1];
                                        $get_barcode_color=$get_barcode[2];
$result_barcode = mysqli_query($con, "SELECT id FROM items where Barcode='".$get_barcode_code."'");
if (@mysqli_num_rows($result_barcode)>=1) {
while ($row_barcode = mysqli_fetch_array($result_barcode)) {
	$db_item_id=$row_barcode['id'];											
}
}
//$db_item_id;
###################
######################
####################
								if ($_GET['barcode']==null) {
									//	header( "refresh:0;url=receivings_returns.php" );
								} else {
										$result_new = mysqli_query($con, "SELECT * FROM items where id='".$db_item_id."'");
										if (@mysqli_num_rows($result_new)>=1) {

											while ($row_new = mysqli_fetch_array($result_new)) {
												$item_name_new = $row_new['item'];
												$item_subqty_new=$row_new['subqty'];
												$item_id_new = $row_new['id'];
												$item_Retail_price_new = $row_new['Retail_price'];
												$item_Discount_new = $row_new['Discount'];
												$item_price_new = $row_new['price'];
												if ($Discount_type == 1) {
													$item_total_new = $row_new['price'] - $row_new['Discount'];
												} else if ($Discount_type == 2) {
													$item_total_new = $row_new['price'] - (($row_new['price']) * ($row_new['Discount'] / 100));
												} else {$item_total_new = $row_new['price'];
												}
												$sql = "INSERT INTO ".$prefix."_receivings_temporary (item, Price, Quantity, Discount, Total, BuyPrice, date, type, subqty, size, color, user_id)
							VALUES ('".$item_id_new."','".$item_Retail_price_new."','1','".$row_new['Discount']."','".$item_total_new."','".$item_price_new."','".$DueDate."','1','".$item_subqty_new."','" . $get_barcode_size . "','" . $get_barcode_color . "','".$user_id."')";

											}
											if (!mysqli_query($con, $sql)) {
												echo '<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$not_saved_try_lang.'
							</div>';
												header("refresh:5;url=receivings_returns.php");
											} else {
												echo '<div style="text-align:center; background-color:#95D183; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$Added_Item_lang.'
							</div>';
												header("refresh:1;url=receivings_returns.php");
											}
										} else {
											echo '<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$item_not_found_lang.'
							</div>';
										}

								}
					
}

							if ($_GET['q']=="d") {
								if (mysqli_query($con, "DELETE FROM ".$prefix."_receivings_temporary where user_id='$user_id'")) {
									header("refresh:0;url=receivings_returns.php");
								}
							} else {
								if ($_GET['q']==null) {
									//	header( "refresh:0;url=receivings_returns.php" );
								} else {
										$result_new = mysqli_query($con, "SELECT * FROM items where id='".$_GET['q']."'");
										if (@mysqli_num_rows($result_new)>=1) {

											while ($row_new = mysqli_fetch_array($result_new)) {
												$item_name_new = $row_new['item'];
												$item_id_new = $row_new['id'];
												$item_subqty_new = $row_new['subqty'];
												$item_Retail_price_new = $row_new['Retail_price'];
												$item_Discount_new = $row_new['Discount'];
												$item_price_new = $row_new['price'];
												
												if ($Discount_type == 1) {
													$item_total_new = $row_new['price'] - $row_new['Discount'];
												} else if ($Discount_type == 2) {
													$item_total_new = $row_new['price'] - (($row_new['price']) * ($row_new['Discount'] / 100));
												} else {$item_total_new = $row_new['price'];
												}
$sql = "INSERT INTO ".$prefix."_receivings_temporary (item, Price, Quantity, unit, Discount, Total, type, date, BuyPrice, subqty, size ,color, user_id)
VALUES ('".$item_id_new."','".$item_Retail_price_new."','1','1','".$row_new['Discount']."','".$item_total_new."','1','".$DueDate."','".$item_price_new."','".$item_subqty_new."','" . $get_barcode_size . "','" . $get_barcode_color . "','".$user_id."')";

											}
											if (!mysqli_query($con, $sql)) {
												echo '<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$not_saved_try_lang.'
							</div>';
												header("refresh:5;url=receivings_returns.php");
											} else {
												echo '<div style="text-align:center; background-color:#95D183; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$Added_Item_lang.'
							</div>';
												header("refresh:1;url=receivings_returns.php");
											}
										} else {
											echo '<div style="text-align:center; background-color:#E18C80; border-radius:5px;">
							<span style="float:left; padding-left:20px;"><img src="images/chmarkicon.png" style="border:0px;" /></span>
							'.$item_not_found_lang.'
							</div>';
										}

								}
							}
							?>
							<form method="post">
                            <?php 
		   $result_SupplierID = mysqli_query($con,"SELECT SupplierID FROM ".$prefix."_receivings_temporary where user_id='$user_id' limit 0,1");
if(@mysqli_num_rows($result_SupplierID)>0){
while($row_SupplierID= mysqli_fetch_array($result_SupplierID))
  {
		   $result_search_suppliers = mysqli_query($con,"SELECT id,name FROM ".$prefix."_suppliers WHERE id=".$row_SupplierID['SupplierID']."");
if(@mysqli_num_rows($result_search_suppliers)>0){
while($row_search_suppliers= mysqli_fetch_array($result_search_suppliers))
  {
		   echo"\r\n";
          echo'<div style="font-size:16px;"><span dir="rtl">'.$The_Supplier_lang.': </span> 
			<span style="color:#7D060F;" dir="rtl">'.$row_search_suppliers['name'].'</span></div>';
			echo'<input type="hidden" name="SupplierID" value="'.$row_search_suppliers['id'].'" />';
  }
}}
}
				   ?> 
							<table  border="1" style="font-size:16px; width:100%;  direction:rtl; border:1px; border-collapse:collapse; margin-top:10px; text-align:center;">

							<thead style="background-color:#0076EA; color:#fff;">
							<th  width="5%" class="text-center"><?php echo"$Serial_lang"; ?></th>
							 <th width="35%" class="text-center"><?php echo"$the_Item_lang"; ?></th>
							<th class="text-center"><?php echo"$the_Quantity_lang"; ?></th>
                                                       <?php if($use_sizes==1){echo'<th class="text-center">'.$the_Size_lang.'</th>';} ?>
                                                 
       <?php if($use_colors==1){echo'<th class="text-center">'.$the_Color_lang.'</th>';} ?>
                           <?php if($Retail_allow==0){}else{echo"<th class='text-center'>".$measruing_unit."</th>";} ?>
                            
							<th class="text-center"><?php echo"$the_Price_lang"; ?></th>
							<th class="text-center"><?php echo"$the_Discount_lang"; ?></th>
							<th class="text-center"><?php echo"$the_total_lang"; ?></th>
							<th class="text-center"><?php echo"$Delete_lang"; ?></th>
							</thead>
							<tbody>
							<?php

							$tbl_name = "".$prefix."_receivings_temporary";
							//your table name
							// How many adjacent pages should be shown on each side?
							$adjacents = 3;

							/*
							 First get total number of rows in data table.
							 If you have a WHERE clause in your query, make sure you mirror it here.
							 */
							$query = "SELECT COUNT(*) as num  FROM  ".$prefix."_receivings_temporary where user_id='$user_id' order by id DESC";
							$total_pages = @mysqli_fetch_array(mysqli_query($con, $query));
							$total_pages = $total_pages[num];

							/* Setup vars for query. */
							$targetpage = "limit=" . $_GET['limit'] . "";
							//your file name  (the name of this file)
							//how many items to show per page
							if (!empty($_GET['limit'])) {
								$_SESSION[limit] = $_GET['limit'];
							} else {
							}
							if (!empty($_SESSION[limit])) {
								$limit = $_SESSION[limit];
								if ($limit > 100) {$limit = 20;
								}
							} else {
								$limit = 100;
							}
							$page = $_GET['page'];
							if ($page)
								$start = ($page - 1) * $limit;
							//first item to display on this page
							else
								$start = 0;
							//if no page var is given, set start to 0

							/* Get data. */
							$sql = "SELECT * FROM ".$prefix."_receivings_temporary where user_id='$user_id' order by id DESC";

							$result = @mysqli_query($con, $sql);
							/* Setup page vars for display. */
							if ($page == 0)
								$page = 1;
							//if no page var is given, default to 1.
							$prev = $page - 1;
							//previous page is page - 1
							$next = $page + 1;
							//next page is page + 1
							$lastpage = ceil($total_pages / $limit);
							//lastpage is = total pages / items per page, rounded up.
							$lpm1 = $lastpage - 1;
							//last page minus 1

							/*
							 Now we apply our rules and draw the pagination object.
							 We're actually saving the code to a variable in case we want to draw it more than once.
							 */
							$pagination = "";
							if ($lastpage > 1) {
								$pagination .= "<div class=\"pagination\">";
								//previous button
								if ($page > 1)
									$pagination .= "<a href=\"$targetpage&page=$prev\">>></a>";
								else
									$pagination .= "<span class=\"disabled\">>></span>";

								//pages
								if ($lastpage < 7 + ($adjacents * 2))//not enough pages to bother breaking it up
								{
									for ($counter = 1; $counter <= $lastpage; $counter++) {
										if ($counter == $page)
											$pagination .= "<span class=\"current\">$counter</span>";
										else
											$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
									}
								} elseif ($lastpage > 5 + ($adjacents * 2))//enough pages to hide some
								{
									//close to beginning; only hide later pages
									if ($page < 1 + ($adjacents * 2)) {
										for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
											if ($counter == $page)
												$pagination .= "<span class=\"current\">$counter</span>";
											else
												$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
										}
										$pagination .= "...";
										$pagination .= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
										$pagination .= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";
									}
									//in middle; hide some front and some back
									elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
										$pagination .= "<a href=\"$targetpage&page=1\">1</a>";
										$pagination .= "<a href=\"$targetpage&page=2\">2</a>";
										$pagination .= "...";
										for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
											if ($counter == $page)
												$pagination .= "<span class=\"current\">$counter</span>";
											else
												$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
										}
										$pagination .= "...";

										$pagination .= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
										$pagination .= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";
									}
									//close to end; only hide early pages
									else {
										$pagination .= "<a href=\"$targetpage&page=1\">1</a>";
										$pagination .= "<a href=\"$targetpage&page=2\">2</a>";
										$pagination .= "...";
										for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
											if ($counter == $page)
												$pagination .= "<span class=\"current\">$counter</span>";
											else
												$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
										}
									}
								}

								//next button
								if ($page < $counter - 1)
									$pagination .= "<a href=\"$targetpage&page=$next\"><<</a>";
								else
									$pagination .= "<span class=\"disabled\"><<</span>";
								$pagination .= "</div>\n";
							}
							###############
							$i = 1;
							while ($row = @mysqli_fetch_array($result)) {
								###########
								$result_it = mysqli_query($con, "SELECT * FROM items where id=".$row['item']."");
								if (@mysqli_num_rows($result_it) > 0) {
									while ($row_it=mysqli_fetch_array($result_it)) {
										$item_name=$row_it['item'];
										$item_id=$row_it['id'];
										$item_price=$row_it['Retail_price'];
										$item_Discount = $row_it['Discount'];
										$item_BuyPrice= $row_it['price'];
										$item_BuyPrice= $row_it['price'];
										$item_subqty=$row_it['subqty'];
									}
								}
								if ($item_Discount == null) {
									$item_Discount = 0;
								}
/*								if ($row['Quantity'] < 1) {
									$row['Quantity'] = 1;
								}*/

								if ($item_Discount == null) {
									$item_Discount = 0;
								}
								$sumTotal+= $row['Total'];
								###########
								#############تحديث سعر الشراء#####
								if($Update_SellBuyPrice==1){
mysqli_query($con, "UPDATE items SET Price='".$row['BuyPrice']."' where id='".$row['item']."'");
								}
###############################################################################
$unit_option1=null;                         if(is_float($i/2)){
                                                        $gr="gr";
                                                    }else{
                                                        $gr="gr2";
                                                    }
$unit_option2=null;
if($row['unit']=="1"){$unit_option1=' selected="selected"';}
if($row['unit']=="2"){$unit_option2=' selected="selected"';}
								echo'<input type="hidden" name="BuyPrice'.$row['id'].'" value="'.$item_BuyPrice.'" /><tr  class="'.$gr.'">
							<td>'.$i.'</td>
							<td><input type="hidden" name="item'.$row['id'].'" value="'.$item_id.'" />'.$item_name.'</td>
							<td><input type="number" name="quantity'.$row['id'].'"  value="'.$row['Quantity'].'" style="width:10%; height:20px; text-align:center;border:0px;"/></td>'; ?>
							<?php
                                               if($use_sizes==1){
                                                                     echo'<td><select  class="'.$gr.'" name="size'.$row['id'].'" style="height:25px; width:10px; text-align:center;border:0px;">';
                                                                          $result_sizes = @mysqli_query($con, "SELECT * FROM sizes where id in (".rtrim(get_sizes_of_item($item_id), ",").") limit 15");
                                                                        $num_sizes = @mysqli_num_rows($result_sizes);
                                                                        if ($num_sizes > 0) {
                                                                            while ($row_sizes = mysqli_fetch_array($result_sizes)) {
                    if ($row['size'] == $row_sizes['id']) {
                        echo '<option value="' . $row_sizes['id'] . '" selected >' . $row_sizes['size'] . '</option >';
                    } else {
                        echo '<option value="' . $row_sizes['id'] . '">' . $row_sizes['size'] . '</option >';
                    }
                                                                            }
                                                                        }
                                                
                                              echo'</select></td>';
                                               }
                                               if($use_colors==1){
                                               echo'<td><select  class="'.$gr.'" name="color'.$row['id'].'" style="height:25px; text-align:center;border:0px;">';
                                  $result_colors = @mysqli_query($con, "SELECT * FROM colors where status!=3 and  id in (".rtrim(get_clolors_of_item($item_id), ",").")  ");
            $num_colors = @mysqli_num_rows($result_colors);
            if ($num_colors > 0) {
                while ($row_colors = mysqli_fetch_array($result_colors)) {
                    if ($row['color'] == $row_colors['id']) {
                        echo '<option value="' . $row_colors['id'] . '" selected >' . $row_colors['color'] . '</option >';
                    } else {
                        echo '<option value="' . $row_colors['id'] . '">' . $row_colors['color'] . '</option >';
                    }
                }
            }
                                               echo'</select></td>';
                                               }
                                                ?>
                                                            <?php if($Retail_allow==0){}else{ ?>
							<td><select  class="'.$gr.'" name="unit'.$row['id'].'" style="height:25px; text-align:center;border:0px;"><option value="1" <?php echo"$unit_option1"; ?>><?php echo"$primary_unit_lang"; ?></option><option value="2" <?php echo"$unit_option2"; ?>><?php echo"$Sub_unit_lang"; ?></option></select></td>
                            <?php } ?>
							<?php echo'<td><input  class="'.$gr.'" type="text"  name="price'.$row['id'].'"  value="'.$row['BuyPrice'].'"  style="width:10%; height:20px;text-align:center;border:0px;" /></td>
							<td><input  class="'.$gr.'" type="number"  name="discount'.$row['id'].'" id="discount'.$i.'" value="'.$row['Discount'].'"  style="width:10%; height:20px;text-align:center;border:0px;" /></td>
							<td><input  class="'.$gr.'" type="text"  name="subtotal'.$row['id'].'" id="subtotal'.$i.'" value="'.$row['Total'].'"  style="width:10%; height:20px;text-align:center;border:0px;" /></td>
							<td valign="middle"><a href="receivings_returns.php?del='.$row['id'].'"><img src="images/erase.png" style="border:0px;" /></a></td>
							</tr>';
								$i++;
							}
							?>
                            </tbody>
                            <?php
							if($sumTotal==null){}else{
                            echo'<tr>';
                            
                           if($use_sizes==1){
                                 if($use_colors=1){echo'<td colspan="7">'.$the_total_lang.'</td>';}else{echo'<td colspan="6">'.$the_total_lang.'</td>';}
                               
                           }else{
                               if($use_colors=1){echo'<td colspan="5">'.$the_total_lang.'</td>';}else{echo'<td colspan="4">'.$the_total_lang.'</td>';}
                           }
                           echo' <td><font style="color:#060; font-weight:bold;">'.($sumTotal+$alldiscount).'</font></td>
                            <td></td>
                            </tr>';
                            } ?>
							</table>
                            
							<input type="submit" name="submit" value="submit" hidden="hidden" />
							
							</div>
                            <table width="100%" dir="rtl">
                            <tr>
                            <td style="font-size:16px;"><?php echo"$payment_method_alng"; ?></td>
                            <td><select name="pay"   style="text-align:center;background-color:#CCC; float:right;">
							<option value="1" <?php
								if ($_POST['pay'] == "1") {echo ' selected="selected"';
								}
 ?>><?php echo"$cash_lang"; ?></option>
							<option value="2" <?php
								if ($_POST['pay'] == "2") {echo ' selected="selected"';
								}
 ?>><?php echo"$On_credit_lang"; ?></option>
							<option value="3" <?php
								if ($_POST['pay'] == "3") {echo ' selected="selected"';
								}
 ?>><?php echo"$check_lang"; ?></option>
							</select></td>
                            <td style="font-size:16px;"><?php echo"$amount_paid_lang"; ?></td>
                            <td style="font-size:16px;"><input type="text" name="paid" id="price" value="<?php echo"".$_POST['paid'].""; ?>" onkeypress='validate(event)'  style="text-align:center; background-color:#CCC; width:50px; height:20px;"/></td>
                            <td style="font-size:16px;"><?php echo"$the_date_lang"; ?></td>
                            <td><input type="text" name="date" id="date" value="<?php if($_POST['date']==""){echo date("d/m/Y");}else{echo"".$_POST['date']."";} ?>"  style="text-align:center; background-color:#CCC; width:80px; height:20px;"/>
                            <script type="text/javascript">
				$('#date').dateEntry({dateFormat: 'dmy/', spinnerImage:''});
			</script>
                            </td>
                            </tr>
                            <tr>
                            <td style="font-size:16px;"><?php echo"$Discount_lang"; ?></td>
                             <td colspan="6"><input type="text" name="alldiscount" value="<?php echo"".$_POST['alldiscount'].""; ?>"  style="text-align:center; background-color:#CCC; width:50px; height:20px;"/></td>
                            </tr>

                                <tr>
                                    <td style="font-size:16px;"  class="text-left"><?php echo $Store_name; ?></td>
                                    <td >

                                        <select name="store_id" size="1" class="js-example-placeholder-single  js-states form-control">
                                            <option value=""> <?php echo"$Store_name"; ?></option>
                                            <?php
                                            $ProductsName = mysqli_query($con, "SELECT * FROM ".$prefix."_store order by id ASC");
                                            $num_item = mysqli_num_rows($ProductsName);
                                            if ($num_item > 0) {
                                                while ($row_item = mysqli_fetch_array($ProductsName)) {
                                                    if ($row_item['id'] == $_POST['store_id']) {
                                                        echo'<option value="' . $row_item['id'] . '"   selected="selected">' . $row_item['name'] . '</option>';
                                                    } else {
                                                        echo'<option value="' . $row_item['id'] . '">' . $row_item['name'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>


                                    </td>
                                    <td style="font-size:16px;"  class="text-left"><?php echo $treasury_name_lang; ?></td>
                                    <td >

                                        <select name="safe_id" size="1" class="js-example-placeholder-single  js-states form-control">
                                            <option value=""> <?php echo"$treasury_name_lang"; ?></option>
                                            <?php
                                            $ProductsName = mysqli_query($con, "SELECT * FROM ".$prefix."_safe order by id ASC");
                                            $num_item = mysqli_num_rows($ProductsName);
                                            if ($num_item > 0) {
                                                while ($row_item = mysqli_fetch_array($ProductsName)) {
                                                    if ($row_item['id'] == $_POST['safe_id']) {
                                                        echo'<option value="' . $row_item['id'] . '"   selected="selected">' . $row_item['name'] . '</option>';
                                                    } else {
                                                        echo'<option value="' . $row_item['id'] . '">' . $row_item['name'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>


                                    </td>
                                    <td hidden style="font-size:16px;"  class="text-left"><?php echo $the_branch_name_lang; ?></td>
                                    <td hidden>
                                        <?php if (!$_POST['branch_id'] ){ $selected_branch = $order_data[0]['branch_id'] ;}else if ($_POST['branch_id']){

                                            $selected_branch = $_POST['branch_id'] ;
                                        }?>

                                        <select name="branch_id" size="1" class="js-example-placeholder-single  js-states form-control">
                                            <option value=""> <?php echo"$the_branch_name_lang"; ?></option>
                                            <?php
                                            $ProductsName = mysqli_query($con, "SELECT * FROM ".$prefix."_branch order by id ASC");
                                            $num_item = mysqli_num_rows($ProductsName);
                                            if ($num_item > 0) {
                                                while ($row_item = mysqli_fetch_array($ProductsName)) {
                                                    if ($row_item['id'] == $selected_branch) {
                                                        echo'<option value="' . $row_item['id'] . '"   selected="selected">' . $row_item['name'] . '</option>';
                                                    } else {
                                                        echo'<option value="' . $row_item['id'] . '">' . $row_item['name'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>


                                    </td>

                                </tr>
                                <tr >
                                    <td  style="font-size:16px;" class="text-left"><?php echo $notes_lang; ?></td>
                                    <!--                                            --><?php //echo"$Discount_lang"; ?>
                                    </td>
                                    <td style="font-size:16px;" colspan="3">
                                        <textarea class="form-control" style="text-align: center" name="notes" ><?php echo $_POST['notes'];?></textarea>
                                    </td>

                                </tr>
                            <tr>
                              <td colspan="6" align="center"><span style=" text-align:center; margin-right:50px;">
                                <input type="submit" name="submit" value="<?php echo ($sumTotal+$alldiscount);?>"  style="width:120px; height:40px;"/>
                              </span></td>
                              </tr>
                            </table>
							<div style="text-align:right; float:right;">
							<div style="float:right; width:200px; margin-right:150px; vertical-align:middle;">
							
							

							
							</div>
							<div style="float:right; text-align:center; margin-right:50px;">
							  <?php /*?>                            <button style="width:120px; height:60px;" onclick="javascript:location.href='receivings_returns.php'"><?php echo $sumTotal;?> :الاجمالى</button><?php */?>
</div>
							</div>
							</div>
                            <input type="hidden" name="inv" value="receivings" />
</form>
							</div>
							<div style="width:100%;border:1px solid #CCC; border-radius:5px;">
							<div style="height:500px; overflow:auto;">
							<script>
								window.onload = function() {
									document.getElementById("barcode").focus();
								};

							</script>
							<form method="get" style="padding-bottom:20px;">
							<div class="text-center">
                            <?php
							if($run_barcode==0){}else{ ?>
                            <input type="text" value="<?php
								if ($_GET['barcode']==null) {
								} else {echo "".$_GET['barcode']."";
								}
 ?>"  name="barcode" id="barcode"    style="background-color:#CCC;"
							onblur="this.value=!this.value?'<?php echo"$barcode_lang"; ?>':this.value;" onfocus="this.select()"/>
                            <?php } ?>
                            <a href="#" onclick="javascript:void window.open('additems.php','1390937502641','width=400,height=400,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0,menubar=0');return false;">
                                <i class="fa fa-plus-square"  title="<?php echo"$Add_New_Item_lang"; ?>"></i>
                            </a>
                            <span style="padding-right:20px;"></span><input type="search" value="<?php echo"$item_Name_lang"; ?>"  style="background-color:#CCC; z-index:100000000000;"  onkeyup="showResultsOfItems(this.value)" autocomplete="off"    onclick="this.value='';" onfocus="this.select()"  onblur="this.value=!this.value?'<?php echo"$item_Name_lang"; ?>':this.value;"/>
							<div id="livesearch" style="z-index:1000000000; width:45%;  text-align:right; margin-top:0px;  float:right; position:fixed; border:0px; "></div>
							<input type="submit" hidden="hidden"/>
                                     <?php
                            if($db_cat_items_show==0 or $db_cat_items_show==null or $db_cat_items_show==""){}else{
echo'<a href="?cat_show=0"><i class="fa fa-list" title="'.$All_groups_lang.'"></i>
</a>';
							}
?>

							</form></div>
                            <?php
							if($showGroups==0){}else{ ?>
                                <?php if($db_cat_items_show>0){}else{ ?>                          
                            <div style="width:100%; margin:0 auto; text-align:center; float:right; text-align:center;">

                            <?php
							$result_cat=mysqli_query($con, "SELECT * FROM products where rank!='0' and rank!='' and id>0  order by rank ASC");
									if (@mysqli_num_rows($result_cat)>=1) {
										while ($row_cat = mysqli_fetch_array($result_cat)) {
											if($row_cat['id']==$db_cat_items_show){
												$class="draggable-demo-product3";
											}else{
												$class="draggable-demo-product2";
												}
												if($row_cat['useimage']==1){
											echo "<div class=\"".$class." jqx-rc-all\" style='background-color:".$row_cat['background'].";'>
							<div class=\"jqx-rc-t draggable-demo-product-header jqx-widget-header-theme1 jqx-fill-state-normal-theme\" >
<a href=\"?cat_show=" . $row_cat['id'] . "\" class='a_cat_underlines'><img src=\"uploads/" . $row_cat['image'] . "\" class=\"imcart\" width=\"115\" height=\"30\" /></a></div>

							</div>";
													}else{
							echo "<div class=\"".$class." jqx-rc-all\" style='background-color:".$row_cat['background'].";'>
							<div class=\"jqx-rc-t draggable-demo-product-header jqx-widget-header-theme1 jqx-fill-state-normal-theme\" >
							<div class=\"draggable-demo-product-header-label\"> <a href=\"?cat_show=" . $row_cat['id'] . "\">" . $row_cat['product_name'] . "</a></div></div>

							</div>";
												}
										}
									}
							?>
                            </div>
                            <?php } ?>
                            <?php } ?>
							<?php
							###########################################
							$tbl_name = "items";
							//your table name
							// How many adjacent pages should be shown on each side?
							$adjacents = 3;

							/*
							 First get total number of rows in data table.
							 If you have a WHERE clause in your query, make sure you mirror it here.
							 */
							// if($db_cat_items_show==0 or $db_cat_items_show==null or $db_cat_items_show==""){
							//	 $query = "SELECT COUNT(*) as num  FROM  items where OrderNo!='0' and OrderNo!='' order by OrderNo ASC";
							// }else{
							$query = "SELECT COUNT(*) as num  FROM  items where OrderNo!='0' and OrderNo!='' and groupid=".$db_cat_items_show." order by OrderNo ASC";
							// }
							$total_pages = @mysqli_fetch_array(mysqli_query($con, $query));
							$total_pages = $total_pages[num];

							/* Setup vars for query. */
							$targetpage = "limit=" . $_GET['limit'] . "";
							//your file name  (the name of this file)
							//how many items to show per page
							if (!empty($_GET['limit'])) {
								$_SESSION[limit] = $_GET['limit'];
							} else {
							}
							if (!empty($_SESSION[limit])) {
								$limit = $_SESSION[limit];
								if ($limit > 100) {$limit = 20;
								}
							} else {
								$limit = 100;
							}
							$page = $_GET['page'];
							if ($page)
								$start = ($page - 1) * $limit;
							//first item to display on this page
							else
								$start = 0;
							//if no page var is given, set start to 0

							/* Get data. */
						// if($db_cat_items_show==0 or $db_cat_items_show==null or $db_cat_items_show==""){
						//$sql = "SELECT * FROM items where OrderNo!='0' and OrderNo!='' order by OrderNo ASC";
						//	 }else{
							$sql = "SELECT * FROM items where OrderNo!='0'  and OrderNo!='' and groupid=".$db_cat_items_show."  order by OrderNo ASC";
							// }
$result = @mysqli_query($con, $sql);
							/* Setup page vars for display. */
							if ($page == 0)
								$page = 1;
							//if no page var is given, default to 1.
							$prev = $page - 1;
							//previous page is page - 1
							$next = $page + 1;
							//next page is page + 1
							$lastpage = ceil($total_pages / $limit);
							//lastpage is = total pages / items per page, rounded up.
							$lpm1 = $lastpage - 1;
							//last page minus 1

							/*
							 Now we apply our rules and draw the pagination object.
							 We're actually saving the code to a variable in case we want to draw it more than once.
							 */
							$pagination = "";
							if ($lastpage > 1) {
								$pagination .= "<div class=\"pagination\">";
								//previous button
								if ($page > 1)
									$pagination .= "<a href=\"$targetpage&page=$prev\">>></a>";
								else
									$pagination .= "<span class=\"disabled\">>></span>";

								//pages
								if ($lastpage < 7 + ($adjacents * 2))//not enough pages to bother breaking it up
								{
									for ($counter = 1; $counter <= $lastpage; $counter++) {
										if ($counter == $page)
											$pagination .= "<span class=\"current\">$counter</span>";
										else
									
											$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
									}
								} elseif ($lastpage > 5 + ($adjacents * 2))//enough pages to hide some
								{
									//close to beginning; only hide later pages
									if ($page < 1 + ($adjacents * 2)) {
										for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
											if ($counter == $page)
												$pagination .= "<span class=\"current\">$counter</span>";
											else
												$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
										}
										$pagination .= "...";
										$pagination .= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
										$pagination .= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";
									}
									//in middle; hide some front and some back
									elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
										$pagination .= "<a href=\"$targetpage&page=1\">1</a>";
										$pagination .= "<a href=\"$targetpage&page=2\">2</a>";
										$pagination .= "...";
										for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
											if ($counter == $page)
												$pagination .= "<span class=\"current\">$counter</span>";
											else
												$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
										}
										$pagination .= "...";
										$pagination .= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
										$pagination .= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";
									}
									//close to end; only hide early pages
									else {
										$pagination .= "<a href=\"$targetpage&page=1\">1</a>";
										$pagination .= "<a href=\"$targetpage&page=2\">2</a>";
										$pagination .= "...";
										for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
											if ($counter == $page)
												$pagination .= "<span class=\"current\">$counter</span>";
											else
												$pagination .= "<a href=\"$targetpage&page=$counter\">$counter</a>";
										}
									}
								}

								//next button
								if ($page < $counter - 1)
									$pagination .= "<a href=\"$targetpage&page=$next\"><<</a>";
								else
									$pagination .= "<span class=\"disabled\"><<</span>";
								$pagination .= "</div>\n";
							}
							###############
							while ($row = @mysqli_fetch_array($result)) {
                                                        								if ($row['image']== null or $row['useimage'] == 0) {
									###################
									echo "<div class=\"draggable-demo-product jqx-rc-all\"  style='background-color:" . $row['Background'] . ";'>
							<div class=\"jqx-rc-t draggable-demo-product-header jqx-widget-header-theme1 jqx-fill-state-normal-theme\" >
							<div class=\"draggable-demo-product-header-label\" style='background-color:#fff;'> <a href=\"?q=" . $row['id'] . "\">" . $row['item'] . "</a></div></div>

							</div>";
									/*	echo"<div class=\"draggable-demo-product jqx-rc-all\"  style='background-color:".$row['Background']."; height:50px;'>
									 <div class=\"jqx-rc-t draggable-demo-product-header jqx-widget-header-theme1 jqx-fill-state-normal-theme\" >
									 <div class=\"draggable-demo-product-header-label\" style='background-color:#fff;'> <a href=\"?q=".$row['id']."\">".$row['item']."</a></div></div>

									 </div>"; */
									###################
								} else {
									echo "<div class=\"draggable-demo-product jqx-rc-all\">
							<div class=\"jqx-rc-t draggable-demo-product-header jqx-widget-header-theme1 jqx-fill-state-normal-theme\">
							<div class=\"draggable-demo-product-header-label\"><a href=\"?q=".$row['id']."\">".$row['item']."</a></div></div>

							<a href=\"?q=".$row['id']."\"><img src=\"uploads/".$row['image']."\" class=\"img-responsive\" width=\"115\" height=\"115\" /></a>
							</div>";
								}
                                                               
							}
							?>
                            <?php
							if($total_pages==0 and $db_cat_items_show!=0){
	                       echo'<br /><div class="alert alert-warning text-right">
        '.$no_items_group_lang.'
                            </div>';
								}
								?>
							</div>
							</div>
							</div>
                            <?php } ?>
							</article>

			
							</div>
                             <div id="toolbar">
							<footer>
							 <?php include"includes/scroller_container.php"; ?>
							</footer>
                            </div>
							</body>

							</html>
                                                        <?php include 'includes/footer.php'; ?>
