<!DOCTYPE html>
<html>
    <head>
        <?php require_once '../metaLinks.php'; ?>
        <title>Image</title>
    </head>
    <body>
        <?php require_once '../navbar.php'; ?>
        <div class="container">
            <h1 class="mt-3">Image</h1>
            <img src="" alt="Captcha" id="captcha" />
            <button onclick="loadCaptcha();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                  <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                </svg>
            </button>
            <p id="captcha_err">&nbsp;</p>
        </div>
        
        <script>
            document.onload = loadCaptcha();
            
            function loadCaptcha() {                      
                fetch('/controller/captcha.php', {cache: 'no-cache'})
                .then(response => {
                    if (!response.ok) {
                      throw new Error('Network error.');
                    }

                    const img = document.querySelector('#captcha');
                    img.src = '/images/captcha.jpg';
                  })
                  .catch(error => {
                      const captcha_err = document.querySelector('#captcha_err');
                      captcha_err.innerHTML = 'Unable to get Captcha: ' + error;
                  });
            }
        </script>
    </body>
</html>
