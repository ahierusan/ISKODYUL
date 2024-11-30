function toggleDropdown() {
    const dropdownContent = document.getElementById("dropdown-content");
    dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
}

function updateSelected(selectedItem) {
    document.getElementById("selected-college").textContent = selectedItem;
    document.getElementById("dropdown-content").style.display = "none"; // Hide dropdown after selection
}

// Close the dropdown if clicked outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-button')) {
        const dropdownContent = document.getElementById("dropdown-content");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        }
    }
}
