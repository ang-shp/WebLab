<?php
require_once 'db.php';

$sql = "SELECT id, gene_name, expression_value, regulation_status FROM genes ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-dark table-hover align-middle mb-0">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">ID</th>';
    echo '<th scope="col">Gene</th>';
    echo '<th scope="col">Expression</th>';
    echo '<th scope="col">Status</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $status = htmlspecialchars($row['regulation_status']);

        $badgeClass = 'bg-secondary';
        if ($status === 'up-regulated') {
            $badgeClass = 'bg-success';
        } elseif ($status === 'down-regulated') {
            $badgeClass = 'bg-danger';
        } elseif ($status === 'normal') {
            $badgeClass = 'bg-primary';
        }

        echo '<tr>';
        echo '<td>' . (int)$row['id'] . '</td>';
        echo '<td><strong>' . htmlspecialchars($row['gene_name']) . '</strong></td>';
        echo '<td>' . htmlspecialchars($row['expression_value']) . '</td>';
        echo '<td><span class="badge ' . $badgeClass . '">' . $status . '</span></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<div class="alert alert-warning mb-0">У таблиці genes поки немає даних.</div>';
}

$conn->close();
?>