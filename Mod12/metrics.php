<?php

    session_start();

    require_once __DIR__ . '/bootstrap.php';

    // total page views (30 days)
    $totalPageViewsStmt = $pdo->query("
        SELECT COUNT(*) AS total_page_views_30d
        FROM page_views
        WHERE created_at >= NOW() - INTERVAL '30 days'
    ");
    $totalPageViews = $totalPageViewsStmt->fetch(PDO::FETCH_ASSOC)['total_page_views_30d'] ?? 0;

    // unique visitors (distinct sessions) (30 days)
    $uniqueVisitorsStmt = $pdo->query("
        SELECT COUNT(DISTINCT session_id) AS unique_visitors_30d
        FROM page_views
        WHERE created_at >= NOW() - INTERVAL '30 days'
    ");
    $uniqueVisitors = $uniqueVisitorsStmt->fetch(PDO::FETCH_ASSOC)['unique_visitors_30d'] ?? 0;

    // total events (30 days)
    $totalEventsStmt = $pdo->query("
        SELECT COUNT(*) AS total_events_30d
        FROM web_events
        WHERE created_at >= NOW() - INTERVAL '30 days'
    ");
    $totalEvents = $totalEventsStmt->fetch(PDO::FETCH_ASSOC)['total_events_30d'] ?? 0;

    // --- 2) Page views by day (last 14 days) ---

    $pageViewsByDayStmt = $pdo->query("
        SELECT
            date_trunc('day', created_at) AS day,
            COUNT(*) AS views
        FROM page_views
        WHERE created_at >= NOW() - INTERVAL '14 days'
        GROUP BY day
        ORDER BY day DESC
    ");
    $pageViewsByDay = $pageViewsByDayStmt->fetchAll(PDO::FETCH_ASSOC);

    // --- 3) Top pages (last 30 days) ---

    $topPagesStmt = $pdo->query("
        SELECT
            path,
            COUNT(*) AS views
        FROM page_views
        WHERE created_at >= NOW() - INTERVAL '30 days'
        GROUP BY path
        ORDER BY views DESC
        LIMIT 10
    ");
    $topPages = $topPagesStmt->fetchAll(PDO::FETCH_ASSOC);

    // --- 4) Events by type (last 30 days) ---

    $eventsByTypeStmt = $pdo->query("
        SELECT
            event_name,
            COUNT(*) AS events_count
        FROM web_events
        WHERE created_at >= NOW() - INTERVAL '30 days'
        GROUP BY event_name
        ORDER BY events_count DESC
    ");
    $eventsByType = $eventsByTypeStmt->fetchAll(PDO::FETCH_ASSOC);

    // Query: Count page views per page
    $stmt = $pdo->query("
        SELECT 
        path, 
        COUNT(*) AS views 
    FROM page_views 
    GROUP BY path
    ");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Extract data for JavaScript
    $paths = array_column($results, 'path');
    $views = array_column($results, 'views');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site Metrics</title>
    <style>
    :root {
        --color1: #CFBAE1; /* light purple */
        --color2: #3A5683; /* deep blue */
        --color3: #FC9E4F; /* orange accent */
        --color4: #61C9A8; /* mint green */
        --color5: #BA3B46; /* red accent */
        --color6: #a4a4a4; /* gray */
        --color7: #2E4756; /* dark blue-gray */
        --color8: #16262E; /* near black background */
        --color9: #3C7A89; /* teal */
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        background-color: var(--color8);
        color: var(--color1);
        min-height: 100vh;
        padding: 40px;
    }

    h1, h2 {
        color: var(--color4);
        text-align: center;
        margin-bottom: 20px;
        letter-spacing: 0.05em;
    }

    /* Stats Cards */
    .cards {
        width: 90%;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin: 0 auto 30px auto;
    }

    .card {
        background: #fff;
        color: var(--color8);
        padding: 20px;
        border-radius: 12px;
        width: 200px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.35);
    }

    .card-title {
        font-size: 0.75rem;
        font-weight: bold;
        text-transform: uppercase;
        color: var(--color7);
        margin-bottom: 6px;
        letter-spacing: 0.06em;
    }

    .card-value {
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--color5);
    }

    .subtext {
        font-size: 0.85rem;
        color: var(--color6);
        margin-top: 6px;
        text-align: center;
    }

    /* Table Styling */
    table {
        width: 90%;
        margin: 0 auto 40px auto;
        border-collapse: collapse;
        background-color: #fff;
        color: var(--color8);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    th {
        background-color: var(--color7);
        color: var(--color1);
        padding: 14px;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
        text-align: left;
    }

    td {
        padding: 14px;
        border-bottom: 1px solid #ddd;
        font-size: 0.95rem;
    }

    tbody tr:nth-child(even) {
        background-color: var(--color1);
    }

    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: var(--color3);
        color: #fff;
        transition: background-color 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cards {
            width: 100%;
        }
        table {
            width: 100%;
        }
        h1, h2 {
            font-size: 1.6rem;
        }
    }
</style>

</head>
<body>

<h1>Site Metrics Dashboard</h1>
<p class="subtext">Data from PostgreSQL: page_views, web_sessions, web_events</p>

<div class="cards">
    <div class="card">
        <div class="card-title">Page Views (Last 30 Days)</div>
        <div class="card-value"><?= htmlspecialchars((string)$totalPageViews) ?></div>
    </div>
    <div class="card">
        <div class="card-title">Unique Visitors (Last 30 Days)</div>
        <div class="card-value"><?= htmlspecialchars((string)$uniqueVisitors) ?></div>
    </div>
    <div class="card">
        <div class="card-title">Events Logged (Last 30 Days)</div>
        <div class="card-value"><?= htmlspecialchars((string)$totalEvents) ?></div>
    </div>
    
</div>

<h2>Page Views by Day (Last 14 Days)</h2>
<table>
    <tr>
        <th>Day</th>
        <th>Views</th>
    </tr>
    <?php if (empty($pageViewsByDay)): ?>
        <tr><td colspan="2">No data</td></tr>
    <?php else: ?>
        <?php foreach ($pageViewsByDay as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['day']) ?></td>
                <td><?= htmlspecialchars($row['views']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<h2>Top Pages (Last 30 Days)</h2>
<table>
    <tr>
        <th>Path</th>
        <th>Views</th>
    </tr>
    <?php if (empty($topPages)): ?>
        <tr><td colspan="2">No data</td></tr>
    <?php else: ?>
        <?php foreach ($topPages as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['path']) ?></td>
                <td><?= htmlspecialchars($row['views']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<h2>Events by Type (Last 30 Days)</h2>
<table>
    <tr>
        <th>Event Name</th>
        <th>Count</th>
    </tr>
    <?php if (empty($eventsByType)): ?>
        <tr><td colspan="2">No data</td></tr>
    <?php else: ?>
        <?php foreach ($eventsByType as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['event_name']) ?></td>
                <td><?= htmlspecialchars($row['events_count']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<div style="width:500px;margin:auto;padding-top:20px;">
    <h2 style="text-align:center;">Page View Distribution</h2>
    <canvas id="viewsPieChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pageLabels = <?php echo json_encode($paths); ?>;
    const pageData = <?php echo json_encode($views); ?>;

    new Chart(document.getElementById('viewsPieChart'), {
        type: 'pie',
        data: {
            labels: pageLabels,
            datasets: [{
                data: pageData,
                backgroundColor: [
                    '#007bff','#28a745','#ffc107',
                    '#dc3545','#6f42c1','#20c997',
                    '#fd7e14'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: false
                }
            }
        }
    });
</script>


</body>
</html>