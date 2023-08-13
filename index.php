<!DOCTYPE html>
<html>
<head>
    <title>News Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .tab {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .active-tab {
            background-color: #007bff;
            color: #fff;
        }

        .news-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            transition: background-color 0.2s ease;
        }

        .news-item:hover {
            background-color: #f5f5f5;
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        p {
            color: #666;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>News Portal</h1>
</header>

<div class="container">
    <div class="tab" id="cnnTab">CNN News</div>
    <div class="tab" id="cnbcTab">CNBC News</div>

    <div id="newsContainer">
        <?php
            function fetchNews($apiUrl) {
                $response = file_get_contents($apiUrl);
                $data = json_decode($response);

                if ($data && isset($data->data) && count($data->data) > 0) {
                    foreach ($data->data as $news) {
                        echo '<div class="news-item">';
                        echo '<h2>' . $news->title . '</h2>';
                        echo '<p>' . $news->contentSnippet . '</p>';
                        echo '<p>' . $news->isoDate . '</p>';
                        echo '<p><a href="' . $news->link . '" target="_blank">Read more</a></p>';
                        if ($news->enclosure && $news->enclosure->url) {
                            echo '<img src="' . $news->enclosure->url . '" alt="Image">';
                        }
                        echo '</div>';
                    }
                } else {
                    echo '<p>No news available.</p>';
                }
            }

            if (isset($_GET['source'])) {
                $source = $_GET['source'];
                if ($source === 'cnn') {
                    fetchNews('https://news-api-zhirrr.vercel.app/v1/cnn-news');
                } elseif ($source === 'cnbc') {
                    fetchNews('https://news-api-zhirrr.vercel.app/v1/cnbc-news');
                }
            }
        ?>
    </div>
</div>

<script>
    const cnnTab = document.getElementById('cnnTab');
    const cnbcTab = document.getElementById('cnbcTab');
    const newsContainer = document.getElementById('newsContainer');

    cnnTab.addEventListener('click', fetchCnnNews);
    cnbcTab.addEventListener('click', fetchCnbcNews);

    function fetchCnnNews() {
        location.href = '?source=cnn';
    }

    function fetchCnbcNews() {
        location.href = '?source=cnbc';
    }
</script>

</body>
</html>
