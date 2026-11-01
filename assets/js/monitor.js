"use strict";

const monitorWarrantyInput = document.getElementById("monitor-upload");
const monitorWarrantyFileName = document.getElementById("monitor-file-name");

/** Updates the monitor warranty filename after a file is selected or cleared. */
function updateMonitorWarrantyFileName() {
    const selectedFile = monitorWarrantyInput.files[0];

    monitorWarrantyFileName.textContent = selectedFile
        ? selectedFile.name
        : "فایلی انتخاب نشده";
    monitorWarrantyFileName.title = selectedFile ? selectedFile.name : "";
}

if (monitorWarrantyInput && monitorWarrantyFileName) {
    monitorWarrantyInput.addEventListener("change", updateMonitorWarrantyFileName);
    updateMonitorWarrantyFileName();
}
