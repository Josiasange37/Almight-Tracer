const msgerForm = get(".msger-inputarea");
const msgerInput = get(".msger-input");
const msgerChat = get(".msger-chat");
const msgerSendBtn = get(".msger-send-btn");

const BOT_MSGS = [
  "Hi, how are you?",
  "Turn your location on for find people near you",
  "I am powered by ChatGPT 4",
  "I feel sleepy! :("];

const BOT_NAME = "ChatGPT";
const PERSON_NAME = "You";

// Enable/disable send button based on input
msgerInput.addEventListener("input", () => {
  if (msgerInput.value.trim()) {
    msgerSendBtn.classList.add("active");
  } else {
    msgerSendBtn.classList.remove("active");
  }
});

// Handle Enter key (send) and Shift+Enter (new line)
msgerInput.addEventListener("keydown", (event) => {
  if (event.key === "Enter" && !event.shiftKey) {
    event.preventDefault();
    if (msgerInput.value.trim()) {
      msgerForm.dispatchEvent(new Event("submit"));
    }
  }
});

// Auto-resize textarea
msgerInput.addEventListener("input", () => {
  msgerInput.style.height = "auto";
  msgerInput.style.height = msgerInput.scrollHeight + "px";
});

msgerForm.addEventListener("submit", event => {
  event.preventDefault();

  const msgText = msgerInput.value.trim();
  if (!msgText) return;

  appendMessage(PERSON_NAME, "right", msgText);
  msgerInput.value = "";
  msgerInput.style.height = "auto";
  msgerSendBtn.classList.remove("active");

  botResponse();
});

function appendMessage(name, side, text) {
  const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-container">
        <div class="msg-img">
          <i class="fas fa-${side === 'left' ? 'robot' : 'user'}"></i>
        </div>

        <div class="msg-content">
          <div class="msg-info-name">${name}</div>
          <div class="msg-text">${text}</div>
          
          ${side === 'left' ? `
          <div class="msg-actions">
            <button class="msg-action-btn" title="Copy"><i class="far fa-copy"></i></button>
            <button class="msg-action-btn" title="Like"><i class="far fa-thumbs-up"></i></button>
            <button class="msg-action-btn" title="Dislike"><i class="far fa-thumbs-down"></i></button>
            <button class="msg-action-btn" title="Share"><i class="fas fa-share-nodes"></i></button>
            <button class="msg-action-btn" title="Regenerate"><i class="fas fa-rotate-right"></i></button>
            <button class="msg-action-btn" title="More"><i class="fas fa-ellipsis"></i></button>
          </div>
          ` : ''}
        </div>
      </div>
    </div>
  `;

  msgerChat.insertAdjacentHTML("beforeend", msgHTML);
  msgerChat.scrollTop = msgerChat.scrollHeight;
}

function botResponse() {
  const r = random(0, BOT_MSGS.length - 1);
  const msgText = BOT_MSGS[r];
  const delay = msgText.split(" ").length * 100;

  setTimeout(() => {
    appendMessage(BOT_NAME, "left", msgText);
  }, delay);
}

// Sidebar Toggle Logic
const sidebar = get(".sidebar");
const sidebarOverlay = get(".sidebar-overlay");
const sidebarToggleBtn = get(".header-icon-btn"); // Hamburger menu in header
const sidebarCloseBtn = get(".sidebar-toggle"); // Toggle button inside sidebar

function toggleSidebar() {
  sidebar.classList.toggle("active");
  sidebarOverlay.classList.toggle("active");
}

function closeSidebar() {
  sidebar.classList.remove("active");
  sidebarOverlay.classList.remove("active");
}

if (sidebarToggleBtn) {
  sidebarToggleBtn.addEventListener("click", toggleSidebar);
}

if (sidebarCloseBtn) {
  sidebarCloseBtn.addEventListener("click", closeSidebar);
}

if (sidebarOverlay) {
  sidebarOverlay.addEventListener("click", closeSidebar);
}

// Utils
function get(selector, root = document) {
  return root.querySelector(selector);
}

function random(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}