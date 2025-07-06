// Helper: Blur content for 2 seconds
function blurTemporarily() {
  document.body.classList.add("blurred");
  setTimeout(() => {
    document.body.classList.remove("blurred");
  }, 2000);
}

// Block PrintScreen key (Windows/Linux)
document.addEventListener("keyup", (e) => {
  if (e.key === "PrintScreen") {
    blurTemporarily();
    navigator.clipboard.writeText("");
  }
});

// Attempt to detect macOS screenshot shortcuts (Command + Shift + 3/4/5)
document.addEventListener("keydown", (e) => {
  const isMacScreenshotCombo =
    e.metaKey && e.shiftKey && ["3", "4", "5"].includes(e.key);

  const blockedKeys = ["u", "s", "p", "c", "v", "i"]; // View Source, Save, Print, Copy, Paste, DevTools
  const key = e.key.toLowerCase();

  if ((e.ctrlKey || e.metaKey) && blockedKeys.includes(key)) {
    e.preventDefault();
  }

  if (isMacScreenshotCombo) {
    blurTemporarily();
  }
});

// Prevent print dialog
window.onbeforeprint = () => document.body.classList.add("blurred");
window.onafterprint = () => document.body.classList.remove("blurred");

// Disable right-click
document.addEventListener("contextmenu", (e) => {
  e.preventDefault();
  blurTemporarily();
});

// Disable copy/paste
document.addEventListener("copy", (e) => e.preventDefault());
document.addEventListener("paste", (e) => e.preventDefault());

// Prevent zoom with Ctrl/Command + scroll
window.addEventListener("wheel", (e) => {
  if (e.ctrlKey || e.metaKey) {
    e.preventDefault();
    document.body.classList.remove("blurred");
  }
});

// Mobile screenshot deterrents
const isMobile = /Mobi|Android/i.test(navigator.userAgent);
const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

if (isMobile || isIOS) {
  document.addEventListener("touchstart", (e) => {
    if (e.touches.length > 2) {
      e.preventDefault();
      blurTemporarily();
    }
  });

  window.addEventListener("orientationchange", blurTemporarily);

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
      document.body.classList.add("blurred");
    } else {
      document.body.classList.remove("blurred");
    }
  });
}

// Cleanup lingering blur
setTimeout(() => {
  document.body.classList.remove("blurred");
}, 2000);
