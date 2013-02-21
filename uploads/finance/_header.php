<div id="headerFinance">
<div id="home"><a href="finance"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานการคลัง"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:200px;">
            <?php if(permission('finance_budget_plan', 'canview')): ?><li><a href="finance_budget_plan">แผนงบประมาณ</a></li><?php endif;?>
            <?php if(permission('finance_budget_id', 'canview')): ?><li><a href="finance_budget_id">รหัสงบประมาณ</a></li><?php endif;?>
            <?php if(permission('finance_money_during_year', 'canview')): ?><li><a href="finance_money_during_year">เงินงบประมาณระหว่างปี</a></li><?php endif;?>
            <?php if(permission('finance_budget_related', 'canview')): ?><li><a href="finance_budget_related">ผูกพันงบประมาณ</a></li><?php endif;?>
            <?php if(permission('finance_approve_withdraw', 'canview')): ?><li><a href="finance_approve_withdraw">อนุมัติเบิกเงิน</a></li><?php endif;?>
            <?php if(permission('finance_budget_return', 'canview')): ?><li><a href="finance_budget_return">คืนเงินงบประมาณ</a></li><?php endif;?>
            <?php if(permission('finance_approve_withdraw_replace', 'canview')): ?><li><a href="finance_approve_withdraw_replace">อนุมัติเบิกเงินเบิกแทน</a></li><?php endif;?>
          </ul>
        </li>
        
        <?php if(permission('finance_report', 'canview')): ?>
        <li><a href="#">รายงาน +</a>
            <ul style="width:170px;">
            	<li><a href="report_return_budget_outstand.php">คืนงบประมาณค้างเบิก</a></li>
                <li><a href="report_withdraw.php">เบิกจ่าย</a></li>
        		<li><a href="report_transfer.php">การโอน</a></li>
        		<li><a href="report_withdraw_replace.php">เบิกแทน</a></li>
                <li><a href="report_wallet.php">เงินกัน</a></li>
                <li><a href="report_budget_status.php">สถานะงบประมาณ</a></li>
                <li><a href="logfile.php" target="_blank">Log File</a></li>
            </ul>
        </li>
        <?php endif;?>
<!--        
        <li><a href="#">ตั้งค่า +</a>
            <ul style="width:180px;">
                <li><a href="budget_cat.php">หมวดรายจ่าย</a></li>
                <li><a href="percent.php">หักเงินตามนโยบาย %</a></li>
            </ul>
        </li>
-->        
</ul>
</div>
<div id="login">
<? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?> <br />
<span>เข้าสู่ระบบโดย <a href="profile" class="link_login"><?php echo login_data('users.name'); ?></a> (<?php echo login_data('user_type_title.title'); ?>)</span>
<a href="logout.php"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>