<?php
// chatbot_widget.php — Floating AI Chatbot Widget
// Embedded in every page via footer.php
$chatbot_endpoint = base_url('chatbot/ask');
?>

<!-- ============================================================
     MEB AI CHATBOT WIDGET
     ============================================================ -->

<!-- Floating Trigger Button -->
<button id="chatbotTrigger" title="MEB AI Assistant" aria-label="Open chatbot">
  <span class="chatbot-trigger-icon">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14H8v-2h2v2zm0-4H8V7h2v5zm4 4h-2v-2h2v2zm0-4h-2V7h2v5z" fill="none"/>
      <circle cx="9" cy="9" r="1.5" fill="currentColor"/>
      <circle cx="15" cy="9" r="1.5" fill="currentColor"/>
      <path d="M12 2C6.477 2 2 6.477 2 12c0 1.82.487 3.53 1.338 5L2 22l5-1.338A9.954 9.954 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M8 13s1 2 4 2 4-2 4-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
    </svg>
  </span>
  <span class="chatbot-trigger-label">MEB AI</span>
  <span class="chatbot-badge" id="chatbotBadge" style="display:none;">1</span>
</button>

<!-- Chat Window -->
<div id="chatbotWindow" class="chatbot-window" role="dialog" aria-label="MEB AI Chatbot">

  <!-- Header -->
  <div class="chatbot-header">
    <div class="chatbot-header-left">
      <div class="chatbot-avatar">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
          <path d="M12 2C6.477 2 2 6.477 2 12c0 1.82.487 3.53 1.338 5L2 22l5-1.338A9.954 9.954 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" stroke="white" stroke-width="1.8" fill="rgba(255,255,255,.15)" stroke-linecap="round"/>
          <circle cx="9" cy="10" r="1.2" fill="white"/>
          <circle cx="15" cy="10" r="1.2" fill="white"/>
          <path d="M8.5 14s1 1.5 3.5 1.5 3.5-1.5 3.5-1.5" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
        </svg>
      </div>
      <div>
        <div class="chatbot-header-title">MEB AI Assistant</div>
        <div class="chatbot-header-sub">
          <span class="chatbot-status-dot"></span>
          Powered by Gemini · Live DB
        </div>
      </div>
    </div>
    <div class="chatbot-header-actions">
      <button id="chatbotClearBtn" title="Clear conversation" class="chatbot-icon-btn">
        <i class="ph ph-trash"></i>
      </button>
      <button id="chatbotFullscreenBtn" title="Fullscreen" class="chatbot-icon-btn">
        <i class="ph ph-arrows-out"></i>
      </button>
      <button id="chatbotCloseBtn" title="Close" class="chatbot-icon-btn">
        <i class="ph ph-x"></i>
      </button>
    </div>
  </div>

  <!-- Messages -->
  <div class="chatbot-messages" id="chatbotMessages">
    <!-- Welcome message injected by JS -->
  </div>

  <!-- Suggested prompts -->
  <div class="chatbot-suggestions" id="chatbotSuggestions">
    <button class="chatbot-suggestion" data-q="How many total beekeepers are registered?">🐝 Total beekeepers</button>
    <button class="chatbot-suggestion" data-q="What is the total honey production this year?">🍯 This year's production</button>
    <button class="chatbot-suggestion" data-q="Which apiary has the most active colonies?">📍 Top apiary</button>
    <button class="chatbot-suggestion" data-q="Give me beekeeping tips for rainy season">🌧️ Rainy season tips</button>
    <button class="chatbot-suggestion" data-q="How can I recover weak or inactive colonies?">🩺 Recover weak colonies</button>
    <button class="chatbot-suggestion" data-q="What bee species are most common here?">🔬 Bee species</button>
  </div>

  <!-- Input -->
  <div class="chatbot-input-row">
    <textarea id="chatbotInput"
              class="chatbot-input"
              placeholder="Ask anything about MEB, apiaries, production…"
              rows="1"
              aria-label="Chat input"></textarea>
    <button id="chatbotSendBtn" class="chatbot-send-btn" title="Send">
      <i class="ph ph-paper-plane-tilt"></i>
    </button>
  </div>
  <div class="chatbot-input-footer">
    <span>MEB AI can make mistakes. Verify critical data in the system.</span>
  </div>

