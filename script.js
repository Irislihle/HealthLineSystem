const signUpButton = document.getElementById('singUpButton');
const signInButton = document.getElementById('singInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signUp');

signUpButton.addEventListener('click',function(){
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
})

signInButton.addEventListener('click',function(){
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
})



