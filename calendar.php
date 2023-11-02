<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 95vh;
            justify-content: center;
            align-items: center;

        }

        .box {
            width: 30%;
            background-color: blue;
            height: 100%;
        }

        .calendar {
            display: flex;
            flex-wrap: wrap;
            width: 60%;
            height: 100%;
            background-color: lightcoral;
        }

        .switch {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: lightgreen;
            width: 10%;
            height: 80%;
        }

        a {
            display: block;
            width: 100%;
            height: 30%;
            background-color: red;
        }

        /* 標題 */
        .title {
            width: 100%;
            height: 10%;
            background-color: gold;
            text-align: center;
            font-size: 60px;
        }

        /* 星期 */
        .dateline {
            background-color: lightgrey;
            width: 100%;
            height: 10%;
        }

        .dateline>table,
        tr,
        td {
            text-align: center;
            margin: auto;
        }

        .dateline>table {
            width: 100%;
            height: 100%;
        }

        /* 日期 */
        .datecase {
            width: 100%;
            height: 75%;
        }

        .datecase>table,
        tr,
        td {
            margin: auto;
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 40px;
        }

        .datecase>table {
            width: 100%;
            height: 100%;
        }
        
    </style>
</head>

<body>

    <?php

    if (isset($_GET["month"]) && isset($_GET["year"])) {
        $month = $_GET["month"];
        $year = $_GET["year"];
        $nowmonth=date("m");
        $nowyear=date("Y");
    } else {
        $month = date("m");
        $year = date("Y");
    }

    $monthfirstday = date("{$year}-{$month}-1");
    $monthfirstdate = date("w", strtotime($monthfirstday));
    $monthspaceday = date("Y-m-d", strtotime("-{$monthfirstdate}days", strtotime($monthfirstday)));
    $monthdays = date("t");
    $monthlastday = date("{$year}-{$month}-{$monthdays}");
    $monthweeks = ceil(($monthdays + $monthfirstdate) / 7);

    ?>

    <div class="container">
        <div class="box">

        </div>
        <div class="calendar">
            <div class="title">
                    <?= date("$year 年 $month 月") ?>
            </div>
            <div class="dateline">
                <table>
                    <tr>
                        <th>SUN</th>
                        <th>MON</th>
                        <th>TUE</th>
                        <th>WEN</th>
                        <th>THU</th>
                        <th>FRI</th>
                        <th>SAT</th>
                    </tr>
                </table>
            </div>
            <div class="datecase">
                <table>
                    <?php
                    for ($i = 0; $i < $monthweeks; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 7; $j++) {
                            $addday = 7 * $i + $j;
                            $monthallday = strtotime("+$addday days", strtotime($monthspaceday));
                            if (date("w", $monthallday) == 0 || date("w", $monthallday) == 6) {
                                echo "<td style='color:red' >";
                            } else {
                                echo "<td>";
                            }
                            if (date("m", $monthallday) == date("m", strtotime($monthfirstday))) {
                                echo date("j", $monthallday);
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
            </div>
        </div>
        <div class="switch">
            <?php
            $nextyear = $year;
            $prevyear = $year;
            if (($month + 1) > 12) {
                $next = 1;
                $nextyear = $year + 1;
            } else {
                $next = $month + 1;
            }
            if (($month - 1) < 1) {
                $prev = 12;
                $prevyear = $year - 1;
            } else {
                $prev = $month - 1;
            }
            ?>
            <a href="?year=<?= $prevyear; ?>&month=<?= $prev; ?>">上一個月</a>
            <a href="?year=<?=$nowyear; ?>&month=<?=$nowmonth;?>">回到現在</a>
            <a href="?year=<?= $nextyear; ?>&month=<?= $next; ?>">下一個月</a>
        </div>
    </div>

</body>

</html>