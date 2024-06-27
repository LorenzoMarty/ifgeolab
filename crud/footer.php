<style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }
    main {
      flex: 1;
    }
    #fot {
      background: #03300b;
      text-align: center;
      color: #ffff;
    }
    footer {
      padding: 30px;
      width: 100%;
      position: relative;
    }
    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }
  </style>
</head>
<body>
  
  <footer id="fot">
    Instituto Federal Farroupilha - Campus Uruguaiana
  </footer>

  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
    });
  </script>
</body>
</html>