<?php
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../config/function.php';

$id = $_SESSION['user_id'] ?? null;
if (!$id) {
  die("User not logged in.");
}
$user = getUser($id);
?>

<section class="profile_section_user">
  <div class="profile_section_user_container">
    <h2>Edit Profile</h2>

    <div class="edit-button-wrapper">
      <a href="?page=profile" class="edit-button">Back</a>
    </div>


    <form method="POST" action="/pages/update-profile.php" enctype="multipart/form-data" class="profile-form">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">
      <label>
        Name:
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
      </label>

      <label>
        Email:
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      </label>

      <label>
        Profile Image (Optional):
        <input type="file" name="image">
      </label>

      <?php if (!empty($user['image'])): ?>
        <img src="../<?= $user['image'] ?>" width="120" style="margin-top:10px;">
      <?php endif; ?>

      <button type="submit" class="edit-button">Save Changes</button>
    </form>
  </div>
</section>

<!-- Add your CSS below -->
<style>
  /* General styles for the profile container */

  .profile_section_user_container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    padding: 30px;
  }

  h2 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
  }


  .profile-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .profile-form label {
    font-size: 16px;
    font-weight: 500;
    color: #555;
  }

  .profile-form input {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s ease;
  }

  .profile-form input:focus {
    border-color: #e77fb3ff;
  }

  .profile-form button {
    background-color: #28a745;
    color: #fff;
    padding: 12px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .profile-form button:hover {
    background-color: #218838;
  }

  /* Image display style */
  .profile-section_user img {
    display: block;
    margin: 20px auto;
    border-radius: 50%;
  }
</style>