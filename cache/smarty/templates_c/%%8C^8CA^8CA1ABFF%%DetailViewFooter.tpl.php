<?php /* Smarty version 2.6.11, created on 2012-08-27 11:13:05
         compiled from custom/modules/Cases/tpls/DetailViewFooter.tpl */ ?>
{*
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Professional Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/products/sugar-professional-eula.html
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2010 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/
*}
<!--
	AUTHOR: BASUDEBA RATH
	DATE: 25-Nov-2011
	VEON CONSULTING PVT LTD.

-->
<div id="app_filed"  class="detail view" style="{$VISIBITY}" > 
<table >
<tr>
	<td align="left"> <h4>{$APPLICATION_FILED}</h4></td>
	<td></td>
</tr>
<tr>
	
</tr>
</table>
<table style="{$DISP_INPUT}"  width="100%">
		<tr>
			<td width="7%">Filing Date : </td>
			<td width="6%">
				<input type="text" id="fdate" name="fdate" value="{$FDT}" />
				<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger" align="absmiddle" />
			</td>
			<td width="7%">Application Number : </td>
			<td width="5%"><input type="text" id="ano" name="ano" value = "{$ANO}" /></td>
			<td width="7%">Filing Receipt : </td>
			<td width="5%"><input type="checkbox" id="freceipt" name="freceipt" class="ac_input"/></td>
		</tr>
		
</table>
<table style="{$IP_LBL_PN}" width="100%">
		<tr>	
			<td width="20%">Publication Number</td>
			<td width="15%"><input type="text" id="pp_number" name="pp_number" /></td>
			<td width="20%">Issued Number</td>
			<td width="15%"><input type="text" id="pi_number" name="pi_number" /></td>
			
		</tr>
</table>
<table style="{$DISPLAY_DET}" width="100%">
	<tr>
		<td>Filing Date:</td>
		<td>{$FDATE}</td>
		<td>Application Number :</td>
		<td>{$APP_NO}</td>
		<td>Filing Receipt : </td>
		<td><input type = "checkbox" name = "freceipt" id = "freceipt" {$F_RECEIPT}  disabled="disabled"/></td>
	</tr>
</table>
<table style="{$DET_LBL_PN}" width="100%">
		<tr>	
			<td>Patent Publication Number :</td>
			<td>{$PUBLICATION_NO}</td>
			<td>Patent Issued Number :</td>
			<td>{$ISSUED_NO}</td>
		</tr>
</table>
</div>

<div id="tm_app_filed"  class="detail view" style="{$TM_VISIBITY}">
<table>
<tr>
	<td align="left"> <h4>{$TM_APPLICATION_FILED}</h4></td>
	<td></td>
</tr>
<tr>
	
</tr>
</table>
<table style="{$DISP_TA_INPUT}">
		<tr>
			<td>TM Filing Date : </td>
			<td>
				<input type="text" id="tm_fdate" name="tm_fdate" value="{$TM_FDATE_VAL}" />
				<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger1" align="absmiddle" />
			</td>
			<td>Application Number : </td>
			<td><input type="text" id="tm_ano" name="tm_ano" value="{$TM_APP_NO_VAL}" /></td>
			<td>TM Classes : </td>
			<td>
			<select id="tm_classes" name="tm_classes[]" multiple="multiple">
			
				<option value="Chemicals">1: Chemicals</option>
				<option value="Paints">2: Paints</option>
				<option value="Cosmetics_and_cleaning_preparations">3: Cosmetics and cleaning preparations</option>
				<option value="Lubricants_and_fuels">4: Lubricants and fuels</option>
				<option value="Pharmaceuticals">5: Pharmaceuticals</option>
				<option value="Metal_goods">6: Metal goods</option>
				<option value="Machinery">7: Machinery</option>
				<option value="Hand_tools">8: Hand tools</option>
				
				<option value="Electrical_and_scientific_apparatus">9: Electrical and scientific apparatus</option>
				<option value="Medical_apparatus">10: Medical apparatus</option>
				<option value="Environmental_control_apparatus">11: Environmental control apparatus</option>
				<option value="Vehicles">12: Vehicles</option>
				<option value="Firearms">13: Firearms</option>
				<option value="Jewelry">14: Jewelry</option>
				<option value="Musical_Instruments">15: Musical Instruments</option>
				<option value="Paper_goods_and_printed_matter">16: Paper goods and printed matter</option>
				<option value="Rubber_goods">17: Rubber goods</option>
				<option value="Leather_goods">18: Leather goods</option>
				<option value="Nonmetallic_building_materials">19: Nonmetallic building materials</option>
				<option value="Furniture_and_articles_not_otherwise_classified">20: Furniture and articles not otherwise classified</option>
				<option value="Housewares_and_glass">21: Housewares and glass</option>
				<option value="Cordage_and_fibers">22: Cordage and fibers</option>
				<option value="Yarns_and_threads">23: Yarns and threads</option>
				<option value="Fabrics">24: Fabrics</option>
				<option value="Clothing">25: Clothing</option>
				<option value="Fancy_goods">26: Fancy goods</option>
				<option value="Floor_coverings">27: Floor coverings</option>
				<option value="Toys_sporting_goods">28: Toys and sporting goods</option>
				<option value="Meats_and_processed_foods">29: Meats and processed foods</option>
				<option value="Staple_foods">30: Staple foods</option>
				<option value="Natural_agricultural_products">31: Natural agricultural products</option>
				<option value="Light_beverages">32: Light beverages</option>
				<option value="Wine_and_spirits">33: Wine and spirits</option>
				<option value="Smokers_articles">34: Smokers’ articles</option>
				<option value="Advertising_and_business">35: Advertising and business</option>
				<option value="Insurance_and_financial">36: Insurance and financial</option>
				<option value="Building_construction_and_repair">37: Building construction and repair</option>
				<option value="Telecommunications">38: Telecommunications</option>
				<option value="Transportation_and_storage">39: Transportation and storage</option>
				<option value="Treatment_of_materials">40: Treatment of materials</option>
				<option value="Education_and_entertainment">41: Education and entertainment</option>
				<option value="Computer_and_scientific">42: Computer and scientific</option>
				<option value="Hotels_and_restaurants">43: Hotels and restaurants</option>
				<option value="Medical_beauty_agricultural">44: Medical, beauty & agricultural</option>
				<option value="Personal">45: Personal</option>
						
			</select>
			</td>
		</tr>
		<tr>
		<td>TM Registration Date : </td>
			<td>
				<input type="text" id="tm_registration_date" name="tm_registration_date"  value = "{$TM_REG_DT_VAL}" />
				<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger2" align="absmiddle" />
			</td>
		<td>Registration No.:</td>
		<td><input type="text" id="tm_registration_number" name="tm_registration_number" value="{$TM_REG_NO_VAL}" /></td>
		<td></td><td></td>
		</tr>
		
