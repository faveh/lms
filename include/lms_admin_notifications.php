            <div class="well" id="notify-well">
                <div class="row">
                <div class="col-md-4">
                <button id="TS" class="btn btn-success btn-xs pull-left" title="toggle sidebar" style="margin-right: 15px;"><strong>TS</strong></button>
                <strong><span class="glyphicon glyphicon-info-sign text-info"></span> NOTIFICATIONS BAR <span class="text-primary">[DASHBOARD]</span></strong>
                </div>

                <br>

                <div class="col-md-8 text-right" style="width: 100%;">
                    <ul class="inline-list">
                        <li title="Total Registered Users"><span class="glyphicon glyphicon-user text-info"></span> <?php if(isset($totalUsers)) {echo $totalUsers;} else {echo 0;} ?></li>
                        <li title="Total Users Online"><span class="glyphicon glyphicon-user text-success"></span> <?php if(isset($onlineUsers)) {echo $onlineUsers;} else {echo 0;} ?></li> 
                        <li title="Total Books in Database"><span class="glyphicon glyphicon-book text-warning"></span> <?php if(isset($books_amount)) {echo $books_amount;} else {echo 0;} ?></li>
                    </ul>
                </div>
                </div>
            </div>