function lockLocker() {
  updateLockerStatus("Locked");
}

function unlockLocker() {
  updateLockerStatus("Unlocked");
}

function updateLockerStatus(status) {
  fetch("update_locker_status.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "status=" + encodeURIComponent(status)
  })
  

    
    
  .then(response => response.text())
  .then(result => {
    const lockerStatus = document.getElementById("lockerStatus");
    const msg = document.getElementById("responseMsg");

    if (result.trim() === "success") {
      if (status === "Locked") {
        lockerStatus.textContent = "Locked 🔒";
        lockerStatus.className = "status locked";
      } else {
        lockerStatus.textContent = "Unlocked 🔓";
        lockerStatus.className = "status unlocked";
      }
      msg.textContent = "Locker " + status + " successfully!";
    } else {
      msg.textContent = "Error: " + result;
    }
  })
  .catch(() => {
    document.getElementById("responseMsg").textContent = "Server error. Please try again.";
  });
}

