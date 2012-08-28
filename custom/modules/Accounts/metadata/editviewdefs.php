<?php
/* * *******************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2011 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 * ****************************************************************************** */

$viewdefs['Accounts']['EditView'] = array(
    'templateMeta' => array(
        //'form' => array('buttons' => array('SAVE', 'CANCEL')),
		//Rajesh G - 16/07/12
		//Not to allow users without specifying primary email
		'form' => array(
            'buttons' => array(
                     0 =>
              array (
                'customCode' => '<input type="submit" id="SAVE" value="Save" name="button"  title="Save" 
accessKey="a" class="button primary" 
onclick="this.form.action.value=\'Save\'; saveClickCheckPrimary();
if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(this.form);return false; "  value="Save" >',
              ), 
                1 => 'CANCEL',
                )
            ),
        'maxColumns' => '2',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30'),
        ),
        'includes' => array(
            array('file' => 'modules/Accounts/Account.js'),
        ),
    ),
    'panels' => array(
        'lbl_account_information' =>
        array(array('name' => 'first_name', 'label' => 'LBL_FIRST_NAME', 'displayParams' => array('required' => true,),),
            array(
                array(//by swapna dt:15-03-2012
                    'name' => 'last_name',
                    'label' => 'LBL_LAST_NAME',
                ),
            ),
            /* array (


              array (
              'name' => 'phone_office',
              'label' => 'LBL_PHONE_OFFICE',
              ),


              ), */
            array(
                array(
                    'name' => 'website',
                    'type' => 'link',
                    'label' => 'LBL_WEBSITE',
                ),
            ),
            array(
                array(
                    'name' => 'billing_address_street',
                    'hideLabel' => true,
                    'type' => 'address',
                    'displayParams' =>
                    array(
                        'key' => 'billing',
                        'rows' => 2,
                        'cols' => 30,
                        'maxlength' => 150,
                    ),
                ),
                array(
                    'name' => 'shipping_address_street',
                    'hideLabel' => true,
                    'type' => 'address',
                    'displayParams' =>
                    array(
                        'key' => 'shipping',
                        'copy' => 'billing',
                        'rows' => 2,
                        'cols' => 30,
                        'maxlength' => 150,
                    ),
                ),
            ),
            array(
                array(
                    'name' => 'email1',
                    //'studio' => 'false',
                    'customCode' => '{$EMAIL}',
                    'label' => 'LBL_EMAIL',
                ),
                array(
                    'name' => 'phoneno',
                    'customCode' => '{$PHONENOS}',
                    'label' => 'LBL_PHONENO',
                ),
            ),
            array(
                array(
                    'name' => 'description',
                    'label' => 'LBL_DESCRIPTION',
                ),
                array(
                    'name' => 'phone_fax',
                    'label' => 'LBL_FAX',
                ),
            ),
            array(
                array(
                    'name' => 'client_source',
                    'label' => 'LBL_CLIENT_SOURCE',
                ),
            ),
        ),
        // Author: Phaneendra
        // Dt.     26-Feb-2012.
        'LBL_PANEL_PASSWORD' =>
        array(
            array(
                'name' => 'password',
                'label' => 'LBL_PASSWORD',
                'displayParams' =>
                array(
                    'required' => true,
                ),
            ),
        ),
        //end
        /* 'LBL_PANEL_ADVANCED' => 
          array (

          array (
          'account_type',
          'industry'
          ),

          array (
          'annual_revenue',
          'employees'
          ),

          array (
          'sic_code',
          'ticker_symbol'
          ),

          array (
          'parent_name',
          'ownership'
          ),

          array (
          'campaign_name',
          'rating'
          ),
          ), */
        'LBL_PANEL_ASSIGNMENT' =>
        array(
            array(
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_ASSIGNED_TO',
                ),
            ),
        ),
    //Phaneendra 03052011
    /* 'LBL_PANEL_TRADEMARK_RECORD_DISPLAY' =>    
      array (
      array (
      array (
      'customCode' => '{$CLIENT_TRADEMARK_RECORD_DISPLAY}',
      ),
      ),
      ), */
    )
);
?>
<script language="javascript">

	function saveClickCheckPrimary(){
        var emailCount = document.getElementById('emailCount').value;
        if(emailCount > 0)
            {
                var emailRadio = document.getElementsByName("Accounts0emailAddressPrimaryFlag");
                if(emailRadio.length > 0){
                    for(var i = 0; i<emailCount;i++){
                        if(emailRadio[i].checked == true){
                            var radioId = emailRadio[i].id;
                            var idx = radioId.replace("Accounts0emailAddressPrimaryFlag", "");
                            var emailAddr = document.getElementById("Accounts0emailAddress"+idx).value;
                            if(emailAddr.length <= 0)
                                {
                                    document.getElementById("email-status-msg").style.display = "block";
                                    return false;
                                }
                        }
                    }
                }else{
                    document.getElementById("email-status-msg").style.display = "block";
                    return false;
                }
                
            }
            else{
                document.getElementById("email-status-msg").style.display = "block";
                return false;
            }
    }
    
    function onChgCheckPrimary(txtEmailId)
    {
        document.getElementById("email-status-msg").style.display = "none";
        var idx = txtEmailId.replace("Accounts0emailAddress", "");
        var emailRadio = document.getElementsByName("Accounts0emailAddressPrimaryFlag");
        var emailRadioId = emailRadio[idx].id;
        if(document.getElementById(emailRadioId).checked == true){
            checkPrimary(emailRadioId);
        }
        
    }
	
    var numbernext_step_Addresses=1;
    function add(tblId)
    {
        if(tblId == "tbl_email")
            numbernext_step_Addresses = document.getElementById('emailCount').value;
        else
            numbernext_step_Addresses = document.getElementById('count').value;
        
        var tableId = tblId;
        var insertInto = document.getElementById(tableId);
        var parentObj = insertInto.parentNode;
	
        var newContent = document.createElement("input");
        var delbutton = document.createElement("input");
        var primary = document.createElement("input");
        var optedOut = document.createElement("input");
        var invalid = document.createElement("input");
        
        var nav = new String(navigator.appVersion);
        var newContentPrimaryFlag;
        var tbody = document.createElement("tbody");
	
        var tr = document.createElement("tr");
	
        if(tableId == "tbl_email"){
            var td1 = document.createElement("td");
            newContent.setAttribute("type", "text");
            newContent.setAttribute("name", "Accounts0emailAddress" + numbernext_step_Addresses);
            newContent.setAttribute("id", "Accounts0emailAddress" + numbernext_step_Addresses);
            newContent.onchange = function(){
                onChgCheckPrimary(this.id);
            }

            var td2 = document.createElement("td"); 
            delbutton.setAttribute("type", "button");
            delbutton.setAttribute("value", "-");
            //delbutton.setAttribute("onclick", "removeElement(this.id);");
            delbutton.setAttribute("name", "delbutton" + numbernext_step_Addresses);
            delbutton.setAttribute("id", "delbutton" + numbernext_step_Addresses);
            delbutton.onclick = function(){
                removeElement(tr,this.id);
            }
            var td3 = document.createElement("td"); 
            primary.setAttribute("type", "radio");
            primary.setAttribute("name", "Accounts0emailAddressPrimaryFlag");
            primary.setAttribute("value", numbernext_step_Addresses);
            primary.setAttribute("id", "Accounts0emailAddressPrimaryFlag" + numbernext_step_Addresses);
            primary.onclick = function(){
                checkPrimary(this.id);
            }
            
            var td4 = document.createElement("td"); 
            optedOut.setAttribute("type", "checkbox");
            optedOut.setAttribute("name", "Accounts0emailAddressOptOutFlag[]");
            optedOut.setAttribute("value","Accounts0emailAddress" + numbernext_step_Addresses);
            optedOut.setAttribute("id", "Accounts0emailAddressOptOutFlag" + numbernext_step_Addresses);
            
            var td5 = document.createElement("td"); 
            invalid.setAttribute("type", "checkbox");
            invalid.setAttribute("name", "Accounts0emailAddressInvalidFlag[]");
            invalid.setAttribute("value", "Accounts0emailAddress" + numbernext_step_Addresses);
            invalid.setAttribute("id", "Accounts0emailAddressInvalidFlag" + numbernext_step_Addresses);
            
            numbernext_step_Addresses++;
            document.getElementById('emailCount').value = numbernext_step_Addresses;
        
            td1.setAttribute("class", "tabEditViewDF");

            td1.appendChild(newContent);
            td2.appendChild(delbutton);
            td3.appendChild(primary);
            td4.appendChild(optedOut);
            td5.appendChild(invalid);

            tbody.appendChild(tr);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            
            tbody.appendChild(tr);
            insertInto.appendChild(tbody);
        }
        else if(tableId == "tbl_name"){
            var td1 = document.createElement("td");
            newContent.setAttribute("type", "text");
            newContent.setAttribute("name", "phone_no" + numbernext_step_Addresses);
            newContent.setAttribute("id", "phone_no" + numbernext_step_Addresses);


            var td2 = document.createElement("td"); 
            delbutton.setAttribute("type", "button");
            delbutton.setAttribute("value", "-");
            delbutton.setAttribute("name", "delbutton" + numbernext_step_Addresses);
            delbutton.setAttribute("id", "delbutton" + numbernext_step_Addresses);
            delbutton.onclick = function(){
                removeElement(tr,this.id);
            }
            var td3 = document.createElement("td"); 
            primary.setAttribute("type", "radio");
            primary.setAttribute("name", "primary0");
            primary.setAttribute("value", numbernext_step_Addresses);
            primary.setAttribute("id", "primary" + numbernext_step_Addresses);

            numbernext_step_Addresses++;
            document.getElementById('count').value = numbernext_step_Addresses;
            
            td3.setAttribute("width", "150");
            td3.setAttribute("allign", "right");

            newContent.setAttribute("size", "20");
            td1.setAttribute("class", "tabEditViewDF");

            td1.appendChild(newContent);
            td2.appendChild(delbutton);
            td3.appendChild(primary);

            tbody.appendChild(tr);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);

            tbody.appendChild(tr);
            insertInto.appendChild(tbody);
        }
    }
    
    function removeElement(tr,id){
        tr.parentNode.removeChild(tr);
    }
    
    function checkPrimary(radioId)
    {
        document.getElementById("email-status-msg").style.display = "none";
        var idx = radioId.replace("Accounts0emailAddressPrimaryFlag", "");
        var emailAddr = document.getElementById("Accounts0emailAddress"+idx).value;
        var clientId = document.getElementById("clientId").value;
        if(emailAddr != ''){
            var callback = {
                success: function(o) {
                    if(o.responseText != "No Confliction")
                    {
                        document.getElementById("primaryStatusMsg").innerHTML = o.responseText;
                        var btnsSave = document.getElementsByClassName("primary", "input");
                        for(var cnt = 0; cnt < btnsSave.length;cnt++){
                            btnsSave[cnt].setAttribute("disabled","true");
                        }
                        document.getElementById("save_and_continue").disabled = true;
                    }
                    else{
                        document.getElementById("primaryStatusMsg").innerHTML = "";
                        var btnsSave = document.getElementsByClassName("primary", "input");
                        for(var cnt = 0; cnt < btnsSave.length;cnt++){
                            btnsSave[cnt].removeAttribute("disabled");
                        }
                        document.getElementById("save_and_continue").disabled = false;
                    }
                },
                failure:function(o){
                    alert("Failure: "+o.status);
                }
            }
            var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "CheckPrimaryEmail.php?emailAddr="+emailAddr+"&clientId="+clientId, callback);
        }
    }
</script>