</div>

<!-- Fullscreen Overlay -->
<div id="chatbotFullscreen" class="chatbot-fullscreen" style="display:none;">
  <div class="cfs-inner">

    <div class="cfs-header">
      <div class="cfs-header-left">
        <div class="chatbot-avatar cfs-avatar">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 2C6.477 2 2 6.477 2 12c0 1.82.487 3.53 1.338 5L2 22l5-1.338A9.954 9.954 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" stroke="white" stroke-width="1.8" fill="rgba(255,255,255,.15)" stroke-linecap="round"/>
            <circle cx="9" cy="10" r="1.4" fill="white"/>
            <circle cx="15" cy="10" r="1.4" fill="white"/>
            <path d="M8.5 14s1 1.5 3.5 1.5 3.5-1.5 3.5-1.5" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
          </svg>
        </div>
        <div>
          <div class="cfs-title">MEB AI Beekeeping Assistant</div>
          <div class="cfs-sub"><span class="chatbot-status-dot"></span> Powered by Google Gemini · Live Database Access</div>
        </div>
      </div>
      <div class="cfs-header-right">
        <button id="cfsClearBtn" class="chatbot-icon-btn cfs-btn" title="Clear"><i class="ph ph-trash"></i></button>
        <button id="cfsCloseBtn" class="chatbot-icon-btn cfs-btn" title="Exit fullscreen"><i class="ph ph-arrows-in"></i></button>
      </div>
    </div>

    <div class="cfs-body">
      <div class="cfs-messages" id="cfsMessages"></div>
      <div class="cfs-suggestions-wrap" id="cfsSuggestions">
        <button class="chatbot-suggestion" data-q="How can I recover weak colonies?">🩺 Recover weak colonies</button>
        <button class="chatbot-suggestion" data-q="Which municipality has the highest honey production?">📍 Top municipality</button>
        <button class="chatbot-suggestion" data-q="What to do if honey production drops unexpectedly?">📉 Low production advice</button>
        <button class="chatbot-suggestion" data-q="What are common bee diseases and how to treat them?">⚠️ Bee diseases</button>
        <button class="chatbot-suggestion" data-q="Best practices for honey harvesting">🍯 Harvest best practices</button>
        <button class="chatbot-suggestion" data-q="How to properly inspect a beehive?">🔍 Hive inspection</button>
      </div>
    </div>

    <div class="cfs-input-area">
      <div class="cfs-input-wrap">
        <textarea id="cfsInput" class="cfs-input" placeholder="Ask anything about MEB beekeeping data, best practices, colonies, production…" rows="1"></textarea>
        <button id="cfsSendBtn" class="chatbot-send-btn cfs-send" title="Send">
          <i class="ph ph-paper-plane-tilt"></i>
        </button>
      </div>
      <div class="chatbot-input-footer cfs-footer-note">
        MEB AI can make mistakes. Verify critical figures directly in the system.
      </div>
    </div>

  </div>
</div>

<!-- ============================================
     STYLES
     ============================================ -->
