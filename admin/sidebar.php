<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sidebar</title>

        <style>
            * {
            box-sizing: border-box;
            }

            .column {
            float: left;
            width: 33.33%;
            padding: 5px;
            }

            /* Clearfix (clear floats) */
            .row::after {
            content: "";
            clear: both;
            display: table;
            }

            /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 500px) {
            .column {
                width: 100%;
            }
            }
        </style>
    </head>
    <body>
        <div class="sidebar"  style="color:white; background-color: #4D0000;">
            <div class="side-header">
                <img src="../../assets/images/pup logo.png" width="120px" height="120px">
                <div class="user">Hello <?php echo $_SESSION['name']; ?>!</div>
            </div>
            <div class="menu">
                <div>
                    <a class="btn" HREF='/cpelab/admin/admin_logs/admin-logs.php'>
                        <div class="menu_icon"><i class='fas fa-layer-group'></i></div>
                        <div class="menu_text">Logs</div>
                    </a>
                </div>
                <div>
                    <a class="btn" HREF='/cpelab/admin/admin_accounts/admin-accounts.php'>
                        <div class="menu_icon"><i class='fas fa-door-open'></i></div>
                        <div class="menu_text">Accounts</div>
                    </a>
                </div>
            </div>
            <div class="row" style="position: fixed;  bottom: 0;">
                <div class="logout">
                    <div class="column">
                        <a href="../../logout.php" class="btn">
                            <div class="menu_icon"><i class='fas fa-sign-out-alt'></i></div>
                            <div class="menu_text">Logout</div>
                        </a>
                    </div>
                    <div class="column">
                        <a href="/cpelab/admin/admin_logs/logs-archive.php" class="btn">
                            <div class="menu_icon"><i class='fa-sharp fa-solid fa-file-zipper'></i></div>
                            <div class="menu_text">Archives</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>