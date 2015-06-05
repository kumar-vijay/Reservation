<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/city">Manage City</a><span> >>&nbsp; </span></li>
        <li class="selected">View City Details</li>
    </ul>
    <a href="/admin/city" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">City Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">State Name</td>
                        <td width="22%"><?php echo $CityInfo[0]['FullCode']; ?></td>
                        <td width="12%">City Name</td>
                        <td width="22%"><?php echo $CityInfo[0]['City']; ?></td>
                        <td width="12%">City Code</td>
                        <td width="22%"><?php echo $CityInfo[0]['CityCode']; ?></td> 
                    </tr>
                    <tr>
                        <td width="12%">Broker City Name</td>
                        <td width="22%"><?php echo $CityInfo[0]['CityFullCode']; ?></td>
                        <td width="12%">Retail Broker City Name</td>
                        <td width="22%"><?php echo $CityInfo[0]['RetailBrokerCity']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@city_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>