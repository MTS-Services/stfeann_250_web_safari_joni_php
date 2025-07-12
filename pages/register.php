
<section class="login_body">
  <div class="login_wrapper">
    <div class="login_card">
      <form method="POST" action="/register" class="login_form">
        <h2 class="login_title">Register</h2>

        <!-- Name -->
        <div class="login_field">
          <label class="login_label" for="name">Name</label>
          <input id="name" name="name" type="text" required placeholder="Name" class="login_input" />
        </div>

        <!-- Email -->
        <div class="login_field">
          <label class="login_label" for="email">Email</label>
          <input id="email" name="email" type="email" required placeholder="Email Address" class="login_input" />
        </div>

        <!-- Password -->
        <div class="login_field relative">
          <label class="login_label" for="password">Password</label>
          <input id="password" name="password" type="password" required placeholder="Password"
            class="login_input" oninput="handlePasswordInput()" />
          <span id="eyeWrapper" class="login_eye" onclick="togglePassword()">
            <svg id="eyeIcon" class="login_eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
              <line id="eyeSlash" x1="4" y1="4" x2="20" y2="20" stroke="currentColor" stroke-width="2" />
            </svg>
          </span>
        </div>

        <!-- Confirm Password -->
        <div class="login_field relative">
          <label class="login_label" for="password_confirmation">Confirm Password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" required
            placeholder="Confirm Password" class="login_input" oninput="handleConfirmPasswordInput()" />
          <span id="confirmEyeWrapper" class="login_eye" onclick="toggleConfirmPassword()">
            <svg id="confirmEyeIcon" class="login_eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
              <line id="confirmEyeSlash" x1="4" y1="4" x2="20" y2="20" stroke="currentColor" stroke-width="2" />
            </svg>
          </span>
        </div>

        <!-- Already Registered + Button -->
        <div class="login_actions mt-4" style="justify-content: space-between;">
          <a href="?page=login" class="login_link">Already registered?</a>
          <button type="submit" class="login_btn">Register</button>
        </div>
      </form>
    </div>
  </div>
</section>