<style>
/* ── Trigger Button ─────────────────────────────────────── */
#chatbotTrigger {
  position:fixed;bottom:28px;right:28px;z-index:9000;
  display:flex;align-items:center;gap:8px;
  background:#1a4b9c;
  color:#fff;border:none;border-radius:50px;
  padding:12px 20px 12px 14px;
  box-shadow:0 6px 20px rgba(26,75,156,.35);
  cursor:pointer;font-weight:700;font-size:.85rem;
  transition:transform .2s cubic-bezier(.34,1.56,.64,1),box-shadow .2s,opacity .2s;
  font-family:inherit;
}
#chatbotTrigger:hover { transform:translateY(-4px) scale(1.04);box-shadow:0 14px 40px rgba(26,75,156,.55); }
#chatbotTrigger:active { transform:scale(.97); }
.chatbot-trigger-icon { display:flex;align-items:center;justify-content:center;width:32px;height:32px; }
.chatbot-trigger-label { white-space:nowrap; }
.chatbot-badge {
  position:absolute;top:-6px;right:-6px;
  background:#ff6b6b;color:#fff;border-radius:50%;
  width:18px;height:18px;display:flex;align-items:center;justify-content:center;
  font-size:.68rem;font-weight:800;border:2px solid #fff;
}

/* ── Chat Window ────────────────────────────────────────── */
.chatbot-window {
  position:fixed;bottom:96px;right:28px;z-index:8999;
  width:380px;
  background:#fff;border-radius:20px;
  box-shadow:0 24px 80px rgba(0,0,0,.22),0 0 0 1px rgba(0,0,0,.06);
  display:flex;flex-direction:column;
  overflow:hidden;
  max-height:580px;
  opacity:0;transform:translateY(20px) scale(.95);
  pointer-events:none;
  transition:opacity .25s,transform .25s cubic-bezier(.34,1.56,.64,1);
}
.chatbot-window.open {
  opacity:1;transform:translateY(0) scale(1);
  pointer-events:all;
}

