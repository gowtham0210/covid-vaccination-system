const emailContainer = document.querySelector('.email_container')
const otpContainer = document.querySelector('.otp_container')
const submitOtp = document.querySelector('.submit-otp')
const submitEmail = document.querySelector('.email-submit')
const emailError = document.querySelector('.email-error')
const otpError = document.querySelector('.otp-error')

submitEmail.addEventListener('click', (e)=>{
    e.preventDefault()

    if(document.querySelector('#email').value==''){
        error(emailError, "Email field can not be empty")
        return
    }

    fetch('../PHP/send_otp.php', {
        method:'POST',
        body: new FormData(document.querySelector('.email-form'))
    })
    .then(res=>res.json())
    .then(data=>{
        console.log(data)
        if(data.status=='success'){
            otpContainer.style.display='block'
            emailContainer.style.display='none'
        }
        else
        error(emailError, "You are not registered with us")
})

})

submitOtp.addEventListener('click', (e)=>{
    e.preventDefault()
    console.log('submit otp')
    if(document.querySelector('#otp').value==''){
        error(otpError, "OTP field can not be empty")
        return
    }
    
    fetch('../PHP/send_otp.php', {
        method:'POST',
        body: new FormData(document.querySelector('.otp-form'))
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status =='success'){
           window.location.replace("../PHP/vaccine_Status.php")
        }
        else
        error(otpError, "Incorrect OTP provided")
    })
    
    })

    function error(span, msg){
        span.textContent = msg
        span.style.color='red'
        setTimeout(()=>{span.textContent=""}, 3000)
    }