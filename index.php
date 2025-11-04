<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Sign Up Form</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- ===== Original Form ===== -->
  <div class="signup-container">
    <h2>Create Account</h2>
    <form action="insert.php" method="POST">
      <div class="form-row">
        <div class="form-group half">
          <label>First Name</label>
          <input type="text" name="fname" required>
        </div>
        <div class="form-group half">
          <label>Last Name</label>
          <input type="text" name="lname" required>
        </div>
      </div>

      <div class="email-phone-row">
  <div>
    <label>Email</label>
    <input type="email" name="email" required>
  </div>
  <div>
    <label>Phone Number</label>
    <input type="text" name="phone" required>
  </div>
</div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" required>
      </div>


      <div class="form-group">
        <label>Gender</label>
        <div class="radio-group">
          <label><input type="radio" name="gender" value="Male" required> Male</label>
          <label><input type="radio" name="gender" value="Female"> Female</label>
          <label><input type="radio" name="gender" value="Other"> Other</label>
        </div>
      </div>

      <div class="form-group">
        <label>Subscription</label>
        <div class="radio-group">
          <label><input type="radio" name="subscription" value="Free" required> Free</label>
          <label><input type="radio" name="subscription" value="Premium"> Premium</label>
        </div>
      </div>

      <div class="button-row">
        <button type="submit">Submit</button>
        <button type="reset" class="reset-btn">Reset</button>
      </div>

      <div class="footer">
        Already have an account? <a href="#">Sign In</a>
      </div>
    </form>
  </div>

  <!-- ===== Saved Data Section ===== -->
<div class="w-full mt-12">
  <h2 class="text-center text-3xl font-bold text-white mb-6">Saved Data</h2>

  <?php
  include 'config.php';
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo '<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg divide-y">';
      while($row = $result->fetch_assoc()) {
          $initials = strtoupper(substr($row['fname'], 0, 1) . substr($row['lname'], 0, 1));

          echo '
          <div class="flex items-center justify-between p-6">
            <div class="flex items-center space-x-4">
              <div class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center text-lg font-semibold">'.$initials.'</div>
              <div>
                <h3 class="text-lg font-bold text-gray-800">'.$row["fname"].' '.$row["lname"].'</h3>
                <p class="text-sm text-gray-600">'.$row["email"].'</p>
                <p class="text-xs text-gray-500">'.$row["phone"].'</p>
              </div>
            </div>
            <div class="text-center">
              <p class="font-semibold text-gray-800">'.$row["subscription"].' Plan</p>
              <p class="text-sm text-gray-500">'.$row["gender"].' • '.$row["dob"].'</p>
            </div>
            <div class="flex space-x-2">
              <!-- Edit Button (uses JS) -->
              <button 
                type="button" 
                onclick="openEditModal('.$row["id"].')" 
                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg font-semibold">
                Edit
              </button>

              <!-- Delete Button (uses JS function, NOT form) -->
              <button 
                type="button" 
                onclick="deleteUser('.$row["id"].')" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold">
                Delete
              </button>
            </div>
          </div>';
      }
      echo '</div>';
  } else {
      echo '<p class="text-center text-white text-lg mt-6">No saved data found.</p>';
  }

  $conn->close();
  ?>
</div>

<!-- ===== Edit Modal ===== -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
    <h2 class="text-xl font-semibold mb-4 text-center">Edit User</h2>
    <form id="editForm">
      <input type="hidden" id="editId" name="id">

      <!-- First Name -->
      <div class="mb-3">
        <label for="editFname" class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
        <input type="text" id="editFname" name="fname" 
               class="w-full p-2 border rounded bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-400" 
               placeholder="Enter first name">
      </div>

      <!-- Last Name -->
      <div class="mb-3">
        <label for="editLname" class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
        <input type="text" id="editLname" name="lname" 
               class="w-full p-2 border rounded bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-400" 
               placeholder="Enter last name">
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="editEmail" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
        <input type="email" id="editEmail" name="email" 
               class="w-full p-2 border rounded bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-400" 
               placeholder="Enter email">
      </div>

      <!-- Phone -->
      <div class="mb-4">
        <label for="editPhone" class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
        <input type="text" id="editPhone" name="phone" 
               class="w-full p-2 border rounded bg-gray-100 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-400" 
               placeholder="Enter phone number">
      </div>

      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeEditModal()" 
                class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Save</button>
      </div>
    </form>
  </div>
</div>

  <script src="script.js"></script>
</body>
</html>
