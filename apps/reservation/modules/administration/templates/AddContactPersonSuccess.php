<div class="breadcrumbs group"> 
    <ul id="breadcrumb">
        <li><a href="/">Home</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/masterDataManagement">Master Data Management</a><span> >>&nbsp; </span></li>
        <li><a href="/admin/contactperson">Manage Contact Person</a><span> >>&nbsp; </span></li>
        <li class="selected">Add Contact Person Details</li>
    </ul>
    <a href="/admin/contactperson" id="back"></a>
</div>
<div class="clear"></div>

<div class="container">
    <div class="box">
        <h1 class="section-header">Contact Person Details
            <div class="arrow"></div>
        </h1>
        <div class="content" style="display: block;">
            <?php
            if (isset($errorArr)) {
                ?>
                <div class="grouperror">
                    <?php
                    foreach ($errorArr as $err => $val) {
                        echo "<li>$val</li>";
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <form method="POST" action="" name="contactpersonAddForm" id="contactpersonAddForm">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="12%">Party Type<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <select name="pertytype" id="pertytype" class="listbox-small">
                                <option value="0">--Select--</option>
                                    <?php foreach ($partyType as $value){ ?>                            
                                        <option value="<?php echo $value['Id']; ?>"><?php echo $value['Alias']; ?></option>                            
                                    <?php } ?>
                            </select>
                        <td width="12%">Company Name<span style="color: red;"> *</span></td>
                        <td width="22%">
                            <input type="text" name="companyname" id="companyname" class="txtbox-small"/>
                        </td>
                        <td width="12%">Title</td>
                        <td width="22%"> 
                             <input type="text" name="title" id="title" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr> 
                        <td>First Name<span style="color: red;"> *</span></td>
                        <td> 
                           <input type="text" name="firstname" id="firstname" class="txtbox-small" />
                        </td>
                        <td>Last Name<span style="color: red;"> *</span></td>
                        <td> 
                           <input type="text" name="lastname" id="lastname" class="txtbox-small" />
                        </td>
                        <td>Function</td>
                        <td> 
                           <input type="text" name="function" id="function" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email Address<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="emailaddress" id="emailaddress" class="txtbox-small" />
                        </td>
                        <td>Phone Number<span style="color: red;"> *</span></td>
                        <td>
                            <input type="text" name="phonenumber" id="phonenumber" class="txtbox-small" />
                        </td>
                        <td>Mobile Number</td>
                        <td>
                            <input type="text" name="mobilenumber" id="mobilenumber" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr>
                        <td>Fax</td>
                        <td>
                            <input type="text" name="fax" id="fax" class="txtbox-small" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <input type="submit" value="Submit" class="btn btn-blue" id="contactpersonSubmit" name="contactpersonSubmit" />
                            <input type="reset" value="Cancel" onclick="location.href = '<?php echo url_for('@contactperson_list') ?>';" class="btn btn-cyan" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>