/* ── Header ─────────────────────────────────────────────── */
.chatbot-header {
  background:#1a4b9c;
  padding:14px 16px;display:flex;align-items:center;justify-content:space-between;
  flex-shrink:0;
}
.chatbot-header-left { display:flex;align-items:center;gap:10px; }
.chatbot-avatar {
  width:38px;height:38px;border-radius:50%;
  background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.3);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.chatbot-header-title { color:#fff;font-weight:700;font-size:.92rem; }
.chatbot-header-sub { color:rgba(255,255,255,.7);font-size:.7rem;display:flex;align-items:center;gap:4px;margin-top:1px; }
.chatbot-status-dot { width:6px;height:6px;border-radius:50%;background:#4ade80;display:inline-block;animation:chatbot-pulse 2s infinite; }
@keyframes chatbot-pulse { 0%,100%{opacity:1}50%{opacity:.4} }

.chatbot-header-actions { display:flex;align-items:center;gap:4px; }
.chatbot-icon-btn {
  background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);
  color:rgba(255,255,255,.85);border-radius:8px;
  width:30px;height:30px;display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:background .15s;font-size:.95rem;padding:0;
}
.chatbot-icon-btn:hover { background:rgba(255,255,255,.28);color:#fff; }

/* ── Messages ───────────────────────────────────────────── */
.chatbot-messages {
  flex:1;overflow-y:auto;padding:20px 20px 10px;
  display:flex;flex-direction:column;gap:16px;
  scroll-behavior:smooth;
  background:#f8faff;
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none;  /* IE and Edge */
}
.chatbot-messages::-webkit-scrollbar { display:none; }

.chat-msg { display:flex;gap:10px;animation:chatbot-fadein .3s ease; max-width: 90%; }
@keyframes chatbot-fadein { from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none} }

.chat-msg.bot { align-self: flex-start; }
.chat-msg.user { flex-direction:row-reverse; align-self: flex-end; }

.chat-msg-avatar {
  width:32px;height:32px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:.9rem;flex-shrink:0;margin-top:auto;margin-bottom:auto;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.chat-msg.bot  .chat-msg-avatar { background:#1a4b9c;color:#fff; }
.chat-msg.user .chat-msg-avatar { background:#f0932b;color:#fff; }

.chat-bubble-wrapper { display: flex; flex-direction: column; gap: 4px; }
.chat-msg.bot .chat-bubble-wrapper { align-items: flex-start; }
.chat-msg.user .chat-bubble-wrapper { align-items: flex-end; }

.chat-bubble {
  padding:12px 16px;
  font-size:.88rem;line-height:1.5;
  word-break:break-word;
  box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}
.chat-msg.bot  .chat-bubble { background:#ffffff;border:1px solid #e2e8f0;border-radius:16px 16px 16px 4px;color:#334155; }
.chat-msg.user .chat-bubble { background:#1a4b9c;color:#ffffff;border-radius:16px 16px 4px 16px; }
.chat-msg.user .chat-bubble p { color: #ffffff !important; }
.chat-bubble p { margin:0 0 8px; }
.chat-bubble p:last-child { margin:0; }
.chat-bubble ul, .chat-bubble ol { margin:8px 0;padding-left:22px; }
.chat-bubble li { margin-bottom:4px; }
.chat-bubble strong { font-weight:700; color: inherit; }
.chat-bubble code { background:rgba(0,0,0,.08);padding:2px 6px;border-radius:6px;font-size:.85em; }
.chat-bubble pre { background:#1e293b;color:#f8fafc;padding:12px;border-radius:10px;overflow-x:auto;font-size:.8rem; }
/* Markdown table in bubble */
.chat-bubble table { border-collapse:collapse;width:100%;font-size:.8rem;margin:8px 0; }
.chat-bubble th { background:rgba(0,0,0,0.05);padding:6px 10px;text-align:left;border:1px solid rgba(0,0,0,0.1); }
.chat-bubble td { padding:6px 10px;border:1px solid rgba(0,0,0,0.1); }

.chat-time { font-size:.65rem;color:#94a3b8;font-weight: 500; }

/* Typing indicator */
.typing-indicator .chat-bubble {
  display:flex;align-items:center;gap:6px;padding:14px 18px;
}
.typing-dot { width:6px;height:6px;background:#94a3b8;border-radius:50%;animation:typing-bounce 1s infinite; }
.typing-dot:nth-child(2) { animation-delay:.2s; }
.typing-dot:nth-child(3) { animation-delay:.4s; }
@keyframes typing-bounce { 0%,80%,100%{transform:translateY(0)}40%{transform:translateY(-6px)} }

/* ── Suggestions ────────────────────────────────────────── */
.chatbot-suggestions {
  padding:12px 16px;display:flex;flex-wrap:wrap;gap:8px;
  background:#f8faff;border-top:1px solid #e2e8f0;flex-shrink:0;
}
.chatbot-suggestion {
  background:#ffffff;border:1px solid #cbd5e1;color:#1a4b9c;
  border-radius:24px;padding:6px 14px;font-size:.75rem;font-weight:600;
  cursor:pointer;transition:all .2s ease;white-space:nowrap;
  font-family:inherit;box-shadow: 0 2px 6px rgba(0,0,0,0.02);
}
.chatbot-suggestion:hover { background:#1a4b9c;color:#fff;border-color:#1a4b9c;transform:translateY(-1px);box-shadow: 0 4px 10px rgba(26,75,156,0.2); }

/* ── Input ──────────────────────────────────────────────── */
.chatbot-input-row {
  display:flex;align-items:flex-end;gap:10px;padding:12px 16px 10px;
  background:#fff;border-top:1px solid #e2e8f0;flex-shrink:0;
}
.chatbot-input {
  flex:1;border:1.5px solid #cbd5e1;border-radius:16px;padding:12px 16px;
  font-size:.9rem;resize:none;font-family:inherit;line-height:1.5;
  max-height:140px;overflow-y:auto;outline:none;
  transition:all .2s;color:#1e293b;background:#f8faff;
  box-sizing: border-box;
  box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.chatbot-input::-webkit-scrollbar { display:none; }
.chatbot-input:focus { border-color:#1a4b9c;background:#fff;box-shadow: 0 0 0 3px rgba(26,75,156,0.1); }
.chatbot-input::placeholder { color:#94a3b8; }

.chatbot-send-btn {
  width:44px;height:44px;border-radius:14px;
  background:#1a4b9c;
  color:#fff;border:none;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;flex-shrink:0;
  transition:transform .2s,box-shadow .2s,background .2s;
  box-shadow: 0 4px 12px rgba(26,75,156,0.25);
}
.chatbot-send-btn:hover { transform:scale(1.05);background:#143b7a;box-shadow:0 6px 16px rgba(26,75,156,.4); }
.chatbot-send-btn:disabled { background:#cbd5e1;cursor:not-allowed;transform:none;box-shadow:none; }

.chatbot-input-footer {
  text-align:center;font-size:.65rem;color:#94a3b8;
  padding:0 16px 12px;background:#fff;flex-shrink:0;
}

/* ── Fullscreen ─────────────────────────────────────────── */
.chatbot-fullscreen {
  position:fixed;inset:0;z-index:9100;
  background:rgba(10,20,40,.55);backdrop-filter:blur(8px);
  display:flex;align-items:center;justify-content:center;
  padding:20px;
}
.cfs-inner {
  background:#fff;border-radius:24px;
  width:100%;max-width:900px;height:90vh;max-height:860px;
  display:flex;flex-direction:column;
  box-shadow:0 40px 120px rgba(0,0,0,.3);
  overflow:hidden;
  animation:cfs-fadein .25s ease;
}
@keyframes cfs-fadein { from{opacity:0;transform:scale(.96)}to{opacity:1;transform:none} }

.cfs-header {
  background:#1a4b9c;
  padding:18px 24px;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;
}
.cfs-header-left { display:flex;align-items:center;gap:14px; }
.cfs-avatar { width:48px;height:48px;border-radius:50%; }
.cfs-title { color:#fff;font-weight:800;font-size:1.1rem; }
.cfs-sub { color:rgba(255,255,255,.7);font-size:.75rem;display:flex;align-items:center;gap:5px;margin-top:2px; }
.cfs-header-right { display:flex;gap:6px; }
.cfs-btn { width:36px;height:36px;border-radius:10px; }

.cfs-body { flex:1;overflow:hidden;display:flex;flex-direction:column;background:#f8faff; }
.cfs-messages {
  flex:1;overflow-y:auto;padding:20px 24px 12px;
  display:flex;flex-direction:column;gap:12px;scroll-behavior:smooth;
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.cfs-messages::-webkit-scrollbar { display:none; }
/* Bigger bubbles in fullscreen */
.cfs-messages .chat-bubble { font-size:.9rem;max-width:70%; }

.cfs-suggestions-wrap {
  padding:10px 20px 8px;display:flex;flex-wrap:wrap;gap:8px;
  border-top:1px solid #f0f4f8;background:#f8faff;flex-shrink:0;
}

.cfs-input-area { background:#fff;border-top:1px solid #f0f4f8;padding:14px 20px 10px;flex-shrink:0; }
.cfs-input-wrap { display:flex;align-items:flex-end;gap:10px; }
.cfs-input {
  flex:1;border:1.5px solid #e0e6f0;border-radius:14px;padding:12px 16px;
  font-size:.9rem;resize:none;font-family:inherit;line-height:1.5;
  max-height:140px;overflow-y:auto;outline:none;color:#1e293b;background:#f8faff;
  transition:border-color .2s;
  box-sizing: border-box;
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.cfs-input::-webkit-scrollbar { display:none; }
.cfs-input:focus { border-color:#1a4b9c;background:#fff; }
.cfs-send { width:46px;height:46px;border-radius:14px;font-size:1.2rem; }
.cfs-footer-note { margin-top:8px;text-align:center;font-size:.7rem;color:#94a3b8; }

/* ── Responsive tweaks ──────────────────────────────────── */
@media (max-width:600px) {
  .chatbot-window { width:calc(100vw - 24px);right:12px;bottom:80px;max-height:70vh; }
  #chatbotTrigger { right:12px;bottom:16px; }
  .cfs-inner { border-radius:16px;height:95vh; }
}
</style>

<!-- ============================================
     SCRIPT
     ============================================ -->
<script>
(function() {
  'use strict';

  /* ── Config ─────────────────────────────── */
  var ENDPOINT = '<?= $chatbot_endpoint ?>';
  var history  = [];          // {role:'user'|'bot', text:string}
  var isFullscreen = false;
  var isTyping  = false;

  /* ── DOM refs ───────────────────────────── */
  var trigger       = document.getElementById('chatbotTrigger');
  var win           = document.getElementById('chatbotWindow');
  var closeBtn      = document.getElementById('chatbotCloseBtn');
  var clearBtn      = document.getElementById('chatbotClearBtn');
  var fsBtn         = document.getElementById('chatbotFullscreenBtn');
  var input         = document.getElementById('chatbotInput');
  var sendBtn       = document.getElementById('chatbotSendBtn');
  var msgBox        = document.getElementById('chatbotMessages');
  var suggestions   = document.getElementById('chatbotSuggestions');
  var badge         = document.getElementById('chatbotBadge');

  var fsOverlay     = document.getElementById('chatbotFullscreen');
  var fsMsgs        = document.getElementById('cfsMessages');
  var fsInput       = document.getElementById('cfsInput');
  var fsSendBtn     = document.getElementById('cfsSendBtn');
  var fsClearBtn    = document.getElementById('cfsClearBtn');
  var fsCloseBtn    = document.getElementById('cfsCloseBtn');
  var fsSuggestions = document.getElementById('cfsSuggestions');

  var isOpen = false;

  /* ── Helpers ────────────────────────────── */
  function now() {
    var d = new Date();
    var h = d.getHours(), m = d.getMinutes();
    var ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    return h + ':' + (m < 10 ? '0' : '') + m + ' ' + ampm;
  }

  // Very lightweight markdown → HTML
  function mdToHtml(text) {
    var lines = text.split('\n');
    var out = [];
    var inUl = false;
    var inOl = false;

    for (var i = 0; i < lines.length; i++) {
      var line = lines[i];
      
      // Bold/Italic/Code/Headers
      line = line.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
      line = line.replace(/_(.+?)_/g, '<em>$1</em>');
      line = line.replace(/`([^`]+)`/g, '<code>$1</code>');
      line = line.replace(/^#{1,3}\s+(.+)/, '<strong>$1</strong><br>');
      
      // Unordered list
      if (/^\s*[-*•]\s+(.+)/.test(line)) {
        if (inOl) { out.push('</ol>'); inOl = false; }
        if (!inUl) { out.push('<ul>'); inUl = true; }
        out.push(line.replace(/^\s*[-*•]\s+(.+)/, '<li>$1</li>'));
        continue;
      }
      
      // Ordered list
      if (/^\s*\d+\.\s+(.+)/.test(line)) {
        if (inUl) { out.push('</ul>'); inUl = false; }
        if (!inOl) { out.push('<ol>'); inOl = true; }
        out.push(line.replace(/^\s*\d+\.\s+(.+)/, '<li>$1</li>'));
        continue;
      }
      
      // Close lists
      if (inUl) { out.push('</ul>'); inUl = false; }
      if (inOl) { out.push('</ol>'); inOl = false; }
      
      // Empty line
      if (line.trim() === '') {
        out.push('<br>');
      } else {
        out.push(line + '<br>');
      }
    }
    
    if (inUl) out.push('</ul>');
    if (inOl) out.push('</ol>');
    
    return out.join('').replace(/(<br>)+$/g, '');
  }

  function appendMsg(container, role, text) {
    var isBot = (role !== 'user');
    var initials = isBot ? '🤖' : '👤';

    var div = document.createElement('div');
    div.className = 'chat-msg ' + (isBot ? 'bot' : 'user');

    var html = mdToHtml(text);

    div.innerHTML =
      '<div class="chat-msg-avatar">' + initials + '</div>' +
      '<div class="chat-bubble-wrapper">' +
        '<div class="chat-bubble">' + html + '</div>' +
        '<span class="chat-time">' + now() + '</span>' +
      '</div>';

    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
    return div;
  }

  function showTyping(container) {
    var div = document.createElement('div');
    div.className = 'chat-msg bot typing-indicator';
    div.innerHTML =
      '<div class="chat-msg-avatar">🤖</div>' +
      '<div class="chat-bubble-wrapper">' +
        '<div class="chat-bubble">' +
          '<div class="typing-dot"></div>' +
          '<div class="typing-dot"></div>' +
          '<div class="typing-dot"></div>' +
        '</div>' +
      '</div>';
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
    return div;
  }

  function hideSuggestions() {
    if (suggestions) suggestions.style.display = 'none';
    if (fsSuggestions) fsSuggestions.style.display = 'none';
  }

  /* ── Send message ───────────────────────── */
  function sendMessage(text, inputEl, msgContainerEl) {
    if (!text || isTyping) return;
    text = text.trim();
    if (!text) return;

    hideSuggestions();
    appendMsg(msgContainerEl, 'user', text);
    history.push({ role: 'user', text: text });

    if (inputEl) inputEl.value = '';
    autoResize(inputEl);

    isTyping = true;
    sendBtn.disabled = true;
    fsSendBtn.disabled = true;

    var typingEl = showTyping(msgContainerEl);

    // Build history for API (exclude last user message, already in history)
    var apiHistory = history.slice(0, -1).map(function(h) {
      return { role: h.role === 'user' ? 'user' : 'model', text: h.text };
    });

    fetch(ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      body: JSON.stringify({ message: text, history: apiHistory })
    })
    .then(function(r) {
      return r.text().then(function(rawText) {
        return { status: r.status, raw: rawText };
      });
    })
    .then(function(res) {
      typingEl.remove();
      isTyping = false;
      sendBtn.disabled = false;
      fsSendBtn.disabled = false;

      var data;
      try {
        data = JSON.parse(res.raw);
      } catch(e) {
        // Server returned HTML or non-JSON (PHP error, redirect, etc.)
        var preview = res.raw.replace(/<[^>]*>/g,'').trim().substring(0, 300);
        appendMsg(msgContainerEl, 'bot', '⚠️ Server error (HTTP ' + res.status + '): ' + (preview || 'Unexpected response from server.'));
        return;
      }

      if (data.error) {
        appendMsg(msgContainerEl, 'bot', '⚠️ ' + data.error);
        history.push({ role: 'bot', text: data.error });
      } else if (data.reply) {
        appendMsg(msgContainerEl, 'bot', data.reply);
        history.push({ role: 'bot', text: data.reply });
        if (isFullscreen && msgContainerEl !== msgBox) {
          appendMsg(msgBox, 'bot', data.reply);
        }
      } else {
        appendMsg(msgContainerEl, 'bot', '⚠️ Unexpected response format.');
      }
    })
    .catch(function(err) {
      typingEl.remove();
      isTyping = false;
      sendBtn.disabled = false;
      fsSendBtn.disabled = false;
      appendMsg(msgContainerEl, 'bot', '⚠️ Network error: ' + err.message + '. Check your internet connection.');
    });

    // Also mirror user message to the other visible container
    if (isFullscreen && msgContainerEl !== msgBox) {
      appendMsg(msgBox, 'user', text);
    } else if (!isFullscreen && msgContainerEl !== fsMsgs && fsMsgs) {
      appendMsg(fsMsgs, 'user', text);
    }
  }

  /* ── Auto-resize textarea ───────────────── */
  function autoResize(el) {
    if (!el) return;
    el.style.height = '0px';
    var newHeight = Math.max(el.scrollHeight, 44);
    el.style.height = Math.min(newHeight, 140) + 'px';
  }

  /* ── Clear conversation ─────────────────── */
  function clearChat() {
    history = [];
    msgBox.innerHTML = '';
    fsMsgs.innerHTML = '';
    showWelcome(msgBox);
    showWelcome(fsMsgs);
    if (suggestions) suggestions.style.display = 'flex';
    if (fsSuggestions) fsSuggestions.style.display = 'flex';
  }

  /* ── Welcome message ────────────────────── */
  function showWelcome(container) {
    appendMsg(container, 'bot',
      '👋 **Hello! I\'m the MEB AI Beekeeping Assistant.**\n\n' +
      'I have real-time access to the MEB database — beekeepers, apiaries, colonies, honey production, and more.\n\n' +
      'Ask me anything, or pick a suggestion below to get started!'
    );
  }

  /* ── Toggle window ──────────────────────── */
  function openChat() {
    win.classList.add('open');
    isOpen = true;
    badge.style.display = 'none';
    setTimeout(function() { if (input) input.focus(); }, 300);
  }
  function closeChat() {
    win.classList.remove('open');
    isOpen = false;
  }

  /* ── Fullscreen toggle ──────────────────── */
  function openFullscreen() {
    fsOverlay.style.display = 'flex';
    isFullscreen = true;
    // Sync messages
    fsMsgs.innerHTML = msgBox.innerHTML;
    fsMsgs.scrollTop = fsMsgs.scrollHeight;
    setTimeout(function() { if (fsInput) fsInput.focus(); }, 100);
  }
  function closeFullscreen() {
    fsOverlay.style.display = 'none';
    isFullscreen = false;
  }

  /* ── Event listeners ────────────────────── */
  trigger.addEventListener('click', function() {
    if (isOpen) closeChat(); else openChat();
  });

  closeBtn.addEventListener('click', closeChat);
  fsBtn.addEventListener('click', openFullscreen);
  fsCloseBtn.addEventListener('click', closeFullscreen);

  clearBtn.addEventListener('click', clearChat);
  fsClearBtn.addEventListener('click', clearChat);

  // Send from mini window
  sendBtn.addEventListener('click', function() {
    sendMessage(input.value, input, msgBox);
  });
  input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage(input.value, input, msgBox);
    }
  });
  input.addEventListener('input', function() { autoResize(this); });

  // Send from fullscreen
  fsSendBtn.addEventListener('click', function() {
    sendMessage(fsInput.value, fsInput, fsMsgs);
  });
  fsInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage(fsInput.value, fsInput, fsMsgs);
    }
  });
  fsInput.addEventListener('input', function() { autoResize(this); });

  // Suggestion chips (mini + fullscreen)
  document.querySelectorAll('.chatbot-suggestion').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var q = this.getAttribute('data-q');
      var activeInput = isFullscreen ? fsInput : input;
      var activeContainer = isFullscreen ? fsMsgs : msgBox;
      if (isFullscreen) {
        sendMessage(q, fsInput, fsMsgs);
      } else {
        openChat();
        sendMessage(q, input, msgBox);
      }
    });
  });

  // Close fullscreen on backdrop click
  fsOverlay.addEventListener('click', function(e) {
    if (e.target === fsOverlay) closeFullscreen();
  });

  // Close mini-window on outside click
  document.addEventListener('click', function(e) {
    if (isOpen && !win.contains(e.target) && !trigger.contains(e.target)) {
      closeChat();
    }
  });

  // ESC key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      if (isFullscreen) closeFullscreen();
      else if (isOpen) closeChat();
    }
  });

  /* ── Init ───────────────────────────────── */
  showWelcome(msgBox);
  showWelcome(fsMsgs);

})();
</script>
