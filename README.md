<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=F7F7F7&background=21212100&center=true&vCenter=true&width=435&lines=Almight+Tracker+v0.4;Advanced+Multi-Template+Tracker;WebRTC+%2B+Fingerprint+%2B+Camera" alt="Typing SVG" />
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Version-0.4-blue?style=for-the-badge&logo=none" alt="Version">
  <img src="https://img.shields.io/badge/Status-Active-success?style=for-the-badge&logo=none" alt="Status">
  <img src="https://img.shields.io/badge/License-MIT-orange?style=for-the-badge&logo=none" alt="License">
  <img src="https://img.shields.io/badge/Platform-Linux-lightgrey?style=for-the-badge&logo=linux" alt="Platform">
</p>

<p align="center">
  <b>Advanced Multi-Template Tracker with Photo/Video Capture & Credential Harvesting</b>
  <br>
  <br>
  <a href="https://github.com/Josiasange37">
    <img src="https://img.shields.io/github/followers/Josiasange37?label=Follow&style=social" alt="GitHub">
  </a>
  <a href="https://github.com/Josiasange37/Almight-Tracer">
    <img src="https://img.shields.io/github/stars/Josiasange37/Almight-Tracer?style=social" alt="GitHub Stars">
  </a>
</p>

---

## 🚀 Overview

**Almight Tracker v0.4** is a powerful social engineering and information gathering tool designed for authorized security testing. It features multiple realistic phishing templates with advanced tracking capabilities:

* **IP Address** (including WebRTC leak detection)
* **GPS Location** (High-accuracy with altitude/speed)
* **Device Fingerprint** (Canvas, Hardware, Browser)
* **Camera/Mic Permissions** with silent photo/video capture
* **Credential Harvesting** (Google Security template)
* **Persistent User Tracking** (localStorage + cookies)

Upon capturing an IP, the tool automatically performs a **Censys Lookup**, generating direct search links to uncover open ports, services, and potential vulnerabilities.

## ✨ Key Features

### 🎨 Multiple Phishing Templates

* **ChatGPT Interface:** Pixel-perfect dark mode clone with mobile support
* **Cloudflare Verification:** "Checking your browser" page
* **Google Login:** Authentic Google sign-in interface
* **WhatsApp Security Alert:** Official WhatsApp support page design
* **Google Security Team:** Google support-style credential harvesting

### 🕵️‍♂️ Advanced Tracking

* **WebRTC Leak Detection:** Captures real IPs even behind VPNs
* **Browser Fingerprinting:**
  * Canvas fingerprinting
  * Screen resolution & hardware specs
  * Timezone & language detection
* **High-Accuracy GPS:** Captures precise location with altitude & speed
* **Persistent Tracking:** Tracks returning users via localStorage + cookies

### 📸 Media Capture

* **Silent Photo Capture:** Takes photo without flash when camera permission granted
* **Silent Video Recording:** Records 5 seconds of video automatically
* **Saved to:** `captures/photo_[uid]_[timestamp].jpg` and `captures/video_[uid]_[timestamp].webm`

### 🔑 Credential Harvesting

* **Google Security Template:** Captures email/password
* **Permission-Gated:** Requires device verification before credential submission
* **Auto-Redirect:** Redirects to real google.com after capture for authenticity

### 🛡️ Security Features

* **Cloudflared Tunneling:** Secure, anonymous HTTPS links
* **Automatic Censys Integration:** Generates search links for captured IPs
* **Mobile-First Design:** All templates fully responsive

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/Josiasange37/Almight-Tracer.git

# Navigate to the directory
cd Almight-Tracer

