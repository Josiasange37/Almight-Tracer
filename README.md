<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=F7F7F7&background=21212100&center=true&vCenter=true&width=435&lines=Almight+Tracker+v0.3;IP+Tracking+%2B+GPS+%2B+Censys;Advanced+Information+Gathering" alt="Typing SVG" />
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Version-0.3-blue?style=for-the-badge&logo=none" alt="Version">
  <img src="https://img.shields.io/badge/Status-Active-success?style=for-the-badge&logo=none" alt="Status">
  <img src="https://img.shields.io/badge/License-MIT-orange?style=for-the-badge&logo=none" alt="License">
  <img src="https://img.shields.io/badge/Platform-Linux-lightgrey?style=for-the-badge&logo=linux" alt="Platform">
</p>

<p align="center">
  <b>Advanced IP Tracker & Information Gathering Tool with Automatic Censys Integration</b>
  <br>
  <br>
  <a href="https://github.com/Josiasange37">
    <img src="https://img.shields.io/github/followers/Josiasange37?label=Follow&style=social" alt="GitHub">
  </a>
  <a href="https://github.com/Josiasange37/hound">
    <img src="https://img.shields.io/github/stars/Josiasange37/hound?style=social" alt="GitHub Stars">
  </a>
</p>

---

## 🚀 Overview

**Almight Tracker v0.3** is a powerful social engineering and information gathering tool designed for authorized security testing. It creates a convincing, pixel-perfect replica of the **ChatGPT** interface to gather detailed information about a target device, including:

* **IP Address**
* **GPS Location** (Latitude/Longitude)
* **Device Info** (OS, Browser, CPU, RAM)
* **Network Info** (ISP, Country, Region)

Upon capturing an IP, the tool automatically performs a **Censys Lookup**, generating direct search links to uncover open ports, services, and potential vulnerabilities associated with the target's network.

## ✨ Key Features

* **🎨 Realistic ChatGPT Interface:** A pixel-perfect clone of the ChatGPT UI (Dark Mode), featuring:
  * **Mobile-First Design:** Fully responsive sidebar, hamburger menu, and touch-optimized layout.
  * **Interactive Chat:** Functional "Enter to send", auto-resizing inputs, and dynamic message bubbles.
  * **Authentic Visuals:** Exact color palette, fonts, and icons used by OpenAI.
* **🔍 Automatic Censys Integration:**
  * Automatically captures and saves unique IPs to `captured_ips.txt`.
  * Generates direct **Censys Search Links** upon exit for immediate reconnaissance.
* **📍 Precision Tracking:**
  * Captures high-accuracy GPS coordinates (if permitted by user).
  * Provides Google Maps and Google Earth links.
* **🛡️ Secure Tunneling:** Uses `Cloudflared` to generate secure, anonymous HTTPS links (no port forwarding required).

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/Josiasange37/hound.git

# Navigate to the directory
cd hound

# Grant execution permissions
chmod +x hound.sh
```

## 🛠️ Usage

1. **Run the tool:**

    ```bash
    ./hound.sh
    ```

2. **Select Tunnel:** Choose `Y` to use Cloudflared (recommended) for a public link.
3. **Send Link:** Send the generated link to the target.
4. **Wait for Data:** Information will appear in the terminal as soon as the target clicks the link.
5. **Exit & Analyze:** Press `Ctrl + C` to stop. The tool will automatically display **Censys search links** for all captured IPs.

## 📂 Output Files

* `targetreport.txt`: Detailed session log with all captured data.
* `captured_ips.txt`: List of unique captured IP addresses.
* `saved.ip.txt`: Raw IP log.

## ⚠️ Disclaimer

> **This tool is for EDUCATIONAL PURPOSES and AUTHORIZED SECURITY TESTING ONLY.**
>
> The developer is not responsible for any misuse or damage caused by this program. You are responsible for your own actions. Using this tool to track or gather information about individuals without their explicit consent is illegal and punishable by law.

---

<p align="center">
  <b>Be wise</b>
</p>
