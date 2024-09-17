<?php
// compress.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputFile = urldecode($_POST['file']);
    $outputDir = "compressed/";
    $outputFile = $outputDir . 'compressed_' . basename($inputFile);

    // Check if the input file exists
    if (!file_exists($inputFile)) {
        die("Input file not found.");
    }

    // Define FFmpeg command for compression
    $ffmpegCommand = "ffmpeg -i " . escapeshellarg($inputFile) . " -vcodec libx264 -crf 28 " . escapeshellarg($outputFile);

    // Start the compression process
    $descriptors = [
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ];
    $process = proc_open($ffmpegCommand, $descriptors, $pipes);

    if (is_resource($process)) {
        while ($output = fgets($pipes[1])) {
            // Output progress to client
            if (preg_match('/time=(\d+:\d+:\d+\.\d+)/', $output, $matches)) {
                echo $matches[1];  // Example of progress output
                flush();
                ob_flush();
            }
        }
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);

        echo "Compression completed. <a href='$outputFile'>Download compressed video</a>";
    } else {
        echo "Failed to start the compression process.";
    }
}
?>
