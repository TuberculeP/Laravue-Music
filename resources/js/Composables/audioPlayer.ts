import { ref } from "vue";

const currentMusicToPlay = ref<HTMLAudioElement | null>(null);
const isPlaying = ref(false);

function pause() {
    if (currentMusicToPlay.value) {
        currentMusicToPlay.value.pause();
        isPlaying.value = false;
    }
}

function play() {
    if (currentMusicToPlay.value) {
        currentMusicToPlay.value.play();
        isPlaying.value = true;
    }
}

function requestPlay(audio: HTMLAudioElement) {
    if (currentMusicToPlay.value) {
        if (currentMusicToPlay.value === audio) {
            if (isPlaying.value) {
                pause();
            } else {
                play();
            }
        } else {
            pause();
            currentMusicToPlay.value = audio;
            play();
        }
    } else {
        currentMusicToPlay.value = audio;
        play();
    }
}

export const useAudioPlayer = () => {
    return {
        requestPlay,
        isPlaying,
        pause,
        play,
    };
};
