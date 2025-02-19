<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Frequency Counter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fce4ec;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
            border-top: 5px solid #e91e63;
        }
        textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            resize: none;
        }
        select, input, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #e91e63;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #c2185b;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="color: #e91e63;">Word Frequency Counter</h2>
    <form method="POST">
        <textarea name="text" placeholder="Enter text here..." required></textarea>
        <select name="order">
            <option value="desc">Descending</option>
            <option value="asc">Ascending</option>
        </select>
        <input type="number" name="limit" min="1" max="50" value="10" placeholder="Number of words to display">
        <button type="submit">Analyze</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text = $_POST["text"];
        $order = $_POST["order"];
        $limit = $_POST["limit"];

        function tokenizeText($text) {
            $text = strtolower($text);
            $text = preg_replace('/[^a-z\s]/', '', $text);
            return array_filter(explode(" ", $text));
        }

        function removeStopWords($words) {
            $stopWords = ["the", "and", "in", "of", "to", "a", "is", "it", "that", "on", "for", "with", "as", "this", "but", "at"];
            return array_diff($words, $stopWords);
        }

        function calculateWordFrequency($words) {
            return array_count_values($words);
        }

        function sortFrequencies(&$wordFreq, $order) {
            $order === "asc" ? asort($wordFreq) : arsort($wordFreq);
        }

        $words = tokenizeText($text);
        $filteredWords = removeStopWords($words);
        $wordFrequencies = calculateWordFrequency($filteredWords);
        sortFrequencies($wordFrequencies, $order);

        echo "<div class='result'><h3 style='color: #e91e63;'>Word Frequencies:</h3><ul>";
        $counter = 0;
        foreach ($wordFrequencies as $word => $count) {
            if ($counter >= $limit) break;
            echo "<li><strong>$word</strong>: $count</li>";
            $counter++;
        }
        echo "</ul></div>";
    }
    ?>
</div>

</body>
</html>