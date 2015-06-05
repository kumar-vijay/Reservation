<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/state">Manage State</a><span> >>&nbsp; </span></li>
        <li class="selected">View State Details</li>
    </ul>
    <a href="/admin/state" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">State Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Country Name</td>
                        <td width="22%"><?php echo $countryData[0]['InsuredCountry']; ?></td>
                        <td width="12%">State Name</td>
                        <td width="22%"><?php echo $StateInfo[0]['StateName']; ?></td>
                        <td width="12%">Broker State Code</td>
                        <td width="22%"><?php echo $StateInfo[0]['Code']; ?></td> 
                    </tr>
                    <tr>
                        <td width="12%">Broker State Name</td>
                        <td width="22%"><?php echo $StateInfo[0]['FullCode']; ?></td>
                        <td width="12%">Retail Broker State Name</td>
                        <td width="22%"><?php echo $StateInfo[0]['RetailBrokerState']; ?></td>
                        <td width="12%">State Abbreviation</td>
                        <td width="22%"><?php echo $StateInfo[0]['Abreviation']; ?></td> 
                    </tr>
                    <tr>
                        <td width="12%">Abbreviated Broker State Name</td>
                        <td width="22%"><?php echo $StateInfo[0]['StateCode']; ?></td>
                        <td width="12%">Project State Code</td>
                        <td width="22%"><?php echo $StateInfo[0]['ProjectStateCode']; ?></td>
                        <td width="12%">Project State Name</td>
                        <td width="22%"><?php echo $StateInfo[0]['ProjectCode']; ?></td> 
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@state_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>