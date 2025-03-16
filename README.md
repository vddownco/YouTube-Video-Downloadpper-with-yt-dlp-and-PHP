# YouTube Video Downloader with yt-dlp and PHP

## 🎯 Project Overview

A lightweight YouTube video downloader built with PHP that leverages `yt-dlp` and `FFmpeg` for downloading videos in different formats. This project is self-contained and runs entirely within the project directory without depending on external system installations.

---

## 📂 Project Structure

```
youtube-downloader/
│
├── downloads/           # Downloaded videos are saved here
│
├── yt-dlp.exe          # yt-dlp executable
├── ffmpeg/             # FFmpeg portable
│   ├── ffmpeg.exe
│   ├── ffplay.exe
│   └── ffprobe.exe
│
├── index.html          # Frontend UI
├── style.css           # Styling for UI
├── download.php        # Handles the download process

```

---

## 🚀 Installation

1️⃣ **Clone the repository or download the zip file.**

2️⃣ **Download and place ****`yt-dlp.exe`**** in the root directory.**

3️⃣ **Download the portable version of ****`FFmpeg`**** and place it inside the ****`ffmpeg/`**** folder.**

4️⃣ Ensure the folder structure looks like the one mentioned above.

---

## 🌐 Usage

1️⃣ Open `index.html` in your browser.

2️⃣ Enter the YouTube video URL and select the desired format (MP4, MP3, etc.).

3️⃣ Click on the **Download** button.

4️⃣ The video will be downloaded and saved in the `downloads/` folder.

---

## 🛠️ How It Works

- The user submits the URL via a form.
- The `download.php` script handles the input and executes the `yt-dlp` command.
- `FFmpeg` is used for post-processing if required (e.g., converting to MP3).
- The downloaded video is saved in the `downloads/` folder.

---

## ✅ Command Used

```php
$command = "\"$ytDlpPath\" --ffmpeg-location ffmpeg/ -f best -o \"downloads/%(title)s.%(ext)s\" --merge-output-format $format $videoUrl";
```

---

## ⚡ Supported Formats

- MP4
- MP3
- WEBM
- AVI

---

## 🧐 Troubleshooting

### ❌ Common Issues:

- `FFmpeg not found`: Ensure FFmpeg is inside the `ffmpeg/` folder.
- `yt-dlp not working`: Update to the latest version.
- Invalid URL: Verify the YouTube URL.

---

## 📜 License

This project is for educational purposes only. Use it responsibly.

---

