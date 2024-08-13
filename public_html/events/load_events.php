<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$events_per_page = 10;
$offset = ($page - 1) * $events_per_page;

$query = "SELECT event_id, event_name, event_date, event_location, event_category, event_image FROM events WHERE 1";

if (!empty($search)) {
    $query .= " AND event_name LIKE '%$search%'";
}
if (!empty($category)) {
    $query .= " AND event_category = '$category'";
}
if (!empty($date)) {
    $query .= " AND event_date = '$date'";
}

$query .= " ORDER BY event_date DESC LIMIT $offset, $events_per_page";
$result = mysqli_query($conn, $query);

$events = '';
while ($event = mysqli_fetch_assoc($result)) {
    // Ensure the image path is correct and exists
    $image_path = !empty($event['event_image']) ? '/EventVersee/public_html/' . htmlspecialchars($event['event_image']) : '/EventVersee/public_html/uploads/default-event.jpg';

    $events .= '<div class="event-card">';
    $events .= '<a href="/EventVersee/public_html/events/event_details.php?id=' . htmlspecialchars($event['event_id']) . '">';
    $events .= '<img src="' . $image_path . '" alt="' . htmlspecialchars($event['event_name']) . '">';
    $events .= '<div class="event-details">';
    $events .= '<h3>' . htmlspecialchars($event['event_name']) . '</h3>';
    $events .= '<p>' . htmlspecialchars($event['event_date']) . '</p>';
    $events .= '<p>' . htmlspecialchars($event['event_location']) . '</p>';
    $events .= '<p>' . htmlspecialchars($event['event_category']) . '</p>';
    $events .= '</div>';
    $events .= '</a>';
    $events .= '</div>';
}

// Pagination logic
$total_query = "SELECT COUNT(*) as total FROM events WHERE 1";
if (!empty($search)) {
    $total_query .= " AND event_name LIKE '%$search%'";
}
if (!empty($category)) {
    $total_query .= " AND event_category = '$category'";
}
if (!empty($date)) {
    $total_query .= " AND event_date = '$date'";
}
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_events = $total_row['total'];
$total_pages = ceil($total_events / $events_per_page);

$pagination = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $active = $i == $page ? 'active' : '';
    $pagination .= '<a href="#" class="pagination-link ' . $active . '" data-page="' . $i . '">' . $i . '</a>';
}

echo json_encode(['events' => $events, 'pagination' => $pagination]);

mysqli_close($conn);
?>
