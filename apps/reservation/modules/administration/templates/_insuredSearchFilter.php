<div class="content">
    <form method="POST" action="" name="insuredSearchForm" id="insuredSearchForm">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="12%">Insured Name</td>
                <td width="22%">
                    <input type="text" name="insuredname" id="insuredname" class="txtbox-small"/>
                </td>
                <td width="12%">Address Line 1</td>
                <td width="22%"><input type="text" name="insuredaddress" id="insuredaddress" class="txtbox-small"></td>
                <td width="4%">&nbsp;</td>
                <td width="30%">&nbsp;</td>
            </tr>
            <tr>
                <td>Country</td>
                <td> 
                    <select name="insuredcountry" id="insuredcountry" class="listbox-small">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($insuredCountry as $value) {
                            ?>
                            <option value="<?php echo $value['Id'] ?>" ><?php echo $value['InsuredCountry'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>State</td>
                <td> 
                    <select name="insuredstate" id="insuredstate" class="listbox-small">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($insuredState as $state) {
                            ?>
                            <option value="<?php echo $state['Id']; ?>" <?php echo $select; ?>><?php echo $state['StateName']; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>City</td>
                <td> 
                    <select name="insuredcity" id="insuredcity" class="listbox-small">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($insuredCity as $cityvalue) {
                            ?>
                            <option value="<?php echo $cityvalue['Id']; ?>" <?php echo $select; ?>><?php echo $cityvalue['City']; ?></option>
                        <?php } ?>
                    </select>
                </td>

            </tr>
            <tr>
                <td align="center" colspan="6" style="padding-top: 20px;">
                    <input type="submit" value="Search" class="button" />
                    <input type="reset" value="Clear" class="button" id="resetInsuredValue" />
                </td>
            </tr>
        </table>
    </form>
</div>