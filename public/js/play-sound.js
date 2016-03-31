/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function playSound(src_mp3) {
//    var src_mp3 = btn.data('srcMp3');
//    var src_ogg = btn.attr("data-src-ogg");

    if (supportAudioHtml5()) {
        playHtml5(src_mp3);
    } else {
        alert("Trình duyệt không hỗ trợ HTML5!");
    }
}

function supportAudioHtml5() {
    var audioTag = document.createElement('audio');
    try {
        return (!!(audioTag.canPlayType)
                && (audioTag.canPlayType("audio/mpeg") != "no"
                        && audioTag.canPlayType("audio/mpeg") != ""));
    } catch (e) {
        return false;
    }
}

function playHtml5(src_mp3) {
    //use appropriate source
    var audio = new Audio("");
    if (audio.canPlayType("audio/mpeg") != "no" && audio.canPlayType("audio/mpeg") != "")
        audio = new Audio(src_mp3);
//    else if (audio.canPlayType("audio/ogg") != "no" && audio.canPlayType("audio/ogg") != "")
//        audio = new Audio(src_ogg);

    //play
    audio.addEventListener("error", function (e) {
        alert("File âm thanh không tồn tại!");
    });
    audio.play();
//    audio.play();
}
