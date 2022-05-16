@extends('frontend.layouts.master')
@section('content')
    <div class="form-bodyWidth ">
        <div class="form-modal ">
    
            <div class="form-toggle">
                <button id="login-toggle" onclick="toggleLogin()">log in</button>
                <button id="signup-toggle" onclick="toggleSignup()">sign up</button>
            </div>
        
            <div id="login-form">
                <form>
                    <input type="text" placeholder="Enter email or username"/>
                    <input type="password" placeholder="Enter password"/>
                    <button type="button" class="btn login">login</button>
                    <p><a href="javascript:void(0)">Forgotten account</a></p>
                    <hr/>
                </form>
            </div>
        
            <div id="signup-form">
                <form>
                    <input type="email" placeholder="Enter your email"/>
                    <input type="text" placeholder="Choose username"/>
                    <input type="password" placeholder="Create password"/>
                    <input type="password" placeholder="Confirm password"/>
                    <button type="button" class="btn signup">create account</button>
                    <p>Clicking <strong>create account</strong> means that you are agree to our <a href="javascript:void(0)">terms of services</a>.</p>
                    <hr/>
                   
                </form>
            </div>
        
        </div>
    </div>
    
    <script>
        function toggleSignup(){
   document.getElementById("login-toggle").style.backgroundColor="#fff";
    document.getElementById("login-toggle").style.color="#222";
    document.getElementById("signup-toggle").style.backgroundColor="#50a3e6";
    document.getElementById("signup-toggle").style.color="#fff";
    document.getElementById("login-form").style.display="none";
    document.getElementById("signup-form").style.display="block";
}

function toggleLogin(){
    document.getElementById("login-toggle").style.backgroundColor="#50a3e6";
    document.getElementById("login-toggle").style.color="#fff";
    document.getElementById("signup-toggle").style.backgroundColor="#fff";
    document.getElementById("signup-toggle").style.color="#222";
    document.getElementById("signup-form").style.display="none";
    document.getElementById("login-form").style.display="block";
}

 </script>
@endsection