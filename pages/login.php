

<section class="login_body">
  <div class="login_wrapper">
    <div class="login_card">
      <form method="POST" action="/login" class="login_form">
        <h2 class="login_title">User Login</h2>

        <!-- User Icon -->
        <div class="login_user-icon-wrapper">
          <a href="/home">
            <svg class="login_user-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 24 24">
              <path
                d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.314 0-10 1.656-10 5v3h20v-3c0-3.344-6.686-5-10-5z" />
            </svg>
          </a>
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
              <path id="eyeIconPath1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path id="eyeIconPath2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
              <line id="eyeSlash" x1="4" y1="4" x2="20" y2="20" stroke="currentColor" stroke-width="2" />
            </svg>
          </span>
        </div>

        <!-- Remember -->
        <div class="login_checkbox">
          <input id="remember_me" type="checkbox" name="remember">
          <label for="remember_me">Remember me</label>
        </div>

        <!-- Actions -->
        <div class="login_actions">
          <p>Don't have an account? <a href="/?page=register" class="login_link">Create Account</a></p>
          <button type="submit" class="login_btn">Log In</button>
        </div>

      </form>
    </div>
  </div>

