# Hound - Enhanced with Censys Integration 🐶

Hound is a simple and light tool for information gathering and capture exact GPS coordinates

## New Features ✨

### Automatic IP Capture to File

- All captured IPs are automatically saved to `captured_ips.txt`
- Duplicate IPs are prevented
- One IP per line for easy parsing

### Censys Search Integration

- When you exit Hound (Ctrl+C), it automatically:
  - Displays all captured IPs
  - Shows location information (Country, City, ISP, Coordinates)
  - Generates Censys search links for each IP
  - Presents results in a beautiful, color-coded format

### Example Output on Exit

```
[*] Generating Censys search links...

╔════════════════════════════════════════════════════╗
║         CENSYS IP LOOKUP & LOCATION INFO          ║
╚════════════════════════════════════════════════════╝

[*] Found 3 captured IP(s)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[1/3] IP Address: XXX.XXX.XXX.XXX

   Location Details:
   ├─ Country: United States
   ├─ Region: California
   ├─ City: San Francisco
   ├─ ISP: Example ISP
   └─ Coordinates: 37.7749, -122.4194

   Censys Search Link:
   └─ https://search.censys.io/hosts/XXX.XXX.XXX.XXX

[✓] All Censys links generated successfully!
```

## What is Hound?

Hound is a tool that can remotely capture the exact GPS coordinates of a target device using a PHP server, and can also grab basic information about the system and ISP. This tool can be very helpful in information gathering. you can get following information of the target device:

- Longitude
- Latitude
- Device Model
- Operating System
- Number of CPU Cores
- Screen Resolution
- User agent
- Public IP Address
- Browser Name
- ISP Information

## Features

The tool offers a wide range of features and functionality, including:

- Capture Exact GPS Location
- Automated Data Collection
- User-friendly Interface
- **NEW:** Automatic IP storage to text file
- **NEW:** Censys search integration on exit
- **NEW:** Location information display

## This Tool Tested On

- Kali Linux
- Windows(WSL)
- Termux
- MacOS
- Ubuntu
- Parrot Sec OS

## Installing and requirements

This tool require PHP for webserver, wget & unzip for download and extract cloudflare. First run following command on your terminal:

```bash
apt-get -y install php unzip git wget
```

## Installing (Kali Linux/Termux)

```bash
git clone https://github.com/techchipnet/hound
cd hound
bash hound.sh
```

## Usage

1. Run Hound:

   ```bash
   bash hound.sh
   ```

2. Share the generated link with your target

3. When target visits the link, their information is captured

4. Press `Ctrl+C` to exit and view:
   - All captured IPs
   - Location information
   - Censys search links

## Files Generated

- `captured_ips.txt` - Unique IPs captured (one per line)
- `data.txt` - Detailed location and device information
- `saved.ip.txt` - Backup of all IP captures
- `targetreport.txt` - Complete session report

## Optional: Auto-Open Censys Links

To automatically open Censys links in your browser when exiting, edit `censys_lookup.sh` and uncomment lines 77-81:

```bash
if command -v xdg-open > /dev/null 2>&1; then
    xdg-open "$censys_link" > /dev/null 2>&1 &
elif command -v open > /dev/null 2>&1; then
    open "$censys_link" > /dev/null 2>&1 &
fi
```

## Change log

- **Version: 0.3**: Added Censys integration and automatic IP capture to file
- Version: 0.2: Remove Ngrok and update cloudflared tunnel

## Video Demo

[![Hound Demo](https://img.youtube.com/vi/IiJRyVmITgI/0.jpg)](https://www.youtube.com/watch?v=IiJRyVmITgI)

### For More Video subcribe [TechChip YouTube Channel](http://youtube.com/techchipnet)

---

**Disclaimer:** Hound is created to help in penetration testing and it's not responsible for any misuse or illegal purposes.

**Credits:**

- Original Tool: TechChip
- Chatbot template: Masud Rana
- Censys Integration: Enhanced Version
