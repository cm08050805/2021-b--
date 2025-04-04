const video = document.querySelector("#video");
const btnRepeat = document.querySelector("#btnRepeat");
const btnAuto = document.querySelector("#btnAuto");

let isAutoPlay = localStorage.getItem("autoPlay") || "false";
if(isAutoPlay === "true")
{
    video.autoplay = true;
    btnAuto.innerHTML = "자동재생 켜짐";
}

function playVideo()
{
    video.play();
}

function pauseVideo()
{
    video.pause();
}

function stopVideo()
{
    video.pause();
    video.currentTime = 0;
}

function rewindVideo()
{
    video.currentTime -= 10;
}

function fastForward()
{
    video.currentTime += 10;
}

function reduceSpeed()
{
    video.playbackRate -= 0.1;
}

function increaseSpeed()
{
    video.playbackRate += 0.1;
}

function originalSpeed()
{
    video.playbackRate = 1.0;
}
//보이기 숨기기는 CSS로 알아서 하시고.

function repeatToggle()
{
    video.loop = !video.loop;
    btnRepeat.innerHTML = video.loop ? "반복중" :"반복꺼짐";
}

//자동재생은 페이지 들어왔을 때 켜지는 기능인데 이걸 왜 껐다 키라는지 이해가 안감.
//일단 로컬스토리지에 옵션을 저장하는 형태로 감.
function toggleAutoplay()
{
    let autoPlay = (localStorage.getItem("autoPlay") || "false") === "true";
    let nextValue = !autoPlay;

    btnAuto.innerHTML = nextValue ? "자동재생 켜짐" : "자동재생 꺼짐";
    video.autoplay = nextValue;

    localStorage.setItem("autoPlay", nextValue.toString());

    //이 부분은 안해도 될 수도 있음.
    if(nextValue)
        video.play();
    else
        video.pause();

}