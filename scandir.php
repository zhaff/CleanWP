<a href="scandir.php?replace=1">Click here to replace all</a> | <a href="scandir.php">Click here to refresh</a>
<br>
<br>
<?php

$replace = 0;

if (!empty($_REQUEST['replace'])) {
    $replace = $_REQUEST['replace'];
}

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));

foreach ($it as $file) {

    if (strpos($file, 'index.php') !== false) {

        $content = file_get_contents($file, FALSE, NULL, 0, 1000);

        // var_dump($content);

        preg_match_all('((\/\*.....\*\/)|(\@include.\"....))', $content, $matches);
        // var_dump($matches);

        $filter = $matches[0];

        if (count($filter) > 0) {
            echo '<b>' . $file . '</b><br />';

            // Delete hacked lines
            $data = file($file);

            // var_dump($data);

            $out = array();

            echo '<br/><span style="text-decoration: underline;">Hacked lines found:</span><br/><pre>';
            print_r($filter);
            echo '</pre>';

            $start = false;

            foreach ($data as $line) {
                if (!contains(trim($line), $filter)) {
                    $out[] = $line;
                }
            }

            // var_dump($out);

            if ($replace == '1') {

                $fp = fopen($file, "w+");
                flock($fp, LOCK_EX);

                foreach ($out as $line) {
                    fwrite($fp, $line);
                }
                flock($fp, LOCK_UN);
                fclose($fp);
            }
        }
    }
}

if ($replace == '1') {
    header("Location: scandir.php");
    exit();
}

function contains($str, array $arr)
{
    foreach ($arr as $a) {
        if (stripos(trim($str), trim($a)) !== false) return true;
    }
    return false;
}