# Grant execution permissions
chmod +x almight.sh
```

## 🛠️ Usage

1. **Run the tool:**

    ```bash
    ./almight.sh
    ```

2. **Select Template:** Choose from 5 phishing templates:
    * [1] ChatGPT Interface (Default)
    * [2] Cloudflare Verification
    * [3] Google Login
    * [4] WhatsApp Security Alert
    * [5] Google Security Team

3. **Select Tunnel:** Choose `Y` to use Cloudflared (recommended) for a public HTTPS link.

4. **Send Link:** Send the generated link to the target.

5. **Wait for Data:** Information will appear in the terminal as soon as the target interacts:
    * IP address & location
    * Device fingerprint
    * GPS coordinates
    * Camera/mic permissions
    * Photos & videos (if granted)
    * Credentials (Google Security template)

6. **Exit & Analyze:** Press `Ctrl + C` to stop. The tool will automatically display **Censys search links** for all captured IPs.

## 📂 Output Files

* `data.txt`: Real-time log of all captured data
* `targetreport.txt`: Detailed session log with all captured information
* `captured_ips.txt`: List of unique captured IP addresses
* `saved.ip.txt`: Raw IP log
* `captures/`: Directory containing captured photos and videos
  * `photo_[uid]_[timestamp].jpg`: Captured photos
  * `video_[uid]_[timestamp].webm`: Captured videos

## 🎯 Template Features

| Template | Credential Capture | Photo/Video | Permission Gating | Mobile Optimized |
|----------|-------------------|-------------|-------------------|------------------|
| ChatGPT Interface | ❌ | ✅ | ❌ | ✅ |
| Cloudflare | ❌ | ✅ | ❌ | ✅ |
| Google Login | ❌ | ✅ | ❌ | ✅ |
| WhatsApp Security | ❌ | ✅ | ✅ | ✅ |
| Google Security | ✅ | ✅ | ✅ | ✅ |

## 🔧 Technical Details

**Dependencies:**

* PHP (built-in server)
* Cloudflared (auto-installed)
* jQuery (CDN)
* Font Awesome (CDN)

**Tracking Methods:**

* WebRTC STUN servers
* IP-API.com geolocation
* Canvas fingerprinting
* MediaDevices API
* Geolocation API (high accuracy mode)

## 💬 Contact & Support

**Need help? Have ideas? Want updates?**

<p align="center">
  <a href="https://discord.gg/mYZwYQ3J">
    <img src="https://img.shields.io/badge/Discord-Join%20Server-5865F2?style=for-the-badge&logo=discord&logoColor=white" alt="Discord">
  </a>
  <a href="https://t.me/+657375975">
    <img src="https://img.shields.io/badge/Telegram-Contact%20Me-26A5E4?style=for-the-badge&logo=telegram&logoColor=white" alt="Telegram">
  </a>
</p>

**Join our community for:**
* 🚀 Latest updates and new features
* 💡 Share your ideas and suggestions
* 🐛 Report bugs and issues
* 🤝 Collaborate on improvements
* 📚 Get help and support

## ⚠️ Disclaimer

> **This tool is for EDUCATIONAL PURPOSES and AUTHORIZED SECURITY TESTING ONLY.**
>
> The developer is not responsible for any misuse or damage caused by this program. You are responsible for your own actions. Using this tool to track, gather information, or harvest credentials from individuals without their explicit consent is illegal and punishable by law.
>
> **Always obtain proper authorization before conducting security assessments.**

## 📝 Changelog

### v0.4 (Latest)

* ✅ Added WhatsApp Security Alert template

* ✅ Added Google Security Team template
* ✅ Implemented silent photo/video capture
* ✅ Added credential harvesting (Google template)
* ✅ Implemented permission-gated verification
* ✅ Enhanced mobile responsiveness
* ✅ Added persistent user tracking
* ✅ Improved GPS accuracy with altitude/speed

### v0.3

* Added ChatGPT, Cloudflare, and Google Login templates

* Implemented WebRTC leak detection
* Added browser fingerprinting
* Integrated Censys lookup

---

<p align="center">
  <b>⭐ Star this repo if you find it useful!</b>
  <br>
  <b>Made with ❤️ by Josias</b>
</p>
