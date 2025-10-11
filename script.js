// =============================
// script.js - User CRUD actions
// =============================

// -------- Open Edit Modal and Load User Data --------
function openEditModal(id) {
    console.log("Opening edit modal for ID:", id);

    // Fetch user details from server
    fetch(`get_user.php?id=${id}`) // 👈 Change to fetch.php if you renamed the file
        .then((res) => {
            if (!res.ok) throw new Error("Failed to fetch user data.");
            return res.json();
        })
        .then((data) => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Populate modal fields
            document.getElementById("editId").value = data.id || "";
            document.getElementById("editFname").value = data.fname || "";
            document.getElementById("editLname").value = data.lname || "";
            document.getElementById("editEmail").value = data.email || "";
            document.getElementById("editPhone").value = data.phone || "";

            // Show modal
            document.getElementById("editModal").classList.remove("hidden");
        })
        .catch((err) => {
            console.error("Error loading user:", err);
            alert("Error loading user data. Check console for details.");
        });
}

// -------- Close Edit Modal --------
function closeEditModal() {
    document.getElementById("editModal").classList.add("hidden");
}

// -------- Handle Form Submission (Edit User) --------
document.addEventListener("DOMContentLoaded", function() {
    const editForm = document.getElementById("editForm");
    if (!editForm) return;

    editForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(editForm);

        fetch("update.php", {
                method: "POST",
                body: formData,
            })
            .then((res) => {
                if (!res.ok) throw new Error("Failed to update user.");
                return res.text();
            })
            .then((text) => {
                alert(text.trim() || "User updated successfully!");
                closeEditModal();
                setTimeout(() => window.location.reload(), 800); // Refresh after short delay
            })
            .catch((err) => {
                console.error("Error updating user:", err);
                alert("Error updating user. Check console for details.");
            });
    });
});

// -------- Delete User --------
function deleteUser(id) {
    if (!confirm("Are you sure you want to delete this user?")) return;

    fetch("delete.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${encodeURIComponent(id)}`,
        })
        .then((res) => {
            if (!res.ok) throw new Error("Failed to delete user.");
            return res.text();
        })
        .then((text) => {
            alert(text.trim() || "User deleted successfully!");
            setTimeout(() => window.location.reload(), 800);
        })
        .catch((err) => {
            console.error("Error deleting user:", err);
            alert("Error deleting user. Check console for details.");
        });
}