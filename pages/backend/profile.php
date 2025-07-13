<?php
include_once __DIR__ . '/../../config/config.php';
include_once __DIR__ . '/../../config/function.php';

$id = $_SESSION['user_id'] ?? null;

if (!$id) {
    die("User not logged in.");
}

$user = getUser($id);
?>

<section>
  <div class="profile-container">
    <div class="profile-header">
      <div class="profile-avatar-wrapper">
        <img src="../<?= $user['image'] ?>" alt="Profile Picture" class="profile-avatar">
      </div>
      <h1 class="profile-name"><?= $user['name'] ?></h1>
    </div>

    <main class="profile-main">
      <section class="profile-section contact-info">
        <h2>Contact Information</h2>
        <ul class="contact-grid">
          <li><strong>Email:</strong> <a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></li>
          <li><strong>Joined On:</strong> <?= date("F j, Y", strtotime($user['created_at'])) ?></li>
          <li><strong>Last Updated:</strong> <?= date("F j, Y", strtotime($user['updated_at'])) ?></li>
        </ul>
      </section>
    </main>

    <div class="edit-button-wrapper">
      <a href="backend.php?page=edit-profile" class="edit-button">Edit Profile</a>
    </div>
  </div>
</section>
