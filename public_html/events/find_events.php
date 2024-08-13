<?php
session_start();
$pageTitle = "Find Events";
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/private/db.php';
?>
<main>
    <div class="find-events-container">
        <h2>Find an Awesome Event Now !!!</h2>
        <div class="search-filter-container">
            <input type="text" id="search-bar" placeholder="Search for events...">
            <select id="category-filter">
                <option value="">All Categories</option>
                <option value="Music">Music</option>
                <option value="Food & Drinks">Food & Drinks</option>
                <option value="Nightlife and Parties">Nightlife and Parties</option>
                <option value="Learning">Learning</option>
                <option value="Gaming">Gaming</option>
                <option value="Sports">Sports</option>
                <option value="Others">Others</option>
            </select>
            <input type="date" id="date-filter">
        </div>
        <div id="events-container">
            <!-- Events will be dynamically loaded here -->
        </div>
        <div class="pagination" id="pagination">
            <!-- Pagination links will be dynamically loaded here -->
        </div>
    </div>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/EventVersee/public_html/templates/footer.php';
?>
<link rel="stylesheet" href="/EventVersee/public_html/css/find_events.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/EventVersee/public_html/js/find_events.js"></script>
