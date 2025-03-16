<?php
// Increase script execution time
set_time_limit(300);

if (isset($_POST['url'])) {
    $videoUrl = escapeshellarg($_POST['url']); // Secure input
    $quality = $_POST['quality'] ?? 'best';
    $format = $_POST['format'] ?? 'mp4';

    // Set the download directory
    $outputDir = __DIR__ . '/downloads';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Path to FFmpeg and yt-dlp
    $ffmpegPath = __DIR__ . '/ffmpeg/ffmpeg.exe';
    $ytDlpPath = __DIR__ . '/yt-dlp.exe';

    // Determine the format and quality options
    $formatOption = '';
    if ($format === 'mp3') {
        $formatOption = '--extract-audio --audio-format mp3';
    } else {
        $formatOption = '--format "bestvideo[height<=' . intval($quality) . ']+bestaudio/best"';
    }

    // yt-dlp command with format and quality
    $command = "\"$ytDlpPath\" --ffmpeg-location \"$ffmpegPath\" $formatOption -o \"$outputDir/%(title)s.%(ext)s\" $videoUrl";

    exec($command, $output, $returnCode);

    if ($returnCode === 0) {
        // Find the downloaded file
        $files = glob("$outputDir/*.{mp4,webm,mp3}", GLOB_BRACE);
        if (count($files) > 0) {
            $filePath = $files[0];
            $fileName = basename($filePath);

            // Force the browser to download the file
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);

            // Delete the file from the server after download
            unlink($filePath);
            exit;
        } else {
            echo "❌ No file found!";
        }
    } else {
        echo "❌ Failed to download the video!<br>";
        echo "<pre>";
        print_r($output);
        echo "</pre>";
    }
} else {
    echo "❌ No URL provided!";
}