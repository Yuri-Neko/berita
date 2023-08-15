<!DOCTYPE html>
<html>
<head>
    <title>Komik Latest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .comic-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .comic-box {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: calc(33.33% - 45px);
            display: flex;
            align-items: center;
        }
        .thumbnail {
            max-width: 100px;
            margin-right: 10px;
        }
        .comic-info {
            flex: 1;
        }
        .comic-title {
            font-weight: bold;
        }
        .comic-updated {
            color: #888;
        }
        .read-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .read-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="comic-container">
        <?php
            $url = "https://web.api-kyouka.my.id/api/anime/komiku/latest?apikey=youkey";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data && $data['status'] === 200 && isset($data['result'])) {
                $count = 0;
                foreach ($data['result'] as $comic) {
                    if ($count >= 30) {
                        break;
                    }
                    echo '<div class="comic-box">';
                    echo '    <img class="thumbnail" src="' . $comic['thumbnail'] . '" alt="Thumbnail">';
                    echo '    <div class="comic-info">';
                    echo '        <div class="comic-title">' . $comic['title'] . '</div>';
                    echo '        <div class="comic-updated">' . $comic['updated'] . '</div>';
                    echo '        <div><strong>Chapter:</strong> ' . $comic['chapter'] . '</div>';
                    echo '        <button class="read-button" onclick="window.open(\'' . $comic['url'] . '\', \'_blank\');">Read</button>';
                    echo '    </div>';
                    echo '</div>';
                    $count++;
                }
            } else {
                echo 'Failed to fetch data.';
            }
        ?>
    </div>
</body>
</html>
