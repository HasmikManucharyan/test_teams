<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .schedule-block {
            width: 420px;
            border: 1px solid;
            margin-bottom: 16px;
            padding: 16px;
            border-radius: 5px;
        }
        .schedule-item {
            display: flex;
            border-bottom: 1px solid #f0f0f0;
            padding: 5px 0;
        }
        .schedule-item div:nth-child(2n+1) {
            width: 45%;
        }
        .schedule-item div:nth-child(2n) {
            width: 10%;
            text-align: center;
        }
        .schedule-item div:first-of-type {
            text-align: right;
        }
        .all-schedules {
            display: flex;
            gap: 16px;
        }
        .schedule-item-title {
            display: flex;
            background-color: #ebebeb;
            padding: 10px 0;
            font-weight: 600;
        }
        .schedule-item-title div:first-of-type {
            width: 50%;
            text-align: right;
        }
        .schedule-item-title div:last-of-type {
            width: 50%;
            padding-left: 10%;
        }
        .highlighted {
            background-color: yellow;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<?php
$teams = [
    "Ливерпуль",
    "Челси",
    "Тоттенхэм Хотспур",
    "Арсенал",
    "Манчестер Юнайтед",
    "Эвертон",
    "Лестер Сити",
    "Вест Хэм Юнайтед",
    "Уотфорд",
    "Борнмут",
    "Бернли",
    "Саутгемптон",
    "Брайтон энд Хоув Альбион",
    "Норвич Сити",
    "Шеффилд Юнайтед",
    "Фулхэм",
    "Сток Сити",
    "Мидлсбро",
    "Суонси Сити",
    "Дерби Каунти"
];

shuffle($teams);
function generateSchedule($teams) {
    $schedule = [];
    $numTeams = count($teams);
    $numRounds = $numTeams - 1;
    $halfSize = $numTeams / 2;

    for ($round = 0; $round < $numRounds; $round++) {
        $matches = [];
        for ($i = 0; $i < $halfSize; $i++) {
            $home = ($round + $i) % ($numTeams - 1);
            $away = ($numTeams - 1 - $i + $round) % ($numTeams - 1);

            if ($i == 0) {
                $away = $numTeams - 1;
            }

            $matches[] = [$teams[$home], $teams[$away]];
        }
        $schedule[$round] = $matches;
    }

    return $schedule;
}

$schedule = generateSchedule($teams);
$secondHalfSchedule = generateSchedule($teams);

foreach ($secondHalfSchedule as &$matches) {
    foreach ($matches as &$match) {
        $match = array_reverse($match);
    }
}
echo '<div class="all-schedules"><div><h1>Первый круг</h1>';
foreach ($schedule as $round => $matches) {
    echo "<div class='schedule-block'><h5>Тур " . ($round + 1) . "</h5>";
    echo "<div class='schedule-item-title'><div>Хозяева</div><div>Гости</div></div>";
    foreach ($matches as $match) {
        echo "<div class='schedule-item'><div class='schedule-team'>".$match[0] . "</div><div> - : -</div> <div class='schedule-team'>" . $match[1] . "</div></div>";
    }
    echo '</div>';
}
echo '</div>';

echo '<div><h1>Второй круг</h1>';
foreach ($secondHalfSchedule as $round => $matches) {
    echo "<div class='schedule-block'><h5>Тур " . ($round + 1) . "</h5>";
    echo "<div class='schedule-item-title'><div>Хозяева</div><div>Гости</div></div>";
    foreach ($matches as $match) {
        echo "<div class='schedule-item'><div class='schedule-team'>".$match[0] . "</div><div> - : -</div> <div class='schedule-team'>" . $match[1] . "</div></div>";
    }
    echo '</div>';
}
echo '</div></div>';

?>
<script>
    $(function() {
        $('.schedule-team').on('click', function(){
            var teamName = $(this).text();
            $(".schedule-team").removeClass("highlighted");
            $(".schedule-team:contains('" + teamName + "')").addClass("highlighted");
        });
    })
</script>
</body>
</html>
