<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   <!-- App favicon -->
   <link rel="shortcut icon" href=" {{ url('reblate-favicon.png') }} ">
  <style>
    body {
    font-family: "Montserrat", sans-serif;
    font-optical-sizing: auto;
    font-weight: <weight>;
    font-style: normal;
  }
  .container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
h1 {
    font-size: 50px;
}
p {
    font-size: 20px
}
  </style>

  <title>Permission Denied</title>

  </head>

  <body style="background:#eee">
    <div class="container">
      <dotlottie-player src="https://lottie.host/15bc2774-b086-4e38-8c67-3c2c3b6f5a94/FaaKWfvOIF.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
      <h1> Permission Denied!</h1>
      <p>You do not have  <strong>permission</strong>  to access this page!</p>
      <a href="/">Return to Home Page</a>
    </div>


  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

  <script>
    window.addEventListener('contextmenu', function (e) {
      // Cancel the default action to prevent the context menu from appearing
      e.preventDefault();
    }, false);
  </script>

  </body>

