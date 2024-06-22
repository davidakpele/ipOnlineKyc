
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta name="theme-color" content="#c9190c">
            <meta name="robots" content="index,follow">
            <meta htttp-equiv="Cache-control" content="no-cache">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="msapplication-TileColor" content="#c9190c">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="keywords" content="" />
            <meta name="description" content="" />
            <link href="{$assets_link}css/styles.css" rel="stylesheet">
            <link href="{$assets_link}css/bootstrap.min.css" rel="stylesheet">
            <link href="{$assets_link}fontawesome/css/all.css" rel="stylesheet">
            <link href="{$assets_link}css/styles.css" rel="stylesheet">
            <script type='text/javascript' src='{$assets_link}js/jquery.min.js'></script>

            <title>{$page_title}</title>
            <script>
                root_url = "{$root_link}";
            </script>
      </head>
        <body className='snippet-body'>
            <div class="container d-flex justify-content-center">
                <div class="row my-5">
                    <div class="col-md-6 text-left text-white lcol">
                    <div class="greeting"><h3>Welcome to <span class="txt">ipOnline</span></h3></div>
                    <h6 class="mt-3">let's light some fire and get the show on the road...</h6>
                    <div class="footer">
                        <div class="socials d-flex flex-row justify-content-between text-white">
                        <div class="d-flex flex-row"><i class="fab fa-linkedin-in"></i><i class="fab fa-facebook-f"></i><i class="fab fa-twitter"></i></div>
                        <span>Privacy Policy</span>
                        <span>&copy; 2024 ipOnline</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 rcol">
                    <form autoComplete='off' class="sign-up form-group auth-form" action="{$root_link}auth/login" method="post">
                        <h2 class="heading mb-4">Sign up</h2>
                        <div class="form-group fone mt-2">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control username" name="username" placeholder="Username" >
                            <div class="invalid-feedback username-error"></div>
                        </div>
                        <div class="form-group pass mt-2">
                            <i class="fas fa-user"></i>
                            <input type="password" class="form-control userPassword" name="password" placeholder="Password"  autocomplete="off"/>
                            <i class="fa fa-eye-slash Icon" id="clearPasswordText" aria-hidden="true"></i>
                            <div class="invalid-feedback password-error"></div>
                        </div>

                        <input type="checkbox" class="form-check-input ml-0" id="exampleCheck1">
                        <label class="form-check-label ml-3" for="exampleCheck1" >I agree to ipOnline <u>Terms</u> and <u>Privacy Policy</u></label>
                        <div class="submit-btn"> 
                            <button type="submit" class="btn btn-success mt-2">
                                <span class="text">Sign-In Now</span>
                            </button>
                        </div>
                        
                    </form>
                
                <p class="exist mt-4">Don't have account? <span><a href="{$root_link}auth/register">Create account</a></span></p>
            </div>
        </div>
        </div>
    <script type='text/javascript' src='{$assets_link}js/bootstrap.bundle.min.js'></script>
    <script type='module' src='{$assets_link}js/actions.js'></script>
    
    </body>
</html>