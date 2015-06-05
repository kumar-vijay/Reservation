<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/broker">Manage Broker</a><span> >>&nbsp; </span></li>
        <li class="selected">View Broker Details</li>
    </ul>
    <a href="/admin/broker" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Broker Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Broker Name</td>
                        <td width="22%"><?php echo $brokerInfo->BrokerName; ?></td>
                        <td width="12%">Wholesaler/Retailer</td>
                        <td width="22%"><?php echo $brokerType[0]['Alias']; ?></td>
                        <td width="12%">Broker Sub-Type</td>
                        <td width="22%"><?php echo $brokerSubType[0]['Alias']; ?></td> 
                    </tr>
                    <tr>
                        <td>Broker Country</td>
                        <td><?php echo $country[0]['InsuredCountry']; ?></td> 
                        <td>Broker State</td>
                        <td><?php echo $state[0]['FullCode']; ?></td> 
                        <td>Broker City</td>
                        <td><?php echo $city[0]['CityFullCode']; ?></td>
                    </tr>
                    <tr>
                        <td>Address Line1</td>
                        <td><?php echo $brokerInfo->AddressLine1; ?></td>
                        <td>Address Line2</td>
                        <td><?php echo $brokerInfo->AddressLine2; ?></td>
                        <td>Zipcode</td>
                        <td><?php echo $brokerInfo->ZipCode; ?></td>
                    </tr>
                    <tr>
                        <td>5-digit Broker Code</td>
                        <td><?php echo $brokerInfo->BrokerCode; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@broker_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>