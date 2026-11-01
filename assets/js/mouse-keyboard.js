"use strict";

/** Displays the selected warranty filename beside its own device upload. */
function updateDeviceWarrantyFileName(event) {
    const input = event.currentTarget;
    const fileNameElement = document.getElementById(input.getAttribute("aria-describedby"));

    if (!fileNameElement) {
        return;
    }

    const file = input.files[0];
    fileNameElement.textContent = file ? file.name : "فایلی انتخاب نشده";
    fileNameElement.title = file ? file.name : "";
}

document.querySelectorAll("[data-warranty-input]").forEach((input) => {
    input.addEventListener("change", updateDeviceWarrantyFileName);
});
