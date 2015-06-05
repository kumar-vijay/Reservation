<!--Filter Section-->
<div class="content">
    <form method="POST" action="" name="groupSearchForm" id="groupSearchForm">	
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="12%">Group Name</td>
                <td width="22%">
                    <input type="text" id="groupName" name="groupName" maxlength="30" />
                </td>
                <td>&nbsp;</td>
                <td width="12%">Group Status</td>
                <td width="22%">
                    <select name="groupStatus" id="groupStatus" class="listbox-small">
                        <option value="1" selected>All</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Create Date</td>
                <td colspan="4">
                    <input type="text" name="fromDate" readonly class="width69 from" id="fromDate" placeholder="From date" />
                    <input type="text" name="toDate" class="width69 to" id="toDate" readonly placeholder="To date" />
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center">
                    <input type="submit" value="Search" class="btn btn-blue" id="groupSearch" />
                    <input type="reset" value="Clear" class="btn btn-cyan" id="groupreset" />
                </td>
            </tr>
        </table>
    </form>
    <!--/div-->
</div>
<!--Filter Section-->