<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100vw;
      height: 100dvh;
      background-color: #0f172a;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: fixed;
      top: 0;
      left: 0;
    }

    #bg-canvas {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      z-index: 0;
      background: #0f172a;
    }

    .container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 400px;
      padding: 30px 25px;
      background: rgba(30, 41, 59, 0.95);
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(56, 223, 248, 0.6);
      text-align: center;
      box-sizing: border-box;
    }

    h2 {
      color: #38bdf8;
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 2rem;
      letter-spacing: 1.2px;
    }

    input {
      width: 100%;
      padding: 14px;
      margin: 12px 0;
      background-color: #0f172a;
      border: 1.5px solid #38bdf8;
      border-radius: 8px;
      color: white;
      font-size: 1rem;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    input::placeholder {
      color: #94a3b8;
    }

    input:focus {
      border-color: #60a5fa;
      outline: none;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #38bdf8;
      color: #0f172a;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 1.1rem;
      cursor: pointer;
      margin-top: 10px;
      box-shadow: 0 4px 15px rgba(56, 223, 248, 0.6);
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #60a5fa;
    }

    a {
      color: #38bdf8;
      text-decoration: none;
      margin-top: 12px;
      display: inline-block;
      font-size: 0.95rem;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #60a5fa;
      text-decoration: underline;
    }

    /* Error message */
    .error-message {
      background: #f87171;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: 600;
      text-align: left;
    }

    @media (max-width: 320px) {
      h2 {
        font-size: 1.6rem;
      }
      input, button {
        font-size: 0.9rem;
        padding: 12px;
      }
    }
  </style>
</head>
<body>

<canvas id="bg-canvas"></canvas>

<div class="container" role="main" aria-label="Login form container">
  <h2>Login</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    @if($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

    <input type="email" name="email" placeholder="Email" required autofocus autocomplete="email" value="{{ old('email') }}" />
    <input type="password" name="password" placeholder="Password" required autocomplete="current-password" />
    <a href="{{ route('password.request') }}">Forgot your password?</a>
    <button type="submit">Login</button>
    <a href="{{ route('register') }}">Signup</a>
  </form>
</div>

<script>
  const canvas = document.getElementById('bg-canvas');
  const ctx = canvas.getContext('2d');

  let width, height;
  let particles = [];
  const PARTICLE_COUNT = 70;
  const MAX_DISTANCE = 150;

  function init() {
    resize();
    particles = [];
    for (let i = 0; i < PARTICLE_COUNT; i++) {
      particles.push({
        x: Math.random() * width,
        y: Math.random() * height,
        vx: (Math.random() - 0.5) * 0.7,
        vy: (Math.random() - 0.5) * 0.7,
        radius: 2 + Math.random() * 1.5
      });
    }
  }

  function resize() {
    width = window.innerWidth;
    height = window.innerHeight;
    canvas.width = width * devicePixelRatio;
    canvas.height = height * devicePixelRatio;
    canvas.style.width = width + 'px';
    canvas.style.height = height + 'px';
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.scale(devicePixelRatio, devicePixelRatio);
  }

  function draw() {
    ctx.clearRect(0, 0, width, height);
    ctx.fillStyle = 'rgba(56, 223, 248, 0.8)';
    particles.forEach(p => {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
      ctx.fill();
    });

    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const p1 = particles[i];
        const p2 = particles[j];
        const dx = p1.x - p2.x;
        const dy = p1.y - p2.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < MAX_DISTANCE) {
          ctx.strokeStyle = `rgba(56, 223, 248, ${1 - dist / MAX_DISTANCE})`;
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(p1.x, p1.y);
          ctx.lineTo(p2.x, p2.y);
          ctx.stroke();
        }
      }
    }
  }

  function update() {
    particles.forEach(p => {
      p.x += p.vx;
      p.y += p.vy;
      if (p.x < 0 || p.x > width) p.vx *= -1;
      if (p.y < 0 || p.y > height) p.vy *= -1;
    });
  }

  function loop() {
    update();
    draw();
    requestAnimationFrame(loop);
  }

  window.addEventListener('resize', () => {
    resize();
    init();
  });

  init();
  loop();

  // Prevent scroll on input focus
  const preventScroll = () => {
    document.body.style.overflow = 'hidden';
    document.body.style.position = 'fixed';
    document.body.style.width = '100%';
  };

  const allowScroll = () => {
    document.body.style.overflow = '';
    document.body.style.position = '';
    document.body.style.width = '';
  };

  document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', preventScroll);
    input.addEventListener('blur', allowScroll);
  });
</script>

</body>
</html>