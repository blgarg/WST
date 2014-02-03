<?php 
global $config_var;  
global $model;
global $DataSet;
 ?>
      <script type="text/javascript">
     function filter_select(value)
	 {
	 if(value==0)
	 {
	 document.getElementById("business").style.display="none";
	 document.getElementById("categories").style.display="none";
	 document.getElementById("writers").style.display="none";
	 }else if(value==1)
	 {
	 document.getElementById("business").style.display="block";
	 document.getElementById("categories").style.display="none";
	 document.getElementById("categories").value =0;
	 document.getElementById("writers").style.display="none";
 	 document.getElementById("writers").value =0;
	 }
	 else if(value==2)
	 {
	 document.getElementById("business").style.display="none";
	 document.getElementById("categories").style.display="block";
	 document.getElementById("writers").style.display="none";
	 }else if(value==3)
	 {
	 document.getElementById("business").style.display="none";
	 document.getElementById("categories").style.display="none";
	 document.getElementById("writers").style.display="block";
	 }
	 }
	 function decode_base64(s) {
    var e={},i,k,v=[],r='',w=String.fromCharCode;
    var n=[[65,91],[97,123],[48,58],[47,48],[43,44]];

    for(z in n){for(i=n[z][0];i<n[z][1];i++){v.push(w(i));}}
    for(i=0;i<64;i++){e[v[i]]=i;}

    for(i=0;i<s.length;i+=72){
    var b=0,c,x,l=0,o=s.substring(i,i+72);
         for(x=0;x<o.length;x++){
                c=e[o.charAt(x)];b=(b<<6)+c;l+=6;
                while(l>=8){r+=w((b>>>(l-=8))%256);}
         }
    }
    return r;
    }
	function getParam(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);
    if (results == null)
        return "";
    else
        return results[1];
}
	<?php
	if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='')
	{
	?>
window.onload=get_parties_value; 
<?php
}
?>
		function get_parties_value()
		{
		var partyid=getParam('partyid');
		var values=document.getElementById("businessid").value;
		get_parties_edit(values,partyid);
		}
		function get_parties_edit(value,partyid)
		{
	 var valueid=decode_base64(value);
	  if(value=="hga")
	 {
	 document.getElementById("partyid").style.display="none";
	 }
	 else
	 {
	 document.getElementById("partyid").style.display="block";
	 }
	 var partid=partyid;
	 var url="mod/mod_booksStore/model/codes.php?partid="+partid+"&businesstypeid="+valueid;
	 //alert(url);
	 var obj
	 try
		{
	   obj=new XMLHttpRequest();    
		 }
	  catch(e)
		{
				   try
				  {
				obj=new ActiveXObject("Microsoft.XMLHTTP");
					}
			catch(e)
				{
			   alert("Your Browser not supported Ajax");
				  }
		}
	obj.open("GET",url,true);
	obj.send(null);
	obj.onreadystatechange=function()
	  {
	  if(obj.readyState==4)
		 {
		   var res=obj.responseText;
		   document.getElementById('partyid').innerHTML = res;
		  }
	  }
	 
		}
	 function get_parties(value)
	 {
	 if(value=="hga")
	 {
	 document.getElementById("partyid").style.display="none";
	 }
	 else
	 {
	 document.getElementById("partyid").style.display="block";
	 }
	 var valueid=decode_base64(value);
	 var url="mod/mod_booksStore/model/codes.php?party="+valueid;
	var obj
	 try
		{
	   obj=new XMLHttpRequest();    
		 }
	  catch(e)
		{
				   try
				  {
				obj=new ActiveXObject("Microsoft.XMLHTTP");
					}
			catch(e)
				{
			   alert("Your Browser not supported Ajax");
				  }
		}
	obj.open("GET",url,true);
	obj.send(null);
	obj.onreadystatechange=function()
	  {
	  if(obj.readyState==4)
		 {
		   var res=obj.responseText;
		   document.getElementById('partyid').innerHTML = res;
		  }
	  }
	 }
     </script>
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<form name="searchForm" id="searchForm" method="get" >
            		
                    <table border="0" cellpadding="0" cellspacing="0" align="left" style="margin-right:10px;">
                    <tr>
                    <td valign="top">
                    <select  class="selectbox" name="cmbStatus" onchange="filter_select(this.value)" style="padding:3px 0 0 6px;width:100%;margin-right:10px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Filter</option>
                    <option value="1" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='') echo 'selected'; else ''; ?> >Academies</option>
                    <!--<option value="2" <?php //if(isset($_REQUEST['bookcategory']) && $_REQUEST['bookcategory']!='') echo 'selected'; else ''; ?> >Categories</option>-->
                    <option value="3" <?php if(isset($_REQUEST['royalitywriter']) && $_REQUEST['royalitywriter']!='') echo 'selected'; else ''; ?> >Writers</option>
                    </select> 
                    </td>
                    </tr>
                    </table>
                    <table border="0"  cellpadding="0" cellspacing="0" align="left" id="business" <?php if(!isset($_REQUEST['businessid'])){?>style="display:none;"<?php }?>>
                   <form name="searchForm1" id="searchForm1" method="get">
                   <input type="hidden" name="issue_booksSearchBusiness" value="issue_booksSearchBusiness" />
                    <input type="hidden" name="mod" value="mod_booksStore"  />
                    <input type="hidden" name="view" value="sellBooks"  />
                    <input type="hidden" name="m" value="2"  />
                    <tr>
                    <td valign="top" style="padding-right:10px;"><select  class="selectbox" name="businessid" id="businessid" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="<?php base64_encode(0);?>" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Academies type</option>
                    <option value="hga" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']=='hga') echo 'selected'; ?> >HGA academies</option>
                   <?php
				   $all_busin_cate=new model_booksStore_sellBooks();
				   $all_business=$all_busin_cate->get_all_academics();
				   for($i=0;$i<count($all_business);$i++)
				   {
				   $business_id=base64_decode(@$_REQUEST['businessid']);
				   ?>
                    <option value="<?php echo base64_encode($all_business[$i]['parties_id']);?>" <?php if(isset($_REQUEST['businessid']) && $_REQUEST['businessid']!='' && $business_id==$all_business[$i]['parties_id']) echo 'selected'; ?> ><?php echo $all_business[$i]['business_title']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td valign="top"> </td>
                    <td valign="top">
                    <input type="button"  class="button_r"   value="Filter" onclick="check_business()" style="margin-left:10px;" />
                    </td>
                    </tr></form>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" align="left" id="categories" <?php if(!isset($_REQUEST['bookcategory'])){?>style="display:none;"<?php }?>>
                    <form name="searchForm2" id="searchForm2" method="get">
                   <input type="hidden" name="issue_booksSearchBookCategories" value="issue_booksSearchBookCategories" />
                    <input type="hidden" name="mod" value="mod_booksStore"  />
                    <input type="hidden" name="view" value="sellBooks"  />
                    <input type="hidden" name="m" value="2"  />
                    <tr>
                    <td valign="top"><select  class="selectbox" name="bookcategory" id="bookcategory" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Book Categories</option>
                   <?php
				   $all_book_cate=new model_booksStore_sellBooks();
				   $all_books=$all_book_cate->get_all_bookscategories();
				   for($i=0;$i<count($all_books);$i++)
				   {
				   $book_catid=base64_decode(@$_REQUEST['bookcategory']);
				   ?>
                    <option value="<?php echo base64_encode($all_books[$i]['cat_id']);?>" <?php if(isset($_REQUEST['bookcategory']) && $_REQUEST['bookcategory']!='' && $book_catid==$all_books[$i]['cat_id']) echo 'selected'; ?> ><?php echo $all_books[$i]['cat_title']?></option>
                   <?php
				   }
				   ?>
                    </select></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                    <input type="button"  class="button_r"   value="Filter" onclick="check_category();" style="margin-left:10px;" />
                    </td>
                    </tr></form>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" align="left" id="writers" <?php if(!isset($_REQUEST['royalitywriter'])){?>style="display:none;"<?php }?>>
                   <form name="searchForm3" id="searchForm3" method="get">
                   <input type="hidden" name="sell_booksSearchBookWriters" value="sell_booksSearchBookWriters" />
                    <input type="hidden" name="mod" value="mod_booksStore"  />
                    <input type="hidden" name="view" value="sellBooks"  />
                    <input type="hidden" name="m" value="2"  />
                    <tr>
                    <td valign="top"><select  class="selectbox" name="royalitywriter" id="royalitywriter" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="0" <?php if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']=='') echo 'selected'; else ''; ?> >Select Writers</option>
                   <?php
				   $all_book_writer=new model_booksStore_sellBooks();
				   $all_writer=$all_book_writer->get_all_bookswriters();
				   for($i=0;$i<count($all_writer);$i++)
				   {
				   $writer=base64_decode($_REQUEST['royalitywriter']);
				   ?>
                    <option value="<?php echo base64_encode($all_writer[$i]['writer_id']);?>" <?php if(isset($_REQUEST['royalitywriter']) && $_REQUEST['royalitywriter']!='' && $writer==$all_writer[$i]['writer_id']) echo 'selected'; ?> ><?php echo $all_writer[$i]['writer_name']?></option>
                   <?php
				   }
				   ?>
                    </select> </td>
                    <td>&nbsp;</td>
                    <td valign="top">
                    <input type="button"  class="button_r"   value="Filter" onclick="check_writer();" style="margin-left:10px;" />
                    </td>
                    </tr></form>
                    </table>
                    <form name="searchForm4" id="searchForm4" method="get">
                   <input type="hidden" name="particularsearch" value="particularsearch" />
                    <input type="hidden" name="mod" value="mod_booksStore"  />
                    <input type="hidden" name="view" value="sellBooks"  />
                    <input type="hidden" name="m" value="2"  />
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"><input type="text" name="creteria" id="creteria" value="<?php if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='') echo $_REQUEST['creteria']; ?>" class="top-search-inp"  /></td>
                    <td>&nbsp;</td>
                    <td valign="top">
                    <input type="submit"  class="button_r"   value="Search" onclick="this.form.submit();" />
                    </td>
                    </tr>
                    </table></form>
                    <table border="0" cellpadding="0" cellspacing="0" align="right">
                    <tr>
                    <td valign="top"> <?php //print $DataSet['nav'];?></td>
                    </tr>
                    </table>
			</form>
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="./index.php?mod=mod=mod_booksStore&view=sellBooks&m=2" name="mainform" method="post" >
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
                <td colspan="6" align="left">
                    <div style="margin:auto;width:100%;min-height:40px;background-color:#333333">
                    	
                        
                           <div style="float:left;width:20%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Book Title</a>                        </div>
                      <div style="float:left;width:23%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Academies</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Author</a>                        </div>
                      <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Available Quantities</a></div>
                        <div style="float:left;width:14%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center"><a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Unit Price</a>                        </div>
                        
             <!--<div style="float:left;width:15%;min-height:40px;border-right:#CCCCCC 1px solid;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Birthplace</a>
                        </div>-->
                      
                      
                        
                       <div style="float:left;width:8%;min-height:40px;text-align:center">
                        <a  href="javascript:;" style="text-align:center;line-height:40px;color:#CCCCCC;font-weight:bold; text-decoration:none;cursor:text;">Action</a>
                        </div>
                       </div></td>
                </tr>
				<?php 
				$Books  =  $DataSet['result'];
				for($i = 0;$i<count($Books);$i++){	?>
                 <tr>
                 <td colspan="6">
                    <div style="width:100%;height:auto;float:left;">
                    	
                        
						<div style="float:left;width:19%;min-height:65px;text-align:left;padding-left:1%;padding-top:12px;border-right:#CCCCCC 1px solid;"  onmouseover="displayOverLay(<?php echo $i; ?>);" onmouseout="hideOverLay(<?php echo $i; ?>);" class="breakword">
                        
                        <div style="float:left;width:98%;min-height:41px;text-align:left;padding-left:1%;">
							<?php /*if(strlen($Books["$i"]['cat_title']) >=100){echo ucfirst(substr($Books["$i"]['cat_title'],0,100))."...";}else{echo ucfirst($Books["$i"]['cat_title']);}*/ echo $Books["$i"]['book_name'];?>   </div>		
                        
                        
                        <!--<div style="width:98%;min-height:20px;display:none;margin-top:2px;float:left;" id="textOverLay_<?php //echo $i;?>"><a href="?mod=mod_agents&view=editAgent&m=6&agent_id=<?php //echo $Books["$i"]['agent_id'];?>" style="color:#595959;"><strong>Edit</strong></a><!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./?mod=mod_cms&view=ViewModel&m=1&agent_id=<?php //echo $Books[$i]['agent_id']; ?>" style="color:#474747;"><strong>View</strong></a></div>-->
                        
                        
                        </div>  
                           <div style="float:left;width:22%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php 
						   if($Books["$i"]['party_id']==0)
						   {echo "<b>HGA Academies</b>";}
						   else
						   { $info=new model_booksStore_sellBooks();
						   $title=$info->get_party_title($Books["$i"]['party_id']);
						   $title1=$info->get_academy_title($Books["$i"]['business_id']);
						   echo $title[0]['business_title']."";
						   }
						  ?>
						   </div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['book_author'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['quantities'];?></div>
                           <div style="float:left;width:13%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                           <?php echo $Books["$i"]['book_price'];?></div>
                           <!--<div style="float:left;width:14%;min-height:65px;border-right:#CCCCCC 1px solid;text-align:center;padding-left:1%;padding-top:12px;">
                          <?php //if(strlen($Books["$i"]['Birthplace']) >=20){ echo ucfirst(substr($Books["$i"]['Birthplace'],0,20)); }else{ echo ucfirst($Books["$i"]['Birthplace']); }?></div>-->
                           
                           
                       
                        
                        

                        
                         <div style="float:left;width:8%;min-height:66px;margin-top:5px;text-align:center;padding-left:1%;padding-top:5px;">
                        <?php //echo date("Y/m/d",strtotime($Books["$i"]['createdDate']));?>
                        <?php /* if($Books["$i"]['Actions']=='1') echo 'Active'; else echo "Deactive";*/?>
                        <a href="./?mod=mod_booksStore&view=bookdetail&book_id=<?php echo base64_encode($Books["$i"]['book_id']); ?>&m=2"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/add_cart.png" /></a>
                        </div>
                       </div></td>
                </tr>
                
  				<?php  } if(count($Books) <=0){	?>
                <tr>
                 <td colspan="6" align="left">
                    <div style="width:100%;height:auto;float:left;">
                    	<div style="width:100%;height:59px;border-right:#CCCCCC 1px solid;float:left;padding-left:2%;padding-top:12px;">
                         <p align="center" style="color:#000;font-size:22px;font-weight:bold;">No Record Found</p>
                        </div>
                       </div></td>
                </tr>
                <?php } ?>
				</table>
				<!--  end product-table................................... -->
                 <input type="hidden" name="controller" value="" id="controller"  /> 
             </form>
			</div>
			<!--  end content-table  -->
		    <?php print $DataSet['nav'];?>
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		