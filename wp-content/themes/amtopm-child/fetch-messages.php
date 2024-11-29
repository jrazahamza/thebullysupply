<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
include ('connection.php');

$itemsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Get total records count
$totalItemsResult = mysqli_query($con, "SELECT COUNT(*) as total FROM `contactRequest`");
$totalItemsArray = mysqli_fetch_assoc($totalItemsResult);
$totalItems = $totalItemsArray['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

// Fetch paginated records
$query = "SELECT * FROM `contactRequest` ORDER BY id DESC LIMIT $offset, $itemsPerPage";
$contactRequests = mysqli_query($con, $query);

$tableData = '';
while ($contactRequest = mysqli_fetch_array($contactRequests)) {
    $listingQuery = "SELECT * FROM `listings` WHERE `id`='" . $contactRequest['product'] . "' AND `userID`='" . $_COOKIE["user_id"] . "'";
    $listing = mysqli_fetch_array(mysqli_query($con, $listingQuery));
    if ($listing['id']) {
        $tableData .= '<tr>
            <td><img class="email-pro-img" src="' . $listing['gallery1'] . '" alt="' . $listing['title'] . '" style="border-radius:0px;"><h4>'. $listing['title']; .'</td>
            <td>' . $contactRequest['firstName'] . ' ' . $contactRequest['lastName'] . '</td>
            <td>' . $contactRequest['phoneNumber'] . '</td>
            <td>' . date("F d, Y", strtotime($contactRequest['created_at'])) . '</td>
            <td>' . $contactRequest['emailAddress'] . '</td>
            <td>' . $contactRequest['address'] . '</td>
            <td>' . $contactRequest['description'] . '</td>
            <td><button class="active">Responded</button></td>
            <td>
                <div class="btn-group">
                    <button><i class="fa fa-eye" aria-hidden="true"></i></button>
                    <button><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </td>
        </tr>';
    }
}

// Pagination info
$startItem = $offset + 1;
$endItem = min($offset + $itemsPerPage, $totalItems);
$paginationInfo = "Showing $startItem-$endItem of $totalItems";

// Pagination buttons
$paginationButtons = '';
if ($page > 1) {
    $paginationButtons .= '<button class="pagination-button btn btn-primary" data-page="' . ($page - 1) . '"><i class="fa-solid fa-angle-left"></i> Previous</button>';
}
if ($page < $totalPages) {
    $paginationButtons .= '<button class="pagination-button btn btn-primary" data-page="' . ($page + 1) . '">Next <i class="fa-solid fa-angle-right"></i></button>';
}

// Return JSON response
echo json_encode([
    'tableData' => $tableData,
    'paginationInfo' => $paginationInfo,
    'paginationButtons' => $paginationButtons
]);
?>
