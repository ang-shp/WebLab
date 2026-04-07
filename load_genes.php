<?php
require_once 'db.php';

$sql = "SELECT id, gene_name, expression_value, regulation_status FROM genes ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="card">';
    echo '<h3>Дані з бази даних</h3>';
    echo '<table style="width:100%; border-collapse: collapse;">';
    echo '<tr>
            <th style="border:1px solid #ccc; padding:8px;">ID</th>
            <th style="border:1px solid #ccc; padding:8px;">Gene</th>
            <th style="border:1px solid #ccc; padding:8px;">Expression</th>
            <th style="border:1px solid #ccc; padding:8px;">Status</th>
          </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td style="border:1px solid #ccc; padding:8px;">' . $row['id'] . '</td>';
        echo '<td style="border:1px solid #ccc; padding:8px;">' . htmlspecialchars($row['gene_name']) . '</td>';
        echo '<td style="border:1px solid #ccc; padding:8px;">' . htmlspecialchars($row['expression_value']) . '</td>';
        echo '<td style="border:1px solid #ccc; padding:8px;">' . htmlspecialchars($row['regulation_status']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
} else {
    echo '<div class="card"><p>У таблиці поки немає даних.</p></div>';
}

$conn->close();
?>