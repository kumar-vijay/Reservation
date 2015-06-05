<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/country">Manage Country</a><span> >>&nbsp; </span></li>
        <li class="selected">View Country Details</li>
    </ul>
    <a href="/admin/country" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Country Details
            <div class="arrow"></div>
        </h1>
        <div class="content adminview" style="display: block;">
            <form method="POST" action="" name="" id="">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Country Name</td>
                        <td width="22%"><?php echo $countryName; ?></td>
                        <td width="12%">Country Code</td>
                        <td width="22%"><?php echo $countryCode; ?></td>
                        <td width="12%">Final Country Name</td>
                        <td width="22%"><?php echo $CountryInfo[0]['InsuredCountry']; ?></td> 
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="reset" value="Back" onclick="location.href = '<?php echo url_for('@country_list') ?>';" class="btn btn-blue" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>