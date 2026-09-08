function startCountdown(targetTime, elementId, messageWhenDone){

    const countdownElement = document.getElementById(elementId);

    const timer = setInterval(function(){

        const now = new Date().getTime();
        const target = new Date(targetTime).getTime();

        const difference = target - now;

        if(difference <= 0){

            clearInterval(timer);

            countdownElement.innerHTML = messageWhenDone;

            location.reload();

            return;
        }

        const hours = Math.floor(difference/(1000*60*60));

        const minutes = Math.floor((difference%(1000*60*60))/(1000*60));

        const seconds = Math.floor((difference%(1000*60))/1000);

        countdownElement.innerHTML =
            hours+"h : "+minutes+"m : "+seconds+"s";

    },1000);
}