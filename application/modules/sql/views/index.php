<ul id="breadcrumb">
    <li><a href="debug/fund">ACCOUNT</a></li>   
</ul>
<div id="content">
    <form id="frm_query" method="post">
        <table class="form">
            <tr>
                <th>Host</th>
                <td><?php echo form_input('host'); ?></td>
            </tr>
            <tr>
                <th>Database</th>
                <td><?php echo form_input('database'); ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo form_input('username'); ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo form_password('password'); ?></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="Submit" class="button" /></td>
            </tr>
        </table>
    </form>
    <div id="result_query" style="margin-top: 10px;"></div>
</div>