</table>
<table style="{$TM_FILING}" >
	<tr>
		<td>TM Filing Date:</td>
		<td>{$TM_FDATE}</td>
		<td>TM Registration Date : </td>
		<td>{$TM_REG_DATE}</td>
		<td>TM Classes : </td>
		<td>{$TM_CLASSES_VALUES}</td>
	</tr>
	<tr>	
		<td>TM Application Number :</td>
		<td>{$TM_APP_NO}</td>
		<td>Registration No.:</td>
		<td>{$TM_REG_NO}</td>
		<td></td>
		<td></td>
		
	</tr>
</table>

</div>

<div id="contribute" class="detail view">
<b>{$CONTRIBUTE}</b>
	{$CONT_LISTS}
		
	<input type="button" name="btn_cont" id="btn_cont" value = "Contribute Case" onclick="contributeCase(this.id);" />
	<input type="button" name="btn_assigned" id="btn_assigned" value="Assign to Case"  onclick="open_assign_popup();" {$DIS_BTN_ASSIGNTO} />
</div>

<div id="claim_priority" >

	<table>
		<tr>
			<td scope="row" align="left" colspan="7"><h4>{$CLAIM}</h4></td>
		<td></td>
		</tr>
	</table>
	<table width="100%">
	
		<tr>
		<td>{$CLAIMED_CASES}</td>
		</tr>
	</table>
</div>

<!-- Added By Basudeba Rath, Date : 11-Jun-2012. -->

<div id="claimed_priority" >

	<table>
		<tr>
			<td scope="row" align="left" colspan="7"><h4>{$PRIORITY_CLAIMED_BY}</h4></td>
		<td></td>
		</tr>
	</table>
	<table width="100%">
	
		<tr>
		<td>{$PRIORITY_CLAIM_BY}</td>
		</tr>
	</table>
</div>

<!--*************************************************-->


<div id="dv_case_history">
	
	<table  border="0" cellpadding="0" cellspacing="{$gridline}">
	<tr>
		<td scope="row" align="left" colspan="7"><h4>{$CASE_HISTORY}</h4></td>
		<td></td>
	</tr>

</table>
{$BUTTONS}
	<!-- BEGIN: case_history -->
	<table width="100%">
		<tr>
			<td>{$NOTES}</td>
		</tr>
	</table>
	<input type="hidden" id="beanid" name="beanid" value="{$BEAN_ID}" />
	<input type="hidden" id="userid" name="userid" value="{$USER_ID}" />
	<input type="hidden" id="noteid" name="noteid" value="{$NOTE_ID}" />
	
	<table>	
		<tr>
			<td align="right" width="450"><textarea name="clnt_hist" id="clnt_hist" cols="188" rows="3">{$NOTES_TEXT}</textarea></td>
		</tr>
	</table>
	<table>
		<tr>
			<td ><input type="button" id="btn_clnt"  value="Save" onclick="return callAjax();"></td>
			<td>{$BTN_CANCEL}</td>
			<td><input type="button" id="btn_clear" value="Clear"  onclick="clr();"></td>
		</tr>
	</table>
</div>



<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/WorkFlows.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/CaseHistory.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/popups.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/ClaimPriority.js"}"></script>