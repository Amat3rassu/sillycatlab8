<?php
$url = 'http://lab.vntu.org/api-server/lab8.php';
$params = array(
    'user' => 'student',
    'pass' => 'p@ssw0rd'
);

$context = stream_context_create(array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
    ),
));
$json_data = file_get_contents($url . '?' . http_build_query($params), false, $context);

$data = json_decode($json_data, true);

if ($data !== null) {
    $people = array();
    foreach ($data as $group) {
        foreach ($group as $person) {
            $people[] = $person;
        }
    }
    ?>
    <table border="1">
        <tr>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Вік</th>
            <th>Місто</th>
        </tr>
        <?php foreach ($people as $person) { ?>
        <tr>
            <td><?php echo $person['name'] ?? ''; ?></td>
            <td><?php echo $person['affiliation'] ?? ''; ?></td>
            <td><?php echo $person['rank'] ?? ''; ?></td>
            <td><?php echo $person['location'] ?? ''; ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php
} else {
    echo 'Дані не отримані';
}
?>
