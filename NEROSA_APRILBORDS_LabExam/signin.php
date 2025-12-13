<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Sign In — UMAttend</title>
  <style>
    .toast {
      position: fixed;
      top: 24px;
      right: 24px;
      background: #f0de16ff;
      color: #ffffffff;
      padding: 16px 24px;
      border-radius: 12px;
      box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.1), 0px 4px 6px -4px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 300px;
      animation: slideIn 0.3s ease-out;
      z-index: 1000;
    }
    .toast.hide {
      animation: slideOut 0.3s ease-out forwards;
    }
    @keyframes slideIn {
      from {
        transform: translateX(400px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
    @keyframes slideOut {
      from {
        transform: translateX(0);
        opacity: 1;
      }
      to {
        transform: translateX(400px);
        opacity: 0;
      }
    }
    .toast-icon {
      width: 24px;
      height: 24px;
      background: #00c950;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .toast-close {
      margin-left: auto;
      cursor: pointer;
      opacity: 0.7;
      transition: opacity 0.2s;
    }
    .toast-close:hover {
      opacity: 1;
    }
  </style>
</head>
<body>
  <div class="flex h-screen w-screen items-center justify-center">
      <div class="flex relative bg-white content-stretch flex gap-[10px] h-[582px] p-[10px] rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] w-[1119px]">
          <div class="absolute h-[582px] left-0 overflow-clip top-0 w-[622px]">
            <div class="absolute h-full left-[-15px] w-[650.724px] z-1">
              <img class="scale-105" src="svg/splash.svg" alt="">
            </div>
            <div class="absolute contents left-[167px] top-[25px]">
              <div class="absolute left-[167px] size-[108px] top-[25px] z-2" data-name="image 1"><img alt="" class="absolute inset-0 max-w-none object-50%-50% object-cover pointer-events-none size-full" src="svg/ccelogo.svg"></div>
              <div class="absolute left-[285px] size-[108px] top-[25px] z-2" data-name="image 2"><img alt="" class="absolute inset-0 max-w-none object-50%-50% object-cover pointer-events-none size-full" src="svg/umlogo.svg"></div>
            </div>
            <div class="relative">
              <div class="absolute top-35 z-10 pl-[80px] text-white">
                <div class="absolute top-[-5px] left-73 z-1">
                  <img src="svg/highlight.svg" alt="">
                </div>
                <div class="flex gap-2 font-bold text-[40px] mb-2">
                  <span>Welcome to</span>
                  <span class="text-[#ffea00] z-10">UMAttend</span>
                </div>
                <div class="w-120 flex flex-col gap-4">
                  <h6>University of Mindanao Intramurals Attendance Management</h6>
                  <p>A comprehensive platform designed to optimize attendance tracking, team coordination, and event scheduling for school intramurals. Empowering educators, students, and administrators with real-time insights and seamless event management.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="absolute h-[582px] left-[622px] overflow-clip top-0 w-[497px]">
            <form id="loginForm" method="POST">
              <p class="absolute font-['Khula',sans-serif] leading-[normal] left-[80px] not-italic text-[36px] text-black text-nowrap top-[50px] whitespace-pre">Sign In</p>
              <div class="absolute bg-[#f3f3f3] content-stretch flex gap-[17px] items-center left-[80px] overflow-clip pl-[14px] pr-[14px] py-[8px] rounded-[5px] top-[140px] w-[297px]">
                <div class="relative shrink-0 size-[24px]" data-name="Frame">
                    <svg class="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 24 24">
                      <g id="Frame">
                          <path d="M22 7L13.009 12.727C12.7039 12.9042 12.3573 12.9976 12.0045 12.9976C11.6517 12.9976 11.3051 12.9042 11 12.727L2 7" id="Vector" stroke="var(--stroke-0, black)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                          <path d="M20 4H4C2.89543 4 2 4.89543 2 6V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V6C22 4.89543 21.1046 4 20 4Z" id="Vector_2" stroke="var(--stroke-0, black)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                      </g>
                    </svg>
                </div>
                <input type="email" placeholder="Email" class="font-['Khula',sans-serif] bg-transparent border-none outline-none flex-1 h-[20px] leading-[normal] text-[14px] text-black placeholder:text-[rgba(0,0,0,0.6)]" required="" value="">
              </div>
              <div class="absolute bg-[#f3f3f3] content-stretch flex gap-[17px] items-center left-[80px] overflow-clip pl-[14px] pr-[14px] py-[8px] rounded-[5px] top-[201px] w-[297px]">
                <div class="relative shrink-0 size-[24px]" data-name="Frame">
                  <svg class="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 24 24">
                    <g id="Frame">
                        <path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" id="Vector" stroke="var(--stroke-0, black)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        <path d="M19 10H5C3.89543 10 3 10.8954 3 12V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V12C21 10.8954 20.1046 10 19 10Z" id="Vector_2" stroke="var(--stroke-0, black)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        <path d="M7 10V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V10" id="Vector_3" stroke="var(--stroke-0, black)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </g>
                  </svg>
                </div>
                <input type="password" placeholder="Password" class="font-['Khula',sans-serif] bg-transparent border-none outline-none flex-1 h-[20px] leading-[normal] text-[14px] text-black placeholder:text-[rgba(0,0,0,0.6)]" required="" value="">
              </div>
              <div class="absolute content-stretch flex gap-[6px] items-end left-[80px] overflow-clip px-[8px] py-[6px] top-[248px] cursor-pointer">
                <div class="relative rounded-[3px] size-[12px] border border-[rgba(0,0,0,0.8)] border-solid bg-white flex items-center justify-center"></div>
                <p class="font-['Khula',sans-serif] h-[14px] leading-[normal] not-italic relative shrink-0 text-[12px] text-black w-fill">Remember me</p>
              </div>
              <button type="submit" class="absolute bg-[#ffea00] content-stretch flex items-center justify-center left-[80px] overflow-clip px-[117px] py-[8px] top-[318px] w-[297px] cursor-pointer hover:bg-[#f4e100] transition-colors">
                <p class="font-['Khula',sans-serif] h-[20px] leading-[normal] not-italic relative shrink-0 text-[16px] text-white w-[41px]">Login</p>
              </button>
              <div class="absolute h-0 left-[80px] top-[379px] w-[130px]">
                <div class="absolute inset-[-1px_0_0_0]">
                    <svg class="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 130 1">
                      <line id="Line 1" stroke="var(--stroke-0, black)" stroke-opacity="0.32" x2="130" y1="0.5" y2="0.5"></line>
                    </svg>
                </div>
              </div>
              <p class="absolute font-['Khula',sans-serif] leading-[normal] left-[223px] not-italic text-[14px] text-black text-nowrap top-[368px] whitespace-pre">or</p>
              <div class="absolute h-0 left-[248px] top-[379px] w-[130px]">
                <div class="absolute inset-[-1px_0_0_0]">
                    <svg class="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 130 1">
                      <line id="Line 1" stroke="var(--stroke-0, black)" stroke-opacity="0.32" x2="130" y1="0.5" y2="0.5"></line>
                    </svg>
                </div>
              </div>
          </form>
          <a href="/dashboard.php" class="absolute bg-[#ffea00] h-[36px] left-[80px] overflow-clip top-[398px] w-[297px] cursor-pointer hover:bg-[#f4e100] transition-colors">
              <p class="absolute font-['Khula',sans-serif] h-[21px] leading-[normal] left-[calc(50%-70.5px)] not-italic text-[16px] text-white top-[calc(50%-10px)] w-[143px]">Sign in with Google</p>
          </a>
          <div class="absolute h-[26px] left-[80px] overflow-clip top-[450px] w-[201px]">
              <p class="absolute font-['Khula',sans-serif] leading-[normal] left-0 not-italic text-[0px] text-[12px] text-black text-nowrap top-[6px] whitespace-pre"><span>Don't have an account? </span><a class="text-[#ffe100] hover:underline cursor-pointer" href="/register.php" data-discover="true">Register Now</a></p>
          </div>
          <p class="absolute font-['Khula',sans-serif] leading-[normal] left-[80px] not-italic text-[14px] text-black text-nowrap top-[97px] whitespace-pre">Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
          <p class="absolute font-['Khula',sans-serif] leading-[normal] left-[173px] not-italic text-[10px] text-black text-nowrap top-[520px] whitespace-pre">© University of Mindanao</p>
        </div>
      </div>
    <section aria-label="Notifications alt+T" tabindex="-1" aria-live="polite" aria-relevant="additions text" aria-atomic="false"></section>
  </div>
  <script>
    function showToast(message) {
      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.innerHTML = `
        <div class="toast-icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M11.6667 3.5L5.25 9.91667L2.33333 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div style="flex: 1; font-size: 14px; font-weight: 500;">${message}</div>
        <div class="toast-close" onclick="this.parentElement.classList.add('hide'); setTimeout(() => this.parentElement.remove(), 300)">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M15 5L5 15M5 5L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
      `;
      document.body.appendChild(toast);
      setTimeout(() => {
        toast.classList.add('hide');
        setTimeout(() => toast.remove(), 300);
      }, 3000);
    }

    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Simulate login
      setTimeout(() => {
        showToast('Login successful! Redirecting...');
        setTimeout(() => {
          window.location.href = '/dashboard.php';
        }, 1000);
      }, 500);
    });

    function handleGoogleSignIn() {
      showToast('Google Sign In - Feature coming soon!');
    }
  </script>
</body>
